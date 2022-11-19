

var row = $("#total_row").val();
$(document).on("click", "#add-row", function () {
	var new_row = '<tr id="row' + row + '"><td><input name="date[]" required="" type="date" class="form-control" /></td><td><input name="type[]" required="" type="text" class="form-control" /></td><td><input required="" name="mileage[]" type="text" class="form-control" /></td><td><input class="delete-row btn btn-primary" type="button" value="Delete" /></td></tr>';	
	$('#test-body').append(new_row);
	row++;
	return false;
});

$(document).on("click", ".delete-row", function () {
	if (row > 1) {
		$(this).closest('tr').remove();
		row--;
	}
	return false;
});





function changeaucationtime(val){
   // alert(val);
   if(val==1){
        $("#aucation_end_datetime_div").removeClass("hide");
        $("#sold_div").addClass('hide');
        $("#aucation_enddate").attr("required",true);
        $("#aucation_endtime").attr("required",true);
        $("#sold_date").attr("required",false);
        $("#total_bid").attr("required",false);
        $("#winning_bid").attr("required",false);
   }else if(val==4){
       $("#sold_div").removeClass('hide');
       $("#aucation_end_datetime_div").addClass("hide");
       $("#aucation_enddate").attr("required",false);
       $("#aucation_endtime").attr("required",false);
       $("#sold_date").attr("required",true);
       $("#total_bid").attr("required",true);
       $("#winning_bid").attr("required",true);
   }else{
         $("#aucation_end_datetime_div").addClass("hide");
         $("#sold_div").addClass('hide');
         $("#aucation_enddate").attr("required",false);
         $("#aucation_endtime").attr("required",false);
         $("#sold_date").attr("required",false);
         $("#total_bid").attr("required",false);
         $("#winning_bid").attr("required",false);
   }
}




$(document).ready(function() {
    $("#savecar0").validate({
        rules: {
                    name:{required: true},
                    reg_no: {required: true},
                    make_id: {required: true},
                    model: {required: true},
                    variant: {required: true},
                    mileage: {required: true},
                    gearbox: {required: true},
                    steering_position: {required: true},
                    engine_size: {required: true},
                    color: {required: true},
                    country_id: {required: true},
                    city_id: {required: true},
                    year: {required: true},
                    seller_type: {required: true},
                    former_keepers: {required: true},
                    currency: {required: true},
                    reserve_price: {required: true},
                    description: {required: true}
        }
    });
});

$(document).ready(function() {
    $("#savecar1").validate({
        rules: {
            wheels_tyres: {required: true},
            bodywork: {required: true},
            paint: {required: true},
            glass_trim: {required: true},
            car_id: {required: true},
            images:{required: true}
        }
    });
});

$(document).ready(function() {
    $("#savecar2").validate({
        rules: {
            seats: {required: true},
            dashboard: {required: true},
            steering_wheel: {required: true},
            car_id: {required: true},
            images:{required: true}
        }
    });
});

$(document).ready(function() {
    $("#savecar3").validate({
        rules: {
            engine_gearbox: {required: true},
            suspension_brakes: {required: true},
            the_drive: {required: true},
            electrics: {required: true},
        }
    });
});
$(document).ready(function() {
    $("#savecar4").validate({
        rules: {
            vehicle_history: {required: true}
        }
    });
});





 $(document).ready(function () {
   $('#upload_image').on('change', function (e) {
    readURL(this, "basic_img");
   });
   });
   
   
   function readURL(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }

   $(document).ready(function () {
   $('#upload_image2').on('change', function (e) {
    readURL2(this, "basic_img2");
   });
   });
   
   
   function readURL2(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }

   $(document).ready(function () {
   $('#upload_image3').on('change', function (e) {
    readURL3(this, "basic_img3");
   });
   });
   
   
   function readURL3(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }

   $(document).ready(function () {
   $('#upload_image4').on('change', function (e) {
    readURL4(this, "basic_img4");
   });
   });
   
   
   function readURL4(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }
   
   
    $(document).ready(function () {
   $('#upload_image5').on('change', function (e) {
    readURL5(this, "basic_img5");
   });
   });
   
   
   function readURL5(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }


function videosection(val,type){
    if(val==1){
        $("#video_url_"+type).attr("required",false);
        $("#video_"+type+"_url").css("display","none");       
        $("#video_"+type+"_upload").css("display","block");
    }
    if(val==2){
        $("#video_url_"+type).attr("required",true);
        $("#video_"+type+"_url").css("display","block");       
        $("#video_"+type+"_upload").css("display","none");
    }
}





  function uploadalt(val){
        
            var $source = $('#video_here_'+val);
            $source[0].src = URL.createObjectURL(document.getElementById("video_"+val).files[0]);
            $source.parent()[0].load();
              var file = document.getElementById("video_"+val).files[0];
              $("#old_video_"+val).val('');
              var fileReader = new FileReader();
              if (file.type.match('image')) {
                fileReader.onload = function() {
                  var img = document.createElement('img');
                  img.src = fileReader.result;
                  document.getElementsByTagName('div')[0].appendChild(img);
                };
                fileReader.readAsDataURL(file);
              } else {
                  fileReader.onload = function() {
                    var blob = new Blob([fileReader.result], {type: file.type});
                    var url = URL.createObjectURL(blob);
                    var video = document.createElement('video');
                    var timeupdate = function() {
                      if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                        video.pause();
                      }
                    };
                    video.addEventListener('loadeddata', function() {
                      if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                      }
                    });
                    var snapImage = function() {
                      var canvas = document.createElement('canvas');
                      canvas.width = video.videoWidth;
                      canvas.height = video.videoHeight;
                      canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                      var image = canvas.toDataURL();
                      var success = image.length > 100000;
                      if (success) {
                        var img = document.createElement('img');
                        img.src = image;

                        //document.getElementById("thumbimgdata"+val).value=image;
                      //  document.getElementsByTagName('div')[0].appendChild(img);
                        URL.revokeObjectURL(url);
                      }
                      return success;
                    };
                    video.addEventListener('timeupdate', timeupdate);
                    video.preload = 'metadata';
                    video.src = url;
                    // Load video in Safari / IE11
                    video.muted = true;
                    video.playsInline = true;
                    video.play();
                  };
                  fileReader.readAsArrayBuffer(file);
  }
        
  }