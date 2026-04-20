/**
 * Econt Office + Home Delivery Checkout Logic — Noriks BG
 * - Delivery type selector (home / econt office)
 * - Loads Econt offices from API for econt delivery
 * - Loads Econt cities + quarters for home delivery
 * - Shows/hides address fields based on delivery type
 */
(function ($) {
    'use strict';

    var ECONT_API_BASE = 'https://ee.econt.com/services/Nomenclatures/NomenclaturesService.';
    var ECONT_OFFICES_URL = ECONT_API_BASE + 'getOffices.json';
    var ECONT_CITIES_URL = ECONT_API_BASE + 'getCities.json';
    var ECONT_QUARTERS_URL = ECONT_API_BASE + 'getQuarters.json';

    var ADDRESS_FIELDS = [
        '#billing_address_1_field',
        '#billing_address_2_field',
        '#billing_city_field',
        '#billing_postcode_field'
    ];
    var ECONT_FIELDS = [
        '#billing_econt_office_city_field',
        '#billing_econt_office_field'
    ];
    var HOME_FIELDS = [
        '#billing_home_city_field',
        '#billing_home_quarter_field',
        '#billing_home_street_name_field',
        '#billing_home_block_field',
        '#billing_home_street_number_field',
        '#billing_home_entrance_field',
        '#billing_home_floor_field',
        '#billing_home_apartment_field'
    ];

    var econtOfficesData = null; // cached offices
    var econtLoading = false;
    var homeCitiesData = null; // cached cities for home delivery
    var homeCitiesLoading = false;

    /* ── Delivery type switching ── */

    function setDeliveryType(type, skipLoad) {
        $('#billing_delivery_type').val(type);

        $('#noriks-delivery-type-container .delivery-type').removeClass('active').css({
            'background': '#fff',
            'outline': '1px solid #cbcacb'
        });
        $('#noriks-delivery-type-container .delivery-type[data-type="' + type + '"]').addClass('active').css({
            'background': '#f2feee',
            'outline': '2px solid #47b426'
        });

        if (type === 'econt') {
            $(ADDRESS_FIELDS.join(',')).hide();
            $(HOME_FIELDS.join(',')).hide();
            // Make home fields non-required
            $(HOME_FIELDS.join(',')).removeClass('validate-required');
            // Make address fields non-required when econt selected
            $(ADDRESS_FIELDS.join(',')).removeClass('validate-required');
            $(ECONT_FIELDS.join(',')).show();
            // Make econt fields required
            $('#billing_econt_office_city_field').addClass('validate-required');
            $('#billing_econt_office_field').addClass('validate-required');
            if (!skipLoad) {
                loadEcontData();
            }
        } else if (type === 'home') {
            $(ADDRESS_FIELDS.join(',')).hide();
            $(ECONT_FIELDS.join(',')).hide();
            // Make econt fields non-required
            $('#billing_econt_office_city_field').removeClass('validate-required');
            $('#billing_econt_office_field').removeClass('validate-required');
            // Make address fields non-required
            $(ADDRESS_FIELDS.join(',')).removeClass('validate-required');
            // Show home fields
            $(HOME_FIELDS.join(',')).show();
            // Make home city + street required
            $('#billing_home_city_field').addClass('validate-required');
            $('#billing_home_street_name_field').addClass('validate-required');
            if (!skipLoad) {
                loadHomeCities();
            }
        } else {
            // other types: show address fields
            $(ADDRESS_FIELDS.join(',')).show();
            $(ADDRESS_FIELDS.join(',')).addClass('validate-required');
            $(ECONT_FIELDS.join(',')).hide();
            $(HOME_FIELDS.join(',')).hide();
            $('#billing_econt_office_city_field').removeClass('validate-required');
            $('#billing_econt_office_field').removeClass('validate-required');
            $(HOME_FIELDS.join(',')).removeClass('validate-required');
        }
    }

    /* ── Econt Offices API ── */

    function loadEcontData() {
        if (econtOfficesData) {
            populateEcontCities();
            return;
        }
        if (econtLoading) return;
        econtLoading = true;

        var $citySelect = $('#billing_econt_office_city');
        $citySelect.prop('disabled', true);
        $citySelect.empty().append('<option value="">Зареждане...</option>');

        $.ajax({
            url: ECONT_OFFICES_URL,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ countryCode: 'BG' }),
            timeout: 15000,
            success: function (response) {
                econtLoading = false;
                if (response && response.offices && response.offices.length) {
                    econtOfficesData = response.offices;
                    populateEcontCities();
                } else {
                    $citySelect.empty().append('<option value="">Грешка при зареждане</option>');
                    $citySelect.prop('disabled', false);
                }
            },
            error: function () {
                econtLoading = false;
                $citySelect.empty().append('<option value="">Грешка при зареждане — опитайте отново</option>');
                $citySelect.prop('disabled', false);
            }
        });
    }

    function populateEcontCities() {
        var $citySelect = $('#billing_econt_office_city');
        var cityMap = {};

        if (!econtOfficesData) return;

        econtOfficesData.forEach(function (office) {
            if (office.address && office.address.city && office.address.city.name) {
                var name = office.address.city.name;
                cityMap[name] = true;
            }
        });

        var cities = Object.keys(cityMap).sort(function (a, b) {
            return a.localeCompare(b, 'bg');
        });

        $citySelect.empty();
        $citySelect.append('<option value="">Въведете населено място</option>');
        cities.forEach(function (city) {
            $citySelect.append('<option value="' + escHtml(city) + '">' + escHtml(city) + '</option>');
        });
        $citySelect.prop('disabled', false);

        // Restore saved city if any
        var savedCity = $citySelect.data('saved-value') || '';
        if (savedCity) {
            $citySelect.val(savedCity);
            if ($citySelect.val()) {
                populateOffices(savedCity);
            }
        }

        refreshSelect2($citySelect);
    }

    function populateOffices(cityName) {
        var $officeSelect = $('#billing_econt_office');
        $officeSelect.empty();
        $officeSelect.append('<option value="">Изберете Офис</option>');

        if (!econtOfficesData || !cityName) return;

        var offices = econtOfficesData.filter(function (office) {
            return office.address &&
                office.address.city &&
                office.address.city.name === cityName;
        });

        offices.sort(function (a, b) {
            return (a.name || '').localeCompare(b.name || '', 'bg');
        });

        offices.forEach(function (office) {
            var label = office.name || office.code;
            if (office.address && office.address.fullAddress) {
                label += ' — ' + office.address.fullAddress;
            }
            $officeSelect.append(
                '<option value="' + escHtml(office.code) + '">' + escHtml(label) + '</option>'
            );
        });

        // Restore saved office if any
        var savedOffice = $officeSelect.data('saved-value') || '';
        if (savedOffice) {
            $officeSelect.val(savedOffice);
        }

        refreshSelect2($officeSelect);
    }

    /* ── Home Delivery — Cities API ── */

    function loadHomeCities() {
        if (homeCitiesData) {
            populateHomeCities();
            return;
        }
        if (homeCitiesLoading) return;
        homeCitiesLoading = true;

        var $citySelect = $('#billing_home_city');
        $citySelect.prop('disabled', true);
        $citySelect.empty().append('<option value="">Зареждане...</option>');

        $.ajax({
            url: ECONT_CITIES_URL,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ countryCode: 'BG' }),
            timeout: 20000,
            success: function (response) {
                homeCitiesLoading = false;
                if (response && response.cities && response.cities.length) {
                    homeCitiesData = response.cities;
                    populateHomeCities();
                } else {
                    $citySelect.empty().append('<option value="">Грешка при зареждане</option>');
                    $citySelect.prop('disabled', false);
                }
            },
            error: function () {
                homeCitiesLoading = false;
                $citySelect.empty().append('<option value="">Грешка при зареждане — опитайте отново</option>');
                $citySelect.prop('disabled', false);
            }
        });
    }

    function populateHomeCities() {
        var $citySelect = $('#billing_home_city');

        if (!homeCitiesData) return;

        // Sort by name
        var sorted = homeCitiesData.slice().sort(function (a, b) {
            return (a.name || '').localeCompare(b.name || '', 'bg');
        });

        $citySelect.empty();
        $citySelect.append('<option value="">Въведете населено място</option>');
        sorted.forEach(function (city) {
            var label = city.name;
            if (city.postCode) {
                label += ' [п.к.:' + city.postCode + ']';
            }
            $citySelect.append(
                '<option value="' + escHtml(String(city.id)) + '" data-name="' + escHtml(city.name) + '" data-postcode="' + escHtml(city.postCode || '') + '">' + escHtml(label) + '</option>'
            );
        });
        $citySelect.prop('disabled', false);

        // Restore saved city if any
        var savedCity = $citySelect.data('saved-value') || '';
        if (savedCity) {
            $citySelect.val(savedCity);
            if ($citySelect.val()) {
                loadHomeQuarters($citySelect.val());
            }
        }

        refreshSelect2($citySelect);
    }

    /* ── Home Delivery — Quarters API ── */

    function loadHomeQuarters(cityID) {
        var $quarterSelect = $('#billing_home_quarter');
        $quarterSelect.empty();
        $quarterSelect.append('<option value="">Зареждане...</option>');
        $quarterSelect.prop('disabled', true);

        if (!cityID) {
            $quarterSelect.empty().append('<option value="">ПОСОЧЕТЕ КВАРТАЛ</option>');
            $quarterSelect.prop('disabled', false);
            refreshSelect2($quarterSelect);
            return;
        }

        $.ajax({
            url: ECONT_QUARTERS_URL,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ countryCode: 'BG', cityID: parseInt(cityID, 10) }),
            timeout: 15000,
            success: function (response) {
                $quarterSelect.empty();
                $quarterSelect.append('<option value="">ПОСОЧЕТЕ КВАРТАЛ</option>');

                if (response && response.quarters && response.quarters.length) {
                    var sorted = response.quarters.slice().sort(function (a, b) {
                        return (a.name || '').localeCompare(b.name || '', 'bg');
                    });
                    sorted.forEach(function (q) {
                        $quarterSelect.append(
                            '<option value="' + escHtml(q.name) + '">' + escHtml(q.name) + '</option>'
                        );
                    });
                }
                $quarterSelect.prop('disabled', false);
                refreshSelect2($quarterSelect);
            },
            error: function () {
                $quarterSelect.empty().append('<option value="">ПОСОЧЕТЕ КВАРТАЛ</option>');
                $quarterSelect.prop('disabled', false);
                refreshSelect2($quarterSelect);
            }
        });
    }

    /* ── Map home fields to WC billing fields before submit ── */

    function mapHomeFieldsToBilling() {
        var deliveryType = $('#billing_delivery_type').val();
        if (deliveryType !== 'home') return;

        var $cityOption = $('#billing_home_city option:selected');
        var cityName = $cityOption.data('name') || '';
        var postCode = $cityOption.data('postcode') || '';

        // Set hidden fields for PHP to read
        ensureHiddenField('billing_home_city_name', cityName);
        ensureHiddenField('billing_home_city_postcode', postCode);

        // Also fill standard WC fields so validation passes
        $('#billing_city').val(cityName);
        $('#billing_postcode').val(postCode);

        var street = $('#billing_home_street_name').val() || '';
        var streetNum = $('#billing_home_street_number').val() || '';
        var block = $('#billing_home_block').val() || '';
        var entrance = $('#billing_home_entrance').val() || '';
        var floor = $('#billing_home_floor').val() || '';
        var apartment = $('#billing_home_apartment').val() || '';

        var addr1Parts = [];
        if (street) addr1Parts.push('ул. ' + street);
        if (streetNum) addr1Parts.push('№ ' + streetNum);
        if (block) addr1Parts.push('бл. ' + block);

        var addr2Parts = [];
        if (entrance) addr2Parts.push('вх. ' + entrance);
        if (floor) addr2Parts.push('ет. ' + floor);
        if (apartment) addr2Parts.push('ап. ' + apartment);

        $('#billing_address_1').val(addr1Parts.join(', '));
        $('#billing_address_2').val(addr2Parts.join(', '));
    }

    function ensureHiddenField(name, value) {
        var $field = $('input[name="' + name + '"]');
        if ($field.length) {
            $field.val(value);
        } else {
            $('form.checkout').append('<input type="hidden" name="' + name + '" value="' + escHtml(value) + '">');
        }
    }

    /* ── Helpers ── */

    function refreshSelect2($el) {
        if (typeof $.fn.select2 !== 'undefined' && $el.hasClass('select2-hidden-accessible')) {
            $el.trigger('change.select2');
        }
    }

    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    /* ── Init ── */

    function init() {
        // Delivery type button clicks (delegated + custom event)
        $(document).on('click', '.delivery-type', function () {
            var type = $(this).data('type');
            if (type) setDeliveryType(type);
        });
        $(document).on('noriks-delivery-change', '.delivery-type', function (e, type) {
            if (type) setDeliveryType(type);
        });

        // Econt: City change → load offices
        $(document).on('change', '#billing_econt_office_city', function () {
            var city = $(this).val();
            populateOffices(city);
        });

        // Home: City change → load quarters
        $(document).on('change', '#billing_home_city', function () {
            var cityID = $(this).val();
            loadHomeQuarters(cityID);
        });

        // Map home fields before checkout submit
        $(document).on('checkout_place_order', 'form.checkout', function () {
            mapHomeFieldsToBilling();
        });

        // Set initial state based on hidden input (survives WC update_checkout re-render)
        var initialType = $('#billing_delivery_type').val() || 'econt';
        setDeliveryType(initialType);
    }

    $(document).ready(function () {
        init();
    });

    // Re-init after WC AJAX checkout update
    $(document.body).on('updated_checkout', function () {
        // Restore delivery type from hidden input
        var type = $('#billing_delivery_type').val() || 'econt';
        setDeliveryType(type, true);

        // Re-populate dropdowns if data is cached
        if (type === 'econt' && econtOfficesData) {
            populateEcontCities();
        }
        if (type === 'home' && homeCitiesData) {
            populateHomeCities();
        }
    });

})(jQuery);
