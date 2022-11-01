

  var telInput = $("#phone_reg");


  var telInput2 = $("#phone");

  var telInput3 = $("#phone_pay");


  errorMsg = $(".error-msg"),
  validMsg = $(".valid-msg");

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
    
    
    $(".country").val(countryCode);
    if($("#country_pay").length){
      if($("#is_bill_data").val()==0){
        getstatebycountry(countryCode,'pay');
      }
    }
    if($("#country_in").length){
        if($("#is_invoice_data").val()==0){
            getstatebycountry(countryCode,'in');
        }        
    }
    
    callback(countryCode);
  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});
telInput2.intlTelInput({

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
    
   
    
    
    callback(countryCode);
  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});

telInput3.intlTelInput({

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
    
   
    
    
    callback(countryCode);
  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});


var reset = function() {
  telInput.removeClass("error");
   telInput2.removeClass("error");
  errorMsg.addClass("hide");
  validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {
  reset();
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
     //validMsg.removeClass("hide");
    
      $(".vaildphoneno").val(1);
      $(".countrycode").val($(".selected-dial-code").html());
      
    } else {
      telInput.addClass("error");
     errorMsg.removeClass("hide");
       $(".vaildphoneno").val(0);
        
       $(".countrycode").val($(".selected-dial-code").html());
    }
  }
});

telInput2.blur(function() {
  reset();
  if ($.trim(telInput2.val())) {
    if (telInput2.intlTelInput("isValidNumber")) {
     //validMsg.removeClass("hide");
    
      $(".vaildphoneno").val(1);
      $(".countrycode").val($(".selected-dial-code").html());
      
    } else {
      telInput2.addClass("error");
     errorMsg.removeClass("hide");
       $(".vaildphoneno").val(0);
        
       $(".countrycode").val($(".selected-dial-code").html());
    }
  }
});
telInput3.blur(function() {
  reset();
  if ($.trim(telInput3.val())) {
    if (telInput3.intlTelInput("isValidNumber")) {
     //validMsg.removeClass("hide");
    
      $(".vaildphoneno").val(1);
      $(".countrycode").val($(".selected-dial-code").html());
      
    } else {
      telInput3.addClass("error");
     errorMsg.removeClass("hide");
       $(".vaildphoneno").val(0);
        
       $(".countrycode").val($(".selected-dial-code").html());
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);
telInput2.on("keyup change", reset);
telInput3.on("keyup change", reset);