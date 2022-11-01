var telInput = $("#phone_sell"),
  errorMsg = $("#error-msg-sell"),
  validMsg = $("#valid-msg-sell");

// initialise plugin
telInput.intlTelInput({

  allowExtensions: true,
  formatOnDisplay: true,
  autoFormat: true,
  autoHideDialCode: true,
  autoPlaceholder: true,
  defaultCountry: "auto",
  ipinfoToken: "yolo",

  nationalMode: false,
  numberType: "MOBILE",
  //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
  preferredCountries: ['sa', 'ae', 'qa','om','bh','kw','ma'],
  preventInvalidNumbers: true,
  separateDialCode: true,
  initialCountry: "auto",
  geoIpLookup: function(callback) {
  $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
     
    var countryCode = (resp && resp.country) ? resp.country : "IN";
    
    $("#country_sell").val(countryCode);
   
    callback(countryCode);
  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});

var reset = function() {
  telInput.removeClass("error");
  errorMsg.addClass("hide");
  validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {
  reset();
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
    // validMsg.removeClass("hide");
    
      $("#vaildphoneno_sell").val(1);
      $("#countrycode_sell").val($(".selected-dial-code").html());
     
    } else {
      telInput.addClass("error");
     errorMsg.removeClass("hide");
       $("#vaildphoneno_sell").val(0);
        
       $("#countrycode_sell").val($(".selected-dial-code").html());
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);