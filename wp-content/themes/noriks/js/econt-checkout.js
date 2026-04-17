/**
 * Econt Office Checkout Logic — Noriks BG
 * - Delivery type selector (home / econt office / boxnow)
 * - Loads Econt offices from API
 * - Shows/hides address fields based on delivery type
 */
(function ($) {
    'use strict';

    var ECONT_API_URL = 'https://ee.econt.com/services/Nomenclatures/NomenclaturesService.getOffices.json';

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

    var econtOfficesData = null; // cached offices
    var econtLoading = false;

    /* ── Delivery type switching ── */

    function setDeliveryType(type, skipLoad) {
        $('#billing_delivery_type').val(type);

        $('.delivery-type').removeClass('active');
        $('.delivery-type[data-type="' + type + '"]').addClass('active');

        if (type === 'econt') {
            $(ADDRESS_FIELDS.join(',')).hide();
            // Make address fields non-required when econt selected
            $(ADDRESS_FIELDS.join(',')).find('input, select').each(function () {
                $(this).data('noriks-was-required', $(this).closest('.form-row').hasClass('validate-required'));
            });
            $(ADDRESS_FIELDS.join(',')).removeClass('validate-required');
            $(ECONT_FIELDS.join(',')).show();
            // Make econt fields required
            $('#billing_econt_office_city_field').addClass('validate-required');
            $('#billing_econt_office_field').addClass('validate-required');
            if (!skipLoad) {
                loadEcontData();
            }
        } else {
            // home or boxnow: show address fields
            $(ADDRESS_FIELDS.join(',')).show();
            // Restore required on address fields
            $(ADDRESS_FIELDS.join(',')).addClass('validate-required');
            $(ECONT_FIELDS.join(',')).hide();
            // Make econt fields non-required
            $('#billing_econt_office_city_field').removeClass('validate-required');
            $('#billing_econt_office_field').removeClass('validate-required');
        }
    }

    /* ── Econt API ── */

    function loadEcontData() {
        if (econtOfficesData) {
            populateCities();
            return;
        }
        if (econtLoading) return;
        econtLoading = true;

        var $citySelect = $('#billing_econt_office_city');
        $citySelect.prop('disabled', true);
        $citySelect.empty().append('<option value="">Зареждане...</option>');

        $.ajax({
            url: ECONT_API_URL,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ countryCode: 'BG' }),
            timeout: 15000,
            success: function (response) {
                econtLoading = false;
                if (response && response.offices && response.offices.length) {
                    econtOfficesData = response.offices;
                    populateCities();
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

    function populateCities() {
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
        $citySelect.append('<option value="">\u0412\u044a\u0432\u0435\u0434\u0435\u0442\u0435 \u043d\u0430\u0441\u0435\u043b\u0435\u043d\u043e \u043c\u044f\u0441\u0442\u043e</option>');
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

        // Refresh Select2 if present
        if (typeof $.fn.select2 !== 'undefined' && $citySelect.hasClass('select2-hidden-accessible')) {
            $citySelect.trigger('change.select2');
        }
    }

    function populateOffices(cityName) {
        var $officeSelect = $('#billing_econt_office');
        $officeSelect.empty();
        $officeSelect.append('<option value="">\u0418\u0437\u0431\u0435\u0440\u0435\u0442\u0435 \u041e\u0444\u0438\u0441</option>');

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

        // Refresh Select2 if present
        if (typeof $.fn.select2 !== 'undefined' && $officeSelect.hasClass('select2-hidden-accessible')) {
            $officeSelect.trigger('change.select2');
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
        // Delivery type button clicks
        $(document).on('click', '.delivery-type', function () {
            var type = $(this).data('type');
            if (type) setDeliveryType(type);
        });

        // City change → load offices
        $(document).on('change', '#billing_econt_office_city', function () {
            var city = $(this).val();
            populateOffices(city);
        });

        // Set initial state based on hidden input (survives WC update_checkout re-render)
        var initialType = $('#billing_delivery_type').val() || 'home';
        setDeliveryType(initialType, true);

        // If econt was already selected and data is cached, populate
        if (initialType === 'econt' && econtOfficesData) {
            populateCities();
        }
    }

    $(document).ready(function () {
        init();
    });

    // Re-init after WC AJAX checkout update
    $(document.body).on('updated_checkout', function () {
        // Restore delivery type from hidden input
        var type = $('#billing_delivery_type').val() || 'home';
        setDeliveryType(type, true);

        // Re-populate econt dropdowns if econt was selected and data is cached
        if (type === 'econt' && econtOfficesData) {
            populateCities();
        }
    });

})(jQuery);
