var $econt_aiaks;
var $econt_flf_el;
var $econt_town_city_id;
var $econt_local_storage;
var $econt_lang;
var $econt_flf_el;
var $econt_add_loading_link;

jQuery(document).ready(function($){
//econt checkout and order office autocomplete
$econt_local_storage = localStorage.econt ? JSON.parse(localStorage.econt) : new Object;
$econt_lang = document.getElementsByTagName('html')[0].getAttribute('lang');
//econt checkout and order office autocompleteselect2
jQuery("#econt_offices, #woocommerce_econt_shipping_method_office_code, #econt_sender_offices").select2({
  language: {
    inputTooShort: function () {
      return econt_php_vars.selectStartTypingText;
    },
    noResults: function(){
      return econt_php_vars.selectNRFText;
    },
    searching: function(){
      return econt_php_vars.selectSearchOfficeText;
    },
    errorLoading:function(){
      return econt_php_vars.selectSearchOfficeText;
    },
  }
});

//fix a bug which shrinks the width with some WP themes
if(econt_php_vars.isCheckout){
  setTimeout(function(){
    jQuery(".select2-container").css("width", "100%");
  }, 500);
  //offices map
  jQuery('#econt_offices_map, #econt_apts_map, #map').width(jQuery('#econt_offices_map').parent().width());
}else{ //order edit page
  //offices map
  var mapWidth = jQuery('.econt-table').width();
  if(mapWidth == 0){
    mapWidth = 400;
  }
  jQuery('#econt_offices_map, #econt_apts_map, #map').width(mapWidth);
}

jQuery('#econt_offices_town, #woocommerce_econt_shipping_method_office_town, #econt_sender_offices_town').select2({
  language: {
  inputTooShort: function () {
    return econt_php_vars.selectSelectResultsText;
  },
  noResults: function(){
    return econt_php_vars.selectNRFText;
  },
  searching: function(){
    return econt_php_vars.selectSearchPlaceText;
  },
  errorLoading:function(){
      return econt_php_vars.selectSearchPlaceText;
    },
},
  minimumInputLength: 2,
  ajax: {
    //url: ajaxurl,
    url: econt_php_vars.ajaxURL,
    dataType: 'json',
    delay: econt_php_vars.autocompleteAjaxDelay,
    data: function (params) {
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    var queryParameters = {
      lang: $econt_lang,
      city: params.term,
      country_code: country_code,
      action:'econt_handle_ajax', 
    }

    return queryParameters;
    },
    processResults: function (data) {
      return {
        results: data
      };
    },
    cache: true,

  },
  
});

jQuery('#econt_door_street').on('select2:select', function (e) {
  var data = e.params.data;
  localStorageUpdate(data, 'econt_door_street_selected');
});

jQuery('#econt_door_quarter').on('select2:select', function (e) {
  var data = e.params.data;
  localStorageUpdate(data, 'econt_door_quarter_selected');
});

jQuery('#econt_offices').on('select2:select', function (e) {
  var data = e.params.data;
  localStorageUpdate(data, 'econt_office_offices_selected');
});

jQuery('#econt_machines').on('select2:select', function (e) {
  var data = e.params.data;
  localStorageUpdate(data, 'econt_machine_machines_selected');
});
if(jQuery('#econt_user_address').val() == 0){
  window.setTimeout(function() {
  if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_shipping_to')){
    if($('#econt_shipping_to_buttons_DOOR').length == 0) {
      jQuery('#econt_shipping_to').val($econt_local_storage.econt_shipping_to).trigger('change');
    }else{
      jQuery('#econt_shipping_to_buttons_' + $econt_local_storage.econt_shipping_to).attr('checked', true).trigger('change');
      
    }
  }
  }, 500 );
}
jQuery('#econt_offices_town, #woocommerce_econt_shipping_method_office_town, #econt_sender_offices_town').on('select2:select', function (e) {
    jQuery('#econtLoader').show();
    var data = e.params.data;
    localStorageUpdate(data, 'econt_offices_town_selected');
    jQuery('#econt_offices_postcode, #woocommerce_econt_shipping_method_office_postcode, #econt_sender_offices_postcode').prop('value', data.post_code);
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    jQuery('#econt_offices_field, #econt_sender_offices_field').slideDown();

    if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
      jQuery('#econt_offices_map').slideDown();
    }

    jQuery.ajax({
      //url: ajaxurl,
      url: econt_php_vars.ajaxURL,
      dataType: "json",
      data: {
      lang: $econt_lang,
      action:'econt_handle_ajax', 
      office_city_id: data.city_id,
      office_city_name: data.id, 
      delivery_type: 'to_office'
      },
      success: function( data ) {
        jQuery('#econtLoader').hide();
        jQuery('#econt_offices, #woocommerce_econt_shipping_method_office_code, #econt_sender_offices').empty();
        //load maps with offices
        var markersOffices = [];

        jQuery.each(data, function(key, value) {

          var newOption = new Option(value.value + ' [о.к.:' + value.id + ']', value.id, false, false);
          jQuery('#econt_offices, #woocommerce_econt_shipping_method_office_code, #econt_sender_offices').append(newOption).trigger('change');
          markersOffices.push({
            "id": value.id,
            "title": value.name,
            "lat": value.latitude,
            "lng": value.longitude,
            "description": value.description,
            //"icon": speedy_php_vars.openLayersMapsOfficeIcon
          });

        });
        localStorageUpdate(data, 'econt_office_offices');
        if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
          jQuery('#econt_offices_map').empty();
          window.setTimeout(function() {
              load_map(markersOffices, 'office');
          }, 500);
        }
        
        if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
          jQuery(".select2-container").css("width", "100%"); //fix a bug which shrinks the width with some WP themes
          //calculate_loading(); //calculate loading cost for shipping to office
        }
        calculate_loading(); //calculate loading cost for shipping to office
      }
    });

});

//end of econt checkout and order office autocomplete

//econt checkout and order machine autocomplete

jQuery("#econt_machines, #woocommerce_econt_shipping_method_machine_machine").select2({
  language: {
    inputTooShort: function () {
      return econt_php_vars.selectStartTypingText;
    },
    noResults: function(){
      return econt_php_vars.selectNRFText;
    },
    searching: function(){
      return econt_php_vars.selectSearchAPSText;
    },
    errorLoading:function(){
      return econt_php_vars.selectSearchAPSText;
    },
  }
});

jQuery('#econt_machines_town, #woocommerce_econt_shipping_method_machine_town').select2({
  language: {
  // You can find all of the options in the language files provided in the
  // build. They all must be functions that return the string that should be
  // displayed.
  inputTooShort: function () {
      return econt_php_vars.selectSelectResultsText;
    },
    noResults: function(){
      return econt_php_vars.selectNRFText;
    },
    searching: function(){
      return econt_php_vars.selectSearchPlaceText;
    },
    errorLoading:function(){
      return econt_php_vars.selectSearchPlaceText;
    },
  },
  minimumInputLength: 2,
  ajax: {
    //url: ajaxurl,
    url: econt_php_vars.ajaxURL,
    dataType: 'json',
    delay: econt_php_vars.autocompleteAjaxDelay,
    data: function (params) {
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    var queryParameters = {
      //q: params.q,
      lang: $econt_lang,
      city: params.term,
      country_code: country_code,
      action:'econt_handle_ajax', 
    }
    return queryParameters;
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
        //results: [{"text":"Sofia","id":"41"},{"text":"Varna","id":"26382"}]
      };
    },
    cache: true,
  },
  
});

jQuery('#econt_machines_town, #woocommerce_econt_shipping_method_machine_town').on('select2:select', function (e) {
    jQuery('#econtLoader').show();
    var data = e.params.data;
    localStorageUpdate(data, 'econt_machines_town_selected');
    jQuery('#econt_machines_postcode, #woocommerce_econt_shipping_method_machine_postcode').prop('value', data.post_code);
    jQuery('#econt_machines_field').slideDown();

    if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
      jQuery('#econt_machines_map').slideDown();
    }

    jQuery.ajax({
      //url: ajaxurl,
      url: econt_php_vars.ajaxURL,
      dataType: "json",
      data: {
      lang: $econt_lang,
      action:'econt_handle_ajax', 
      machine_city_id: data.city_id,
      machine_city_name: data.id,
      delivery_type: 'to_office'
      },
      success: function( data ) {
        jQuery('#econtLoader').hide();
        jQuery('#econt_machines, #woocommerce_econt_shipping_method_machine_code').empty();
        var markersMachines = [];
        jQuery.each(data, function(key, value) {

          var newOption = new Option(value.value + ' [о.к.:' + value.id + ']', value.id, false, false);
          jQuery('#econt_machines, #woocommerce_econt_shipping_method_machine_code').append(newOption).trigger('change');

          markersMachines.push({
              "id": value.id,
              "title": value.name,
              "lat": value.latitude,
              "lng": value.longitude,
              "description": value.description,
              //"icon": speedy_php_vars.openLayersMapsOfficeIcon
          });

        });
        localStorageUpdate(data, 'econt_machine_machines');
        if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
          jQuery('#econt_machines_map').empty();
          window.setTimeout(function() {
              load_map(markersMachines, 'machine');
          }, 500);
        }

        if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
          jQuery(".select2-container").css("width", "100%"); //fix a bug which shrinks the width with some WP themes
          calculate_loading(); //calculate loading cost for shipping to office
        }
      }
    });

});
//end of econt checkout and order machine autocomplete


//econt admin settings office autocomplete
jQuery( "#woocommerce_econt_shipping_method_office_town" ).autocomplete({
minLength: 2,
source: function( request, response ) {
jQuery.ajax({
//url: ajaxurl,
url: econt_php_vars.ajaxURL,
dataType: "json",
data: {
lang: $econt_lang,
action:'econt_handle_ajax', 
city: request.term

},
success: function( data ) {
  response(jQuery.map(data, function(item) {
                        return {
                            label:      item.label,
                            value:      item.value,
                            city_id:    item.id,
                            post_code:   item.post_code
                            
                       };
                }));

},


});
},



select: function( event, ui ) {
   
var city_id = ui.item.city_id;
var post_code = ui.item.post_code;


jQuery('#woocommerce_econt_shipping_method_office_postcode').val(post_code);

jQuery.ajax({
url: ajaxurl,
dataType: "json",
data: {
lang: $econt_lang,
action:'econt_handle_ajax', 
office_city_id: city_id,
delivery_type: 'from_office'

},
success: function( data ) {

 jQuery('#woocommerce_econt_shipping_method_office_office').empty()

//selectValues = { "1": "test 1", "2": "test 2" };
jQuery.each(data, function(key, value) {
    jQuery('#woocommerce_econt_shipping_method_office_office').append(jQuery("<option/>", {
        value: value.id,
        text: value.value
    }));
    
});
jQuery('#woocommerce_econt_shipping_method_office_office').on('change, click', function() {
jQuery('#woocommerce_econt_shipping_method_office_code').val(this.value);

});

}
});

},

});

//econt checkout and order to/from door autocomplete
jQuery('#econt_door_town').select2({
  language: {
  inputTooShort: function () {
    return econt_php_vars.selectSelectResultsText;
  },
  noResults: function(){
    return econt_php_vars.selectNRFText;
  },
  searching: function(){
    return econt_php_vars.selectSearchPlaceText;
  },
  errorLoading:function(){
    return econt_php_vars.selectSearchPlaceText;
  },
},
  minimumInputLength: 2,
  ajax: {
    //url: ajaxurl,
    url: econt_php_vars.ajaxURL,
    dataType: 'json',
    delay: econt_php_vars.autocompleteAjaxDelay,
    data: function (params) {
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }

    var queryParameters = {
      //q: params.q,
      lang: $econt_lang,
      city: params.term,
      country_code: country_code,
      action:'econt_handle_ajax', 
    }

    return queryParameters;
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
        //results: [{"text":"Sofia","id":"41"},{"text":"Varna","id":"26382"}]
      };
    },
    cache: true,
  },
  
});

jQuery('#econt_door_town').on('select2:select', function (e) {
    $econt_town_city_id = e.params.data.city_id;
    var data = e.params.data;
    localStorageUpdate(data, 'econt_door_town_selected');
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    //jQuery('#econt_door_street, #econt_door_quarter').select2('enable');
    if(country_code == 'RO' || country_code == 'GR'){
      jQuery('#econt_door_street_intl_field, #econt_door_quarter_intl_field, #econt_door_street_num_field, #econt_door_street_bl_field, #econt_door_street_vh_field, #econt_door_street_et_field, #econt_door_street_ap_field, #econt_door_other_field, #econt_delivery_days_field, #econt_priority_time_type_field, #econt_priority_time_hour_field').slideDown();
    }else{
      jQuery('#econt_door_street_field, #econt_door_quarter_field, #econt_door_street_num_field, #econt_door_street_bl_field, #econt_door_street_vh_field, #econt_door_street_et_field, #econt_door_street_ap_field, #econt_door_other_field, #econt_delivery_days_field, #econt_priority_time_type_field, #econt_priority_time_hour_field').slideDown();
    }
    jQuery('#econt_door_postcode').prop('value', e.params.data.post_code);
    if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
      calculate_loading(); //calculate loading cost for shipping to office
    }

    if(econt_php_vars.hideQuarterFields == 1){
      setTimeout(function(){
      jQuery('#econt_door_quarter_field, #econt_door_street_bl_field').hide();
      }, 50);
    }
});


jQuery('#econt_door_street').select2({
  language: {
    // You can find all of the options in the language files provided in the
    // build. They all must be functions that return the string that should be
    // displayed.
    inputTooShort: function () {
      return econt_php_vars.selectSelectResultsText;
    },
    noResults: function(){
      return econt_php_vars.selectNRFText;
    },
    searching: function(){
      return econt_php_vars.selectStreetSearchText;
    },
    errorLoading:function(){
      return econt_php_vars.selectStreetSearchText;
    },
  },
  //containerCssClass: 'mysel-con',
  allowClear: true,
  minimumInputLength: 2,
  ajax: {
    //url: ajaxurl,
    url: econt_php_vars.ajaxURL,
    dataType: 'json',
    delay: econt_php_vars.autocompleteAjaxDelay,
    data: function (params) {
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    var queryParameters = {
      //q: params.q,
      lang: $econt_lang,
      action:'econt_handle_ajax',
      door_city_id: $econt_town_city_id,
      door_street_name: params.term,
      country_code: country_code,
      type: 'street' 
    }

    return queryParameters;
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
        //results: [{"text":"Sofia","id":"41"},{"text":"Varna","id":"26382"}]
      };
    },
    cache: true,
  },
  
});


jQuery('#econt_door_quarter').select2({
  language: {
    // You can find all of the options in the language files provided in the
    // build. They all must be functions that return the string that should be
    // displayed.
    inputTooShort: function () {
      return econt_php_vars.selectSelectResultsText;
    },
    noResults: function(){
      return econt_php_vars.selectNRFText;
    },
    searching: function(){
      return econt_php_vars.selectSearchNeighborhoodText;
    },
    errorLoading:function(){
      return econt_php_vars.selectSearchNeighborhoodText;
    },
  },
  allowClear: true,
  minimumInputLength: 2,
  ajax: {
    //url: ajaxurl,
    url: econt_php_vars.ajaxURL,
    dataType: 'json',
    delay: econt_php_vars.autocompleteAjaxDelay,
    data: function (params) {
    var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    var queryParameters = {
      //q: params.q,
      lang: $econt_lang,
      action:'econt_handle_ajax',
      door_city_id: $econt_town_city_id,
      door_quarter_name: params.term,
      country_code: country_code,
      type: 'quarter' 
    }

    return queryParameters;
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
        //results: [{"text":"Sofia","id":"41"},{"text":"Varna","id":"26382"}]
      };
    },
    cache: true,
  },
  
});

//International Streets and Quarters Autocomplete

jQuery( "#econt_door_street_intl" ).autocomplete({
minLength: 2,
source: function( request, response ) {
var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
if(!econt_php_vars.isCheckout){
  country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
}
jQuery.ajax({
//url: ajaxurl,
url: econt_php_vars.ajaxURL,
dataType: "json",
data: {
lang: $econt_lang,
action:'econt_handle_ajax', 
//city: request.term
door_city_id: $econt_town_city_id,
door_street_name: request.term,
country_code: country_code,
type: 'street'

},
success: function( data ) {
//response( data );
  response(jQuery.map(data, function(item) {
                        return {
                            label:      item.text,
                            value:      item.id,
                            //city_id:    item.id,
                            //post_code:   item.post_code
                            
                       };
                }));



},




});
//calculate_loading(); //calculate loading to door
},

});





jQuery( "#econt_door_quarter_intl" ).autocomplete({
minLength: 2,
source: function( request, response ) {
var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
if(!econt_php_vars.isCheckout){
  country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
}

jQuery.ajax({
//url: ajaxurl,
url: econt_php_vars.ajaxURL,
dataType: "json",
data: {
lang: $econt_lang,
action:'econt_handle_ajax', 
//city: request.term
door_city_id: $econt_town_city_id,
door_quarter_name: request.term,
country_code: country_code,
type: 'quarter'

},
success: function( data ) {
//response( data );
  response(jQuery.map(data, function(item) {
                        return {
                            label:      item.text,
                            value:      item.id,
                            //city_id:    item.id,
                            //post_code:   item.post_code
                            
                       };
                }));

},


});
},

});

//end of econt checkout and order to/from door autocomplete


//hide and show fields in checkout and order

jQuery('#econt_shipping_to').on('change', function () {
    localStorageUpdate(this.value, 'econt_shipping_to');
    if(this.value == 'DOOR'){

jQuery('.econt_shipping_to_office').hide();
jQuery('.econt_shipping_to_machine').hide();
jQuery('.econt_office_locator_map').hide();


if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_door_town_selected')){
  //LocalStorage
  $econt_town_city_id = $econt_local_storage.econt_door_town_selected.city_id;
  var newOption = new Option($econt_local_storage.econt_door_town_selected.text, $econt_local_storage.econt_door_town_selected.id, true, true);
  $('#econt_door_town').append(newOption).trigger('change');
  jQuery('#econt_door_postcode').prop('value', $econt_local_storage.econt_door_town_selected.post_code);
  if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_door_street_selected')){
    var newOption = new Option($econt_local_storage.econt_door_street_selected.text, $econt_local_storage.econt_door_street_selected.id, false, false);
    $('#econt_door_street').append(newOption).trigger('change');
    var newOption = new Option($econt_local_storage.econt_door_street_selected.text, $econt_local_storage.econt_door_street_selected.id, true, true);
    $('#econt_door_street').append(newOption).trigger('change');
  }

  if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_door_quarter_selected')){
    var newOption = new Option($econt_local_storage.econt_door_quarter_selected.text, $econt_local_storage.econt_door_quarter_selected.id, true, true);
    $('#econt_door_quarter').append(newOption).trigger('change');
  }

  jQuery.each(['econt_door_street_num', 'econt_door_street_bl', 'econt_door_street_vh', 'econt_door_street_et', 'econt_door_street_ap', 'econt_door_other', 'econt_door_street_intl', 'econt_door_quarter_intl'], function(key, value) {
    if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, value)){
      $('#' + value).prop('value', $econt_local_storage[value]);
    }
  });

  var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
    if(!econt_php_vars.isCheckout){
      country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
    }
    //jQuery('#econt_door_street, #econt_door_quarter').select2('enable');
    if(country_code == 'RO' || country_code == 'GR'){
      jQuery('#econt_door_street_intl_field, #econt_door_quarter_intl_field, #econt_door_street_num_field, #econt_door_street_bl_field, #econt_door_street_vh_field, #econt_door_street_et_field, #econt_door_street_ap_field, #econt_door_other_field, #econt_delivery_days_field, #econt_priority_time_type_field, #econt_priority_time_hour_field').slideDown();
    }else{
      jQuery('#econt_door_street_field, #econt_door_quarter_field, #econt_door_street_num_field, #econt_door_street_bl_field, #econt_door_street_vh_field, #econt_door_street_et_field, #econt_door_street_ap_field, #econt_door_other_field, #econt_delivery_days_field, #econt_priority_time_type_field, #econt_priority_time_hour_field').slideDown();
    }
    


  if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
    calculate_loading(); //calculate loading cost for shipping to office
  }

}else{

jQuery('#econt_door_town').empty();
jQuery('#econt_door_postcode').removeAttr('value');
jQuery('#econt_door_street').empty();
jQuery('#econt_door_quarter').empty();
jQuery('#econt_door_street_intl').removeAttr('value');
jQuery('#econt_door_quarter_intl').removeAttr('value');
jQuery('#econt_door_street_num').removeAttr('value');
jQuery('#econt_door_street_bl').removeAttr('value');
jQuery('#econt_door_street_vh').removeAttr('value');
jQuery('#econt_door_street_et').removeAttr('value');
jQuery('#econt_door_street_ap').removeAttr('value');
jQuery('#econt_door_other').removeAttr('value');

}

jQuery('.econt_shipping_to_door').slideDown();
jQuery('#econt_door_postcode_field, #econt_door_street_field, #econt_door_quarter_field, #econt_door_street_intl_field, #econt_door_quarter_intl_field, #econt_door_street_num_field, #econt_door_street_bl_field, #econt_door_street_vh_field, #econt_door_street_et_field, #econt_door_street_ap_field, #econt_door_other_field, #econt_delivery_days_field, #econt_priority_time_type_field, #econt_priority_time_hour_field').hide();

}else if(this.value == 'OFFICE'){ 

jQuery('.econt_shipping_to_door').hide();
jQuery('.econt_shipping_to_machine').hide();
jQuery("#econt_city_courier_field").hide();
//jQuery('#econt_offices_map').hide();
jQuery('#econt_machines_map').hide();
if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_offices_town_selected') && Object.hasOwn($econt_local_storage, 'econt_office_offices')){
  //LocalStorage
  var newOption = new Option($econt_local_storage.econt_offices_town_selected.text, $econt_local_storage.econt_offices_town_selected.id, true, true);
  $('#econt_offices_town').append(newOption).trigger('change');
  var markersOffices = [];
  jQuery.each($econt_local_storage.econt_office_offices, function(key, value) {
    if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_office_offices_selected') && $econt_local_storage.econt_office_offices_selected.id == value.id){
      var newOption = new Option(value.value, value.id, true, true);
    }else{
      var newOption = new Option(value.value, value.id, false, false);
    }
    $('#econt_offices').append(newOption).trigger('change');

    markersOffices.push({
      "id": value.id,
      "title": value.name,
      "lat": value.latitude,
      "lng": value.longitude,
      "description": value.description,
      //"icon": speedy_php_vars.openLayersMapsOfficeIcon
    });

  });

  if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
    jQuery('#econt_offices_map').empty();
      window.setTimeout(function() {
        load_map(markersOffices, 'office');
    }, 500);
    jQuery('#econt_offices_map').slideDown();
  }

  jQuery('#econt_offices_postcode, #woocommerce_econt_shipping_method_office_postcode, #econt_sender_offices_postcode').prop('value', $econt_local_storage.econt_offices_town_selected.post_code);
  jQuery('#econt_offices_field, #econt_sender_offices_field').slideDown();
  if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
    calculate_loading(); //calculate loading cost for shipping to office
  }

}else{
  jQuery('#econt_offices_town').empty();
  jQuery('#econt_offices_postcode').removeAttr('value');
  jQuery('#econt_offices').empty();
}
//jQuery('.econt_shipping_to_office').slideToggle();
jQuery('.econt_shipping_to_office').slideDown();
jQuery('#econt_offices_postcode_field, #econt_offices_field').hide();

} else if(this.value == 'MACHINE'){
jQuery('.econt_shipping_to_door').hide();
jQuery('.econt_shipping_to_office').hide();
jQuery("#econt_city_courier_field").hide();
jQuery('#econt_offices_map').hide();
//jQuery('#econt_machines_map').hide();

if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_machines_town_selected') && Object.hasOwn($econt_local_storage, 'econt_machine_machines')){
  //LocalStorage
  var newOption = new Option($econt_local_storage.econt_machines_town_selected.text, $econt_local_storage.econt_machines_town_selected.id, true, true);
  $('#econt_machines_town').append(newOption).trigger('change');
  var markersMachines = [];
  jQuery.each($econt_local_storage.econt_machine_machines, function(key, value) {
    if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_machine_machines_selected') && $econt_local_storage.econt_machine_machines_selected.id == value.id){
      var newOption = new Option(value.value, value.id, true, true);
    }else{
      var newOption = new Option(value.value, value.id, false, false);
    }
    $('#econt_machines').append(newOption).trigger('change');

    markersMachines.push({
      "id": value.id,
      "title": value.name,
      "lat": value.latitude,
      "lng": value.longitude,
      "description": value.description,
      //"icon": speedy_php_vars.openLayersMapsOfficeIcon
    });

  });

  if( econt_php_vars.openLayersMapsOfficeLocator.length == 0 || econt_php_vars.openLayersMapsOfficeLocator == 1 ){
    jQuery('#econt_machines_map').empty();
      window.setTimeout(function() {
        load_map(markersMachines, 'machine');
    }, 500);
    jQuery('#econt_machines_map').slideDown();
  }

  jQuery('#econt_machines_postcode, #woocommerce_econt_shipping_method_machine_postcode, #econt_sender_machines_postcode').prop('value', $econt_local_storage.econt_machines_town_selected.post_code);
  jQuery('#econt_machines_field, #econt_sender_machines_field').slideDown();
  if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
    calculate_loading(); //calculate loading cost for shipping to office
  }

}else{
  jQuery('#econt_machines_town').empty();
  jQuery('#econt_machines_postcode').removeAttr('value');
  jQuery('#econt_machines').empty();
}

//jQuery('.econt_shipping_to_machine').slideToggle();
jQuery('.econt_shipping_to_machine').slideDown();
jQuery('#econt_machines_postcode_field, #econt_machines_field').hide();

} else if(this.value == 0) {

jQuery('.econt_shipping_to_door').hide();
jQuery('.econt_shipping_to_office').hide();
jQuery('.econt_shipping_to_machine').hide();
jQuery("#econt_city_courier_field").hide();
jQuery('.econt_office_locator_map').hide();


}

jQuery('#button_calculate_loading').val(econt_php_vars.calculateShippingCostText);

});

//admin order details show only the needed field when to/from APS
var receiver_shipping_to = jQuery("#receiver_shipping_to").val();
var sender_door_or_office = jQuery("#sender_door_or_office").val();
if( receiver_shipping_to == 'MACHINE' || sender_door_or_office == 'MACHINE' ){

 jQuery('.not_used_to_aps').hide();
 jQuery('.used_from_aps').hide();
jQuery('.priority_time').hide();
 
 if ( sender_door_or_office == 'MACHINE' && receiver_shipping_to != 'MACHINE' ) {
 
 jQuery('.used_from_aps').slideDown();
 
 if( receiver_shipping_to == 'DOOR' ){
   jQuery('.priority_time').slideDown(); 
 }


 }


}

//hide size under 60cm if not office to office
if ( sender_door_or_office != 'OFFICE' || receiver_shipping_to != 'OFFICE' ) {
    jQuery('#size_under_60cm').hide();
}

jQuery('#sender_door_or_office').on('change', function () {
 if( (this.value == 'DOOR' && receiver_shipping_to != 'MACHINE') || (this.value == 'DOOR2' && receiver_shipping_to != 'MACHINE') || (this.value == 'OFFICE' && receiver_shipping_to != 'MACHINE') ){

jQuery('#order_cd').removeAttr('disabled');
 jQuery('.not_used_to_aps').slideDown();
 jQuery('.used_from_aps').slideDown();
 jQuery('.priority_time').slideDown();
 jQuery('#row_order_cd').slideDown();


 } else if(this.value == 'MACHINE' || receiver_shipping_to == 'MACHINE') {

 jQuery('.not_used_to_aps').hide();
 jQuery('.used_from_aps').hide();
 jQuery('.priority_time').hide();

 if ( this.value == 'MACHINE' && receiver_shipping_to != 'MACHINE' ) {
 
 jQuery('.used_from_aps').slideDown();
 
 if( receiver_shipping_to == 'DOOR' ){
   Query('.priority_time').slideDown(); 
 }


 }
}
//hide size under 60cm if not office to office
if(this.value != 'OFFICE'){
  jQuery('#size_under_60cm').hide();   
}

if(this.value == 'OFFICE' && receiver_shipping_to == 'OFFICE'){
  jQuery('#size_under_60cm').slideDown();
}

});

var woocommerce_econt_shipping_method_send_from = jQuery('#woocommerce_econt_shipping_method_send_from').val();

jQuery('#woocommerce_econt_shipping_method_send_from').on('change', function () {
if(this.value == 'MACHINE'){
if(jQuery('#woocommerce_econt_shipping_method_cd').val() == 1 && jQuery('#woocommerce_econt_shipping_method_client_cd_num').val() == 0 ){

//alert('Когато изпращате от АПС и активирате услугата плащане при доставка (наложен платеж) е задължително да изпозвате споразумение за събиране на наложен платеж!');
alert(econt_php_vars.apsAlertText2);
jQuery('#woocommerce_econt_shipping_method_send_from').val( woocommerce_econt_shipping_method_send_from );


} else {
    //alert('услуги, които можете да използвате, когато изпращате от АПС са:\n- наложен платеж (когато използвате споразумение за събиране на НП) \n- обратна разписка\n- двупосочна пратка\n- Час за приоритет (когато изпращате до адрес)\n- Преглед\n- Преглед и тест\n- Преглед, тест и избор');
    alert(econt_php_vars.apsAlertText2);
} 

}

});

//jQuery("#woocommerce_econt_shipping_method_refreshdata").prop('value', 'Обнови');
jQuery("#woocommerce_econt_shipping_method_refreshdata").prop('value', econt_php_vars.refreshText);
jQuery("#woocommerce_econt_shipping_method_refreshdata_intl").prop('value', econt_php_vars.refreshText);
//econt admin settings refresh econt offices and adresses
jQuery('#woocommerce_econt_shipping_method_refreshdata').click(function(){

    var username  = jQuery("#woocommerce_econt_shipping_method_username").val();
    var password  = jQuery("#woocommerce_econt_shipping_method_password").val();
    var live      = jQuery("#woocommerce_econt_shipping_method_live").val();


jQuery("#woocommerce_econt_shipping_method_refreshdata").prop('value', econt_php_vars.refreshWaitText);
jQuery("#woocommerce_econt_shipping_method_refreshdata").addClass('ui-autocomplete-loading');
    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data:{
        action:'econt_handle_ajax',
        refresh_data: 1
        }, 
        //type: 'post',


        success: function(data){
        jQuery("#woocommerce_econt_shipping_method_refreshdata").removeClass('ui-autocomplete-loading');
        jQuery("#woocommerce_econt_shipping_method_refreshdata").prop('value', data.msg);

            if(data.error === 1){
                alert(data.msg);
            }
        },
    });


});

//econt admin settings refresh econt international offices and cities
jQuery('#woocommerce_econt_shipping_method_refreshdata_intl').click(function(){

    var username  = jQuery("#woocommerce_econt_shipping_method_username").val();
    var password  = jQuery("#woocommerce_econt_shipping_method_password").val();
    var live      = jQuery("#woocommerce_econt_shipping_method_live").val();


jQuery("#woocommerce_econt_shipping_method_refreshdata_intl").prop('value', econt_php_vars.refreshWaitText);
jQuery("#woocommerce_econt_shipping_method_refreshdata_intl").addClass('ui-autocomplete-loading');
    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data:{
        action:'econt_handle_ajax',
        refresh_data_intl: 1
        }, 
        //type: 'post',


        success: function(data){
        jQuery("#woocommerce_econt_shipping_method_refreshdata_intl").removeClass('ui-autocomplete-loading');
        jQuery("#woocommerce_econt_shipping_method_refreshdata_intl").prop('value', data.msg);
            if(data.error === 1){
                alert(data.msg);
            }
        },
    });


});
//end of econt admin settings refresh econt offices and adresses


//start of econt admin sync profile and clients_access
jQuery("#woocommerce_econt_shipping_method_refreshprofile").prop('value', econt_php_vars.refreshText);

//econt admin settings sync econt profile and clients_access
jQuery("#woocommerce_econt_shipping_method_refreshprofile").click(function(){

    var username  = jQuery("#woocommerce_econt_shipping_method_username").val();
    var password  = jQuery("#woocommerce_econt_shipping_method_password").val();
    var live      = jQuery("#woocommerce_econt_shipping_method_live").val();



jQuery("#woocommerce_econt_shipping_method_refreshprofile").prop('value', econt_php_vars.refreshWaitText);
jQuery("#woocommerce_econt_shipping_method_refreshprofile").addClass('ui-autocomplete-loading');
    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data:{
        action:'econt_handle_ajax',
        sync_profile: 1,
        username: username,
        password: password,
        live: live,
        }, 
        //type: 'post',


        success: function(data){
        jQuery("#woocommerce_econt_shipping_method_refreshprofile").removeClass('ui-autocomplete-loading');
        jQuery("#woocommerce_econt_shipping_method_refreshprofile").prop('value', data.msg);
            //if(data.indexOf('Error') === -1){
            if(data.error === 0){
                location.reload();
            }else if(data.error === 1){
                alert(data.msg);
            }
        },
    });


});
//end of econt admin sync profile and clients_access


  var form = jQuery('#order_loading_form');

//admin order calculate or create loading
   jQuery("#order_only_calculate_loading").click( function() {

    var data2 = jQuery('#order_loading_form').serialize();
    jQuery('#econtLoader').show();

    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data: data2 + '&action=econt_handle_ajax&action2=only_calculate_loading',
        type: 'POST',
    
        success: function(data){
            jQuery('#econtLoader').hide();
            jQuery('#create_loading tr').remove();
            if(data.length !== 0){
                if( data['warning'] ){
                  alert( data['warning'] );
                } else if(data.length === 0) {
                  alert('Възникна грешка. Моля, проверете потребителското име и парола в настройките за доставка с Еконт.');
                } else{
                  var currency_symbol = jQuery.isNumeric(data['customer_shipping_cost']) ? data['currency_symbol'] : '';
                  jQuery('<tr><td>'+econt_php_vars.totalShippingCostText+'</td><td id="total_shipping_cost"><strong>'+data['total_shipping_cost']+data['currency_symbol']+'</strong></td></tr>').appendTo('#create_loading');
                  jQuery('<tr><td>'+econt_php_vars.totalShippingCustomerCostText+'</td><td id="customer_shipping_cost"><strong>'+data['customer_shipping_cost']+currency_symbol+'</strong></td></tr>').appendTo('#create_loading');
                }
            } else {
              alert('Възникна грешка. Моля, проверете потребителското име и парола в настройките за доставка с Еконт.');  
            }

        },
    });
  });

  jQuery("#order_create_loading").click( function() { 
    var $this = jQuery(this);
    $this.prop('disabled', true);
    var data2 = jQuery('#order_loading_form').serialize();
    jQuery('#econtLoader').show();

    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data: data2 + '&action=econt_handle_ajax&action2=create_loading',
        type: 'POST',

        
        success: function(data){   
        jQuery('#econtLoader').hide();
        jQuery('#create_loading tr').remove();

            if( data['warning'] ){ 
            alert( data['warning'] ); 
            } else if(data.length === 0) {
            alert('Възникна грешка. Моля, проверете потребителското име и парола в настройките за доставка с Еконт.');
            } else { 

                jQuery('<tr><td>'+econt_php_vars.loadingPdfLinkText+'</td><td id="pdf_url"><strong><a href="'+data['pdf_url']+'" target="_blank">'+data['pdf_url']+'</a></strong></td></tr>').appendTo('#create_loading');
            
            
               jQuery('<tr><td>'+econt_php_vars.loadingNumberText+'</td><td id="loading_num"><strong>'+data['loading_num']+'</strong></td></tr>').appendTo('#create_loading');
             
                
                jQuery('<tr><td>'+econt_php_vars.totalShippingCostText+'</td><td id="total_sum"><strong>'+data['total_shipping_cost']+data['currency_symbol']+'</strong></td></tr>').appendTo('#create_loading');
             
                
                jQuery('<tr><td>'+econt_php_vars.totalShippingCustomerCostText+'</td><td id="order_total_sum"><strong>'+data['customer_shipping_cost']+data['currency_symbol']+'</strong></td></tr>').appendTo('#create_loading');
             
                
                if(jQuery('.econt_wc_orders_list', window.parent.document).length){
                  
                  parent.$econt_add_loading_link(data['loading_num'], data['pdf_url']);
                  parent.jQuery.fn.colorbox.close();
                  
                }else{
                  location.reload();
                }
                //$this.prop('disabled', false);
            }
        },
    });
  });
//end of admin order calculate or create loading

//jQuery("#econt_offices_town", "#woocommerce_econt_shipping_method_office_town", "#econt_door_town", "#econt_door_street", "#econt_door_quarter").prop("autocomplete","off");

//hide econtLoading div in checkout
jQuery('#econtLoader').hide();

function calculate_loading(loading){

var econt_user_address = jQuery('#econt_user_address').val();
var country_code = jQuery('select[name=billing_country] option').filter(':selected').val();
if(!econt_php_vars.isCheckout){
  country_code = jQuery('select[name=_billing_country] option').filter(':selected').val();
}
var country_codes = {'RO': 'ROU', 'GR': 'GRC'};
var intl_delivery = (country_code == 'RO' || country_code == 'GR') ? true : false;

var econt_shipping_to = (econt_user_address == '1') ? jQuery("#econt_shipping_to_user").val() : jQuery("#econt_shipping_to").val();

var payment_method = '';

var receiver_country_code = ( intl_delivery == true ) ? country_codes[country_code] : 'BGR';
var receiver_city = '';
var receiver_post_code = '';
var receiver_office_code = '';
var receiver_street = '';
var receiver_quarter = '';
var receiver_street_num = '';
var receiver_street_bl = '';
var receiver_street_vh = '';
var receiver_street_et = '';
var receiver_street_ap = '';
var receiver_street_other = '';
var econt_city_courier = '';
var delivery_day_id = '';
var priority_time_type = '';
var priority_time_hour = '';

if(jQuery('#payment_method_cod').is(':checked')){ 
  payment_method = 'cod'; 
}

if(jQuery('#payment_method_econt_payment').is(':checked')){ 
  payment_method = 'econt_payment'; 
}

var pack_count = 1;

var receiver_name = jQuery("#billing_company").val();
var receiver_name_person = jQuery("#billing_first_name").val()+' '+jQuery("#billing_last_name").val();
//receiver_name = (receiver_name.length === 0) ? receiver_name_person : receiver_name;
receiver_name = (receiver_name) ? receiver_name : receiver_name_person;
var receiver_phone_num = jQuery("#billing_phone").val();
var receiver_email = jQuery("#billing_email").val();

if ( econt_shipping_to == 'DOOR' ){

receiver_city = (econt_user_address == '1') ? jQuery("#econt_door_town_user").val() : jQuery("#econt_door_town").val();
receiver_post_code = (econt_user_address == '1') ? jQuery("#econt_door_postcode_user").val() : jQuery("#econt_door_postcode").val();
receiver_street = (intl_delivery == true) ? (econt_user_address == '1') ? jQuery("#econt_door_street_intl_user").val() : jQuery("#econt_door_street_intl").val() : (econt_user_address == '1') ? jQuery("#econt_door_street_user").val() : jQuery("#econt_door_street").val();
receiver_quarter = (intl_delivery == true) ? (econt_user_address == '1') ? jQuery("#econt_door_quarter_intl_user").val() : jQuery("#econt_door_quarter_intl").val() : (econt_user_address == '1') ? jQuery("#econt_door_quarter_user").val() : jQuery("#econt_door_quarter").val();
receiver_street_num = (econt_user_address == '1') ? jQuery("#econt_door_street_num_user").val() : jQuery("#econt_door_street_num").val();
receiver_street_bl = (econt_user_address == '1') ? jQuery("#econt_door_street_bl_user").val() : jQuery("#econt_door_street_bl").val();
receiver_street_vh = (econt_user_address == '1') ? jQuery("#econt_door_street_vh_user").val() : jQuery("#econt_door_street_vh").val();
receiver_street_et = (econt_user_address == '1') ? jQuery("#econt_door_street_et_user").val() : jQuery("#econt_door_street_et").val();
receiver_street_ap = (econt_user_address == '1') ? jQuery("#econt_door_street_ap_user").val() : jQuery("#econt_door_street_ap").val();
receiver_street_other = (econt_user_address == '1') ? jQuery("#econt_door_other_user").val() : jQuery("#econt_door_other").val();
econt_city_courier = jQuery("#econt_city_courier").val();
delivery_day_id = jQuery("#econt_delivery_days").val();
priority_time_type = jQuery("#econt_priority_time_type").val();
priority_time_hour = jQuery("#econt_priority_time_hour").val();

}else if (econt_shipping_to == 'OFFICE'){

var receiver_city =  (econt_user_address == '1') ? jQuery("#econt_offices_town_user").val() : jQuery("#econt_offices_town").val();
var receiver_post_code = (econt_user_address == '1') ? jQuery("#econt_offices_postcode_user").val() : jQuery("#econt_offices_postcode").val();
var receiver_office_code = (econt_user_address == '1') ? jQuery("#econt_offices_user").val() : jQuery("#econt_offices").val();

}else if (econt_shipping_to == 'MACHINE'){

var receiver_city =  (econt_user_address == '1') ? jQuery("#econt_machines_town_user").val() : jQuery("#econt_machines_town").val();
var receiver_post_code = (econt_user_address == '1') ? jQuery("#econt_machines_postcode_user").val() : jQuery("#econt_machines_postcode").val();
var receiver_office_code = (econt_user_address == '1') ? jQuery("#econt_machines_user").val() : jQuery("#econt_machines").val();

}

if(receiver_city != null && receiver_city.length < 1){
  return;
}

if(typeof loading !== 'undefined'){    
    jQuery('#econtLoader').show();
    jQuery('input[type="submit"]').prop('disabled','disabled');
}

jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        
        data: {
        action: 'econt_handle_ajax',
        action2: 'only_calculate_loading',
        receiver_name: receiver_name,
        receiver_name_person: receiver_name_person,
        receiver_phone_num: receiver_phone_num,
        receiver_email: receiver_email,
        receiver_shipping_to: econt_shipping_to,
        receiver_country_code: receiver_country_code,
        receiver_city: receiver_city,
        receiver_post_code: receiver_post_code,
        receiver_office_code: receiver_office_code,
        receiver_street: receiver_street,
        receiver_quarter: receiver_quarter,
        receiver_street_num: receiver_street_num,
        receiver_street_bl: receiver_street_bl,
        receiver_street_vh: receiver_street_vh,
        receiver_street_et: receiver_street_et,
        receiver_street_ap: receiver_street_ap,
        receiver_street_other: receiver_street_other,
        econt_city_courier: econt_city_courier,
        delivery_day_id: delivery_day_id,
        priority_time_type: priority_time_type,
        priority_time_hour: priority_time_hour,
        pack_count: pack_count,
        payment_method: payment_method,

        },
        type: 'POST',

        success: function(data){
            if(data.length !== 0){
              if(data['warning']){
                alert( data['warning'] );
              } else{
                jQuery("#econt_customer_shipping_cost").prop('value', data['customer_shipping_cost'] );
                jQuery("#econt_total_shipping_cost").prop('value', data['total_shipping_cost'] );
                 
                if(econt_php_vars.incShippingCost == 1){
                  jQuery( 'body' ).trigger( 'update_checkout', ['calculate_loading'] ); //inc shipping cost fee
                  jQuery( 'body' ).on( 'updated_checkout', function() {
                    var customer_shipping_cost = jQuery("#econt_customer_shipping_cost").val();
                    if(typeof customer_shipping_cost !== 'undefined' && jQuery.isNumeric( customer_shipping_cost ) === false){
                      var dots = econt_php_vars.shippingMethodTitleType == 'image' ? '' : ':';
                      jQuery('label[for=shipping_method_0_econt_shipping_method]').html(econt_php_vars.shippingMethodTitle + dots + ' <span class="woocommerce-Price-amount amount">' + jQuery("#econt_customer_shipping_cost").val() + '</span>');
                    }
                  });
                }
                
                if(econt_php_vars.incShippingCost == 0){
                  jQuery('#econt_shipping_expenses').remove();
                  jQuery('.woocommerce-checkout-review-order-table tr:last').after('<tr id="econt_shipping_expenses"><td>'+econt_php_vars.shippingMethodTitle+'</td><td><strong>'+data['customer_shipping_cost']+data['currency_symbol']+'</strong></td></tr>').appendTo('.woocommerce-checkout-review-order-table');   
                }
              }
            }
            
            if(typeof loading !== 'undefined'){    
                jQuery('#econtLoader').hide();
                jQuery('input[type="submit"]').removeAttr('disabled');
            }

        },


 });

}

    //avtomatizirano kalkulirane na cenata za shipping i nalojen platej
    jQuery("#econt_door_other, #button_calculate_loading, #econt_door_street, #econt_door_quarter").on('click' , function(e){
       if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
        //calculate_loading();
      }

    });

    jQuery("#econt_city_courier, #econt_delivery_days, #econt_priority_time_hour").on('change' , function(e){
      if(econt_php_vars.isCheckout){ //if we are in checkout not in admin panel
        calculate_loading();
      }

    });

    //preizchislqva cenata za dostavka i NP pri smqna na payment method
    jQuery( 'body' ).on( 'updated_checkout', function() {
      jQuery('input[name="payment_method"]').change(function(){
        var loading = 'yes';
        calculate_loading(loading);
      });
    });
   
jQuery("#delete_loading").click(function(e){

var loading_num = jQuery("#loading_num").val();
jQuery('#econtLoader').show();

jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        
        data: {
        action: 'econt_handle_ajax',
        action2: 'delete_loading',
        loading_num: loading_num,

        },
        type: 'POST',

        success: function(data){

          if(data.error === 1){
            alert(data.msg);
          }
        jQuery('#econtLoader').hide();
        location.reload(); 

        },


 });

 });


jQuery("#button_request_of_courier").click(function(e){

window.open('http://ee.econt.com/?target=EeMyRequestOfCourier', '_blank');

});

//zabranqva promqnata na ofis kod i poshtenski ofis kod v admin nastrojkite na plugina
jQuery('#woocommerce_econt_shipping_method_office_postcode, #woocommerce_econt_shipping_method_office_code, #woocommerce_econt_shipping_method_machine_postcode, #woocommerce_econt_shipping_method_machine_code').prop('readonly', true);

//zatvarq sekciqta "customer fileds" v poruchkata
jQuery('#postcustom').addClass('closed');




function edit_receiver_address(id, type){

var econt_shipping_to = jQuery("#econt_shipping_to").val();

//DOOR
var billing_country = jQuery('select[name=_billing_country] option').filter(':selected').val();
var intl_delivery = (billing_country == 'RO' || billing_country == 'GR') ? true : false;
var econt_door_town = jQuery("#econt_door_town").val();
var econt_door_postcode = jQuery("#econt_door_postcode").val();
var econt_door_street = (intl_delivery == true) ? jQuery("#econt_door_street_intl").val() : jQuery("#econt_door_street").val();
var econt_door_quarter = (intl_delivery == true) ? jQuery("#econt_door_quarter_intl").val() : jQuery("#econt_door_quarter").val();
var econt_door_street_intl = (intl_delivery == true) ? jQuery("#econt_door_street_intl").val() : '';
var econt_door_quarter_intl = (intl_delivery == true) ? jQuery("#econt_door_quarter_intl").val() : '';
//var econt_door_street = jQuery("#econt_door_street").val();
//var econt_door_quarter = jQuery("#econt_door_quarter").val();
var econt_door_street_num = jQuery("#econt_door_street_num").val();
var econt_door_street_bl = jQuery("#econt_door_street_bl").val();
var econt_door_street_vh = jQuery("#econt_door_street_vh").val();
var econt_door_street_et = jQuery("#econt_door_street_et").val();
var econt_door_street_ap = jQuery("#econt_door_street_ap").val();
var econt_door_other = jQuery("#econt_door_other").val();
//OFFICE
var econt_offices_town =  jQuery("#econt_offices_town").val();
var econt_offices_postcode = jQuery("#econt_offices_postcode").val();
var econt_offices = jQuery("#econt_offices").val();
//MACHINE
var econt_machines_town =  jQuery("#econt_machines_town").val();
var econt_machines_postcode = jQuery("#econt_machines_postcode").val();
var econt_machines = jQuery("#econt_machines").val();
//Shipping Cost
var econt_total_shipping_cost = jQuery("#econt_total_shipping_cost").val();
var econt_customer_shipping_cost = jQuery("#econt_customer_shipping_cost").val();

jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        
        data: {
        action: 'econt_handle_ajax',
        action2: 'edit_receiver_address',
        econt_shipping_to: econt_shipping_to,
        billing_country: billing_country,
        econt_door_town: econt_door_town,
        econt_door_postcode: econt_door_postcode,
        econt_door_street: econt_door_street,
        econt_door_street_intl: econt_door_street_intl,
        econt_door_quarter: econt_door_quarter,
        econt_door_quarter_intl: econt_door_quarter_intl,
        econt_door_street_num: econt_door_street_num,
        econt_door_street_bl: econt_door_street_bl,
        econt_door_street_vh: econt_door_street_vh,
        econt_door_street_et: econt_door_street_et,
        econt_door_street_ap: econt_door_street_ap,
        econt_door_other: econt_door_other,
        econt_offices_town: econt_offices_town,
        econt_offices_postcode: econt_offices_postcode,
        econt_offices: econt_offices,
        econt_machines_town: econt_machines_town,
        econt_machines_postcode: econt_machines_postcode,
        econt_machines: econt_machines,
        econt_total_shipping_cost: econt_total_shipping_cost,
        econt_customer_shipping_cost: econt_customer_shipping_cost,
        id: id,
        type: type,

        },
        type: 'POST',

        success: function(data){

          if( data['warning'] ){ 
            alert( data['warning'] ); 
          }else{
            location.reload();
          }

        },


 });

}

jQuery("#save_receiver_address").click(function(e){

  edit_receiver_address(order_id, 'order');

});

jQuery("#save_user_address").click(function(e){

  edit_receiver_address(user_id, 'user');

});

jQuery("a.edit_econt_address").click(function(e){
  e.preventDefault();
  if(loading_is_imported != '1'){ //if loading is imported prevent from editing receiver address
    jQuery('.econt-table').hide();
    jQuery('#econt_edit_receiver_address').slideDown();
  }
});


    var env = jQuery('select[name=woocommerce_econt_shipping_method_live]').val();

    var set_env = function(env){
  
      var html_live = econt_php_vars.htmlLiveText;
      var html_test = econt_php_vars.htmlTestText;

      if( env == 1){

        jQuery("#woocommerce_econt_shipping_method_live_description").html(html_live);

      }else if (env == 0){

        jQuery("#woocommerce_econt_shipping_method_live_description").html(html_test);

      }

    }

    set_env(env);


    jQuery("#woocommerce_econt_shipping_method_live").change(function(){

      var env = jQuery('select[name=woocommerce_econt_shipping_method_live]').val();

      set_env(env);

    });

  function disableAutofill(){    
    jQuery.each([ 'econt_offices_town', 'econt_machines_town', 'econt_door_town', 'econt_door_street', 'econt_door_quarter', 'econt_door_street_num', 'econt_door_street_bl', 'econt_door_street_vh', 'econt_door_street_et', 'econt_door_street_ap', 'econt_door_other' ], function( index, value ){  
      //jQuery("input[name='"+ value +"']").prop("autocomplete", "new-username");
      jQuery("input[name='"+ value +"']").prop("autocomplete", "disabled");  //dissable, off or false
    });
  }

  setTimeout(function(){
    disableAutofill();
  }, 500);

  if( econt_php_vars.isCart && econt_php_vars.hideCardShippingDescr == 1 ){
    jQuery('.woocommerce-shipping-destination').css('display', 'none');
  }
//Checkout tooltips
if( econt_php_vars.checkoutTooltips.length == 0 || econt_php_vars.checkoutTooltips == 1 ){

  jQuery('#econt_door_town_field, #econt_offices_town_field, #econt_machines_town_field').tooltipster({
      theme: 'tooltipster-borderless',
      content: econt_php_vars.tooltipTownText,
      trigger: 'hover',
      //timer: 5000,
      maxWidth: jQuery(window).width()*0.85,
      functionPosition: function(instance, helper, position){
          //position.coord.top += 10;
          position.coord.left += jQuery(window).width()*0.04;
          return position;
      },
  });

  jQuery('#econt_door_quarter_field').tooltipster({
    theme: 'tooltipster-borderless',
    content: econt_php_vars.tooltipQuarterText,
    trigger: 'hover',
    //timer: 5000,
    maxWidth: jQuery(window).width()*0.85,
    functionPosition: function(instance, helper, position){
        //position.coord.top += 10;
        position.coord.left += jQuery(window).width()*0.05;
        return position;
    },
  });

  jQuery('#econt_door_street_field').tooltipster({
    theme: 'tooltipster-borderless',
    content: econt_php_vars.tooltipStreetText,
    trigger: 'hover',
    //timer: 5000,
    maxWidth: jQuery(window).width()*0.85,
    functionPosition: function(instance, helper, position){
        //position.coord.top += 10;
        position.coord.left += jQuery(window).width()*0.05;
        return position;
    },
});

   jQuery('#econt_user_checkout_field, .econt_user_address').tooltipster({
    theme: 'tooltipster-borderless',
    content: econt_php_vars.tooltipUserCheckoutText,
    trigger: 'hover',
    //timer: 5000,
    maxWidth: jQuery(window).width()*0.85,
    functionPosition: function(instance, helper, position){
        //position.coord.top += 10;
        position.coord.left += jQuery(window).width()*0.05;
        return position;
    },
});

}
//end of Checkout tooltips

jQuery('form.checkout').on('change','input[name^=cart]',function() {
  setTimeout(function(){
    var loading = 'yes';
    calculate_loading(loading);
  }, 1000);
});

//fix select2 and jQuery >= 3.6 conflict of search field focus
if(econt_php_vars.isCheckout){
  jQuery(document).on('select2:open', () => {
      document.querySelector('.select2-search__field').focus();
  });
}

//fast create loading
jQuery(".econt_fast_create_loading").off().on('click' , function(e){
  e.preventDefault();

  var href = jQuery(this).attr('href');
  
  if( href.indexOf("http://") != 0 && href.indexOf("https://") != 0 ){
    var $this = jQuery(this);
    $this.prop('disabled', true);

    jQuery('#econtLoader').show();

    jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        data: {
                action: 'econt_handle_ajax',
                action2: 'create_loading',
                action3: 'fast',
                order_id: href,
        },
        type: 'POST',

        
        success: function(data){
        jQuery('#econtLoader').hide();
            if( data['warning'] ){ 
            alert( data['warning'] ); 
            } else if(data.length === 0) {
            alert('Възникна грешка. Моля, проверете потребителското име и парола в настройките за доставка с Еконт.');
            } else {
              $this.attr("href", data['pdf_url']);
              $this.attr("target", '__blank');
              $this.removeClass("econt_fast_create_loading");
              $this.addClass("econt_pdf_loading");
              $this.text(data['loading_num']);
              $this.prop('disabled', false);
              $this.next().remove();
              jQuery($this).after(' <button class="econt_wc_orders_list" href="" onclick="$econt_aiaks(\'loading_tracking\', ' + data['loading_num'] + ');return false;" target="_blank">' + econt_php_vars.trackingTxt + '</button><div id="econtLoader" style="display:none;"></div><!-- loading spinner -->');

            }
        },
    });

  }else{
    window.open(href, '_blank');
  }

});
//end of fast create loading

jQuery( "body" ).on('click', '.econt_pdf_loading', function(e) {
  e.preventDefault();
  var href = jQuery(this).attr('href');
  window.open(href, '_blank');
});

jQuery(".econt_pdf_loading").off('click').on('click' , function(e){
  e.preventDefault();
  var href = jQuery(this).attr('href');
  window.open(href, '_blank');
});

//calculate shipping cost on updated_cart_totals event
jQuery('body').on('update_checkout', function(event, trigerring){
    if(econt_php_vars.isCheckout){
      var econt_door_town =  jQuery("#econt_door_town").val();
      var econt_door_postcode = jQuery("#econt_door_postcode").val();
      var econt_offices_town =  jQuery("#econt_offices_town").val();
      var econt_offices_postcode = jQuery("#econt_offices_postcode").val();
      var econt_machines_town =  jQuery("#econt_machines_town").val();
      var econt_machines_postcode = jQuery("#econt_machines_postcode").val();
      if((econt_door_town && econt_door_postcode) || (econt_offices_town && econt_offices_postcode) || (econt_machines_town && econt_machines_postcode) ){
        if(trigerring != 'calculate_loading'){
          calculate_loading(); //calculate loading cost
        }
      }
    }
});
//end of calculate shipping cost on updated_cart_totals event

//tracking colorbox modal 
$econt_aiaks = function econt_aiaks(action, loading_num){
  jQuery('#econtLoader').show();
  jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        
        data: {
        action: 'econt_handle_ajax',
        action2: action,
        loading_num: loading_num,

        },
        type: 'POST',

        success: function(data){
        jQuery('#econtLoader').hide();
            jQuery.colorbox({
              opacity:"0.6", 
              width: "600", 
              height: "500", 
              //href: data.url + '?' + result,
              html: data.html,
            });
        },


  });
}
//end of tracking colorbox modal

//fast loading form colorbox modal 
$econt_flf = function econt_flf(order_id, el){
  jQuery('#econtLoader').show();
  $econt_flf_el = jQuery(el);
  jQuery.ajax({

        url: ajaxurl,
        dataType: "json",
        
        data: {
        action: 'econt_handle_ajax',
        action2: 'fast_loading_form',
        order_id: order_id,
        },
        type: 'POST',

        success: function(data){
        jQuery('#econtLoader').hide();
            jQuery.colorbox({
              opacity:"0.6", 
              width: "900", 
              height: "500",
              trapFocus: false, 
              //href: data.url + '?' + result,
              html: data.html,
            });
        },


  });
}

$econt_add_loading_link = function econt_add_loading_link(loading_num, pdf_url){
  jQuery($econt_flf_el).prev().remove();
  jQuery($econt_flf_el).attr("href", pdf_url);
  jQuery($econt_flf_el).attr("target", '__blank');
  jQuery($econt_flf_el).removeClass("econt_fast_create_loading");
  jQuery($econt_flf_el).addClass("econt_pdf_loading");
  jQuery($econt_flf_el).text(loading_num);
  jQuery($econt_flf_el).prop('disabled', false);
  jQuery($econt_flf_el).prop("onclick", null).off("click");

  jQuery($econt_flf_el).after(' <button class="econt_wc_orders_list" href="" onclick="$econt_aiaks(\'loading_tracking\', ' + loading_num + ');return false;" target="_blank">' + econt_php_vars.trackingTxt + '</button><div id="econtLoader" style="display:none;"></div><!-- loading spinner -->');
}
//end of fast loading form colorbox modal

//hide and show Checkout fields 
if(econt_php_vars.isCheckout){
  jQuery( function() {

    // woocommerce_params is required to continue, ensure the object exists
    if ( typeof woocommerce_params === 'undefined' ) {
      return false;
    }

    jQuery(document).on( 'change', '#shipping_method input[type="radio"]', function() {
      econtCheckoutFieldsShowHide(this.value);
    });

    //for MrejaNet change of shipping methods (Econt and Speedy) snippet
    jQuery('input[name=mrejanet_shipping_method]').on('change', function(){
      econtCheckoutFieldsShowHide(this.value);
    });

    jQuery( 'body' ).on( 'updated_checkout', function() {
      var shipping_method_radio = jQuery('#shipping_method input[type="radio"]:checked').val();
      var shipping_method_hidden = jQuery('input[name="shipping_method[0]"]').val();
      if(typeof shipping_method_radio === 'undefined'){
        econtCheckoutFieldsShowHide(shipping_method_hidden);
      }else{
        econtCheckoutFieldsShowHide(shipping_method_radio);
      }
    });

    function econtCheckoutFieldsShowHide(shipping_method_name){
      jQuery('.econt_dynamic_fields').toggleClass('econt_hide', shipping_method_name == 'econt_shipping_method');
      jQuery('#econt_custom_checkout_field, #econt_user_checkout_field').toggleClass('econt_hide', shipping_method_name != 'econt_shipping_method');
    }

  });
}
//end of show and hide Checout fields

//set priority time
jQuery('#econt_priority_time_type').on('change', function () {
 
  var hour = jQuery('#econt_priority_time_hour').val();

  var html = '<option value="10">10</option>';
  html += '<option value="11">11</option>';
  html += '<option value="12">12</option>';
  html += '<option value="13">13</option>';
  html += '<option value="14">14</option>';
  html += '<option value="15">15</option>';
  html += '<option value="16">16</option>';
  html += '<option value="17">17</option>';

  if(this.value == 'BEFORE'){
    html += '<option value="18">18</option>';
  } else if (this.value == 'IN') {
    html = '<option value="9">9</option>' + html + '<option value="18">18</option>';
  } else if (this.value == 'AFTER') {
    html = '<option value="9">9</option>' + html;
  }

  jQuery('#econt_priority_time_hour').html('<option value="">' + econt_php_vars.pleaseSelectText +'</option>' + html);

  if( jQuery("#econt_priority_time_hour option[value='" + hour + "']").length > 0 ) {
    jQuery('#econt_priority_time_hour').val(hour).attr('selected', 'selected');
  }

});

//


//OpenLayer maps offices
function load_map(markers, type) {
  // Array of Icon features
  var iconFeatures=[];
  for (var i = 0; i < markers.length; i++) {
    var data = markers[i];
    var iconFeature = new ol.Feature({
      type: 'click',
      data: data,
      geometry: new ol.geom.Point(ol.proj.transform([data.lng, data.lat], 'EPSG:4326', 'EPSG:3857')),
    });

    iconFeatures.push(iconFeature);
  }

  var vectorSource = new ol.source.Vector({
    features: iconFeatures
  });

  // Custom image for marker
  var iconStyle = new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [0.5, 0.5],
        anchorXUnits: 'fraction',
        anchorYUnits: 'fraction',
        //src: './map-pin.png',
        src: econt_php_vars.openLayersMapsOfficeIcon,
        scale: 1.15
        })
  });
    
  var vectorLayer = new ol.layer.Vector({
    source: vectorSource,
    style: iconStyle,
    updateWhileAnimating: true,
    updateWhileInteracting: true,
  });
  // Create our initial map view
  var mapCenter = ol.proj.fromLonLat([markers[0].lng, markers[0].lat]);
  var view = new ol.View({
    center: mapCenter,
    maxZoom: 19,
    zoom: 12
  });

  // Now create our map
  var map = new ol.Map({
    target: 'econt_' + type + 's_map', //id of html element to display map in
    view: view,
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM(),
      }),
    ],
    loadTilesWhileAnimating: true,
  });
map.addLayer(vectorLayer);
  var popup = new ol.Overlay.Popup();
  map.addOverlay(popup);

  // Add an event handler for when someone clicks on a marker
  map.on('singleclick', function(evt) {
      // Hide existing popup and reset it's offset
      popup.hide();
      popup.setOffset([0, 0]);

      // Attempt to find a feature in one of the visible vector layers
      var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
          return feature;
      });

      if (feature) {
          var coord = feature.getGeometry().getCoordinates();
          var props = feature.getProperties();
          var info = '<div style="width:200px; margin-top:3px; color:black; font-weight:600; font-size:12px">' + props.data.description + '</div>';
          // Offset the popup so it points at the middle of the marker not the tip
          //popup.setOffset([0, -22]);
          popup.show(coord, info);
          jQuery('#econt_' + type + 's').val(props.data.id);
          jQuery('#econt_' + type + 's').trigger('change.select2');
          localStorageUpdate(props.data, 'econt_' + type + '_' + type + 's_selected');
      }
  });

  // Add an event handler for when someone hovers over a marker
  // This changes the cursor to a pointer
  map.on("pointermove", function (evt) {
      var hit = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
          return true;
      }); 
      if (hit) {
          this.getTargetElement().style.cursor = 'pointer';
      } else {
          this.getTargetElement().style.cursor = '';
      }
  });
}
//end of OpenLayer maps offices


//user shipping fields
jQuery("#econt_user_checkout_field").click(function(e){
  e.preventDefault();
    jQuery('#econt_user_checkout_field').hide();
    jQuery('.econt_office_locator_map').hide();
    jQuery('#econt_custom_checkout_field').slideDown();
    jQuery('#econt_user_address').val('0');
    if(Object.hasOwnProperty('hasOwn') && Object.hasOwn($econt_local_storage, 'econt_shipping_to')){
      if($('#econt_shipping_to_buttons_DOOR').length == 0) {
        jQuery('#econt_shipping_to').val($econt_local_storage.econt_shipping_to).trigger('change');
      }else{
        jQuery('#econt_shipping_to_buttons_' + $econt_local_storage.econt_shipping_to).attr('checked', true).trigger('change');
        
      }
    }

});

jQuery(function(){
  if(econt_php_vars.userAddress == '1' && econt_php_vars.isCheckout){
    jQuery('#econt_custom_checkout_field').hide();
    calculate_loading();
  }
});

jQuery('input[name=econt_shipping_to_buttons]').on('change', function () {
  jQuery('#econt_shipping_to').val(this.value).trigger('change');
});

$.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
 });


$('#econt_door_street_num, #econt_door_street_bl, #econt_door_street_vh, #econt_door_street_et, #econt_door_street_ap, #econt_door_other, #econt_door_street_intl, #econt_door_quarter_intl').donetyping(function(e){
  var id = $(this).attr('id');
  var value = $(this).val();
  localStorageUpdate(value,id);
});

function localStorageUpdate(data, name){
  //console.log('localStorageUpdate econt_php_vars.localStorage', econt_php_vars.localStorage);
  if(econt_php_vars.localStorage != 1){
    return false;
  }
  var econt = localStorage.econt ? JSON.parse(localStorage.econt) : new Object;
  econt[name] = data;
  $econt_local_storage = econt;
  localStorage.setItem('econt', JSON.stringify(econt));
  return econt;
}



});




 