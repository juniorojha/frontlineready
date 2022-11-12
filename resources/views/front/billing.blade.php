@extends('front.layout')
@section('title')
Front Line Ready - Billing
@stop
@section('meta-data')
@stop
@section('content')
<script src="https://js.stripe.com/v3/"></script>

<style type="text/css">
    div#card-element{
            width: 100%;
            background-color: #e5e5e5;
            border: none;
            border-radius: 6px;
            padding: 5px;
    }
</style>
<div class="user-profile section hold">
        <div class="heading-border-section">
            <span class="firts"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box cutsom-white-bg">
                            <div class="user-profile-tabs">
                                <ul>
                                    <li><a href="{{route('myaccount')}}">MY BIDS</a></li>
                                    <li><a href="{{route('my-watch')}}">WATCHING</a></li>
                                    <li><a href="{{route('my-listing')}}">MY LISTING</a></li>
                                    <li><a href="{{route('my-details')}}">MY DETAILS</a></li>
                                    <li><a class="btn-active"  href="{{route('billing')}}">BILLING</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="left"></span>
                        <span class="Right"></span>
                    </div>
                </div>
                <span class="second"></span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="user-cars-details-box">
                    <ul>
                        <li class="double-border">
                            <div class="detail-heading">
                                <p>All bidders need to complete a bidding profile and add a valid credit/debit card
                                    before bidding. We use this simply to confirm names and addresses, this ensures that
                                    all bidders are genuine and serious, and helps us to
                                    eliminate time-wasters.
                                </p>
                                <p>We do not process or store any credit/debit card information ourselves, all details
                                    are securely encrypted and sent directly to our credit/debit card partner, Stripe
                                    for safe storage. No charges can be made against your
                                    card without your authorisation.
                                </p>
                                <p>If you bid on and win an auction, you can choose if you want to use this card to make
                                    the deposit payment.</p>
                            </div>
                        </li>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample7">
                                <div class="accordion-item">
                                    
                                    <h2 class="accordion-header" id="headingOne7">
                                       
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne7" aria-expanded="true" aria-controls="collapseOne7">
                                            <div class="detail-heading">
                                                <h6>PAYMENT METHOD
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close</a>
                                                    </p>
                                                </span>
                                                 @if(Session::has('message_card'))
                           <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                              
                              {{ Session::get('message_card') }}
                           </div>
                           @endif
                            @if($request_removecard==1)
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                             Your request for remove card is under review
                           </div>
                           @endif
                           
                           
                                                 @if(!isset($billingdata->id))
                                                <p>No card on file</p>
                                                @else
                                                 <p> Card Info</p>
                                                 <p>**** **** **** {{$last4}} ({{$brand}})</p> 
                                                 <p>{{$month}}/{{$year}}</p>
                                                @endif
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne7" class="accordion-collapse collapse show" aria-labelledby="headingOne7" data-bs-parent="#accordionExample7">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <form data-stripe-publishable-key="{{$setting->stripe_key}}"
                                                    id="payment-form" action="">
                                                        <input type="hidden" name="vaildphoneno" id="vaildphoneno_pay" class="vaildphoneno" value="{{isset($billingdata->id)?1:0}}"> 
                                                        <input type="hidden" name="countrycode" id="countrycode" class="countrycode" value="{{isset($billingdata->country_code)?$billingdata->country_code:0}}">
                                                        <input type="hidden" name="stripe_token" id="stripe_token">
                                                        <input type="hidden" id="is_bill_data" value="{{isset($billingdata->id)?$billingdata->id:0}}">
                                                        <div class="contact_form_box full-width-form">
                                                           
                                                            <div class="row">
                                                                @if(isset($billingdata->id))
                                                                @else
                                                                    <div class="group">
                                                                      <label>
                                                                        <span>Credit  Or Debit Card</span>
                                                                        <div id="card-element" class="field"></div>
                                                                      </label>
                                                                    </div>
                                                                @endif
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Name On Card</label>
                                                                    <input type="text" name="name_on_card" id="name_on_card" required="" onblur="removeerror('error_name_on_card_pay')" value="{{isset($billingdata->name_on_card)?$billingdata->name_on_card:''}}">
                                                                    <span id="error_name_on_card_pay"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>
                                                                        Phone Number</label>
                                                                    <input type="text" name="phone" class="numberonly" required  maxlength="11"  value="{{isset($billingdata->phone)?$billingdata->country_code.$billingdata->phone:''}}" id="phone_pay">
                                                                    <span id="error_phone_pay" class="error error_contact_phone"></span>
                                                                    <span id="valid-msg" class="hide valid-msg">Valid</span>
                                                                    <span id="error-msg" class="hide error-msg">Invalid number</span>

                                                                </div>

                                                                <div class="form-group col-lg-12 col-md-12">
                                                                    <label>Billing Address</label>
                                                                    <input type="text" onblur="removeerror('error_billing_address_pay')" name="billing_address" id="billing_address_pay" required="" value="{{isset($billingdata->billing_address)?$billingdata->billing_address:''}}">
                                                                    <span id="error_billing_address_pay"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Country</label>                                                                    
                                                                    <select id="country_pay" name="country" required class="country country_select" onchange="getstatebycountry(this.value,'pay')">
                                                                        <option value="">Select Country</option>
                                                                        @foreach($country as $c)
                                                                           <option value="{{$c->sortname}}" <?= isset($billingdata->country_id)&&$billingdata->country_id==$c->id?'selected="selected"':''?>>{{ucwords(strtolower($c->name))}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="error_country_pay"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>State</label>      
                                                                    <input id="state_pay" name="state" required class="country_select" value="{{isset($billingdata->state_id)?$billingdata->state_id:''}}" type="text" onblur="removeerror('error_state_pay')">
                                                                       
                                                                    <span id="error_state_pay"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Town/City</label>
                                                                    <input type="text" id="city_pay" name="city" class="country_select" value="{{isset($billingdata->city_id)?$billingdata->city_id:''}}" onblur="removeerror('error_city_pay')" required>
                                                                    <span id="error_city_pay"></span>
                                                                </div>
                                                                
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Postcode/Zipcode</label>
                                                                    <input type="text" name="pincode" onblur="removeerror('error_pincode_pay')" id="pincode_pay" required="" value="{{isset($billingdata->pincode)?$billingdata->pincode:''}}">
                                                                    <span id="error_pincode_pay"></span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="detail-heading">
                                                    <p>I authorise The Collecting Group to send instructions to the
                                                        financial institution that issued my card to take payments from
                                                        my card account in accordance with the Terms and Conditions.</p>
                                                         <p class="success"></p>
                                                           
                                                            <p id="card-errors"></p>
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;">
                                                            <a class="btn_border" href="javascript:updatepaymentmethod()">ADD CARD</a>
                                                            
                                                            
                                                            
                                                        </div>
                                                        @if(isset($billingdata->id)&&$request_removecard==0)
                                                         <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;">
                                                            <a class="btn_border" href="{{route('remove-card')}}">REMOVE CARD</a>
                                                            
                                                            
                                                        </div>
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        </div></div></li>
                        <li class="last-bottom-pd">
                            <div class="accordion" id="accordionExample8">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne8">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne8" aria-expanded="true" aria-controls="collapseOne8">
                                            <div class="detail-heading">
                                                <h6>INVOICE ADDRESS
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close </a>
                                                    </p>
                                                </span>
                                                <p>Same as billing address</p>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne8" class="accordion-collapse collapse show" aria-labelledby="headingOne8" data-bs-parent="#accordionExample8">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <form id="invoice_payment_address">

                                                        <input type="hidden" name="vaildphoneno" id="vaildphoneno_in" class="vaildphoneno" value="{{isset($invoicedata->id)?1:0}}"> 
                                                        <input type="hidden" name="countrycode" id="countrycode" class="countrycode" value="{{isset($invoicedata->country_code)?$invoicedata->country_code:0}}">
                                                        <input type="hidden" id="is_invoice_data" value="{{isset($invoicedata->id)?1:0}}">

                                                        <div class="contact_form_box full-width-form">
                                                            <div class="row">

                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Company Name</label>
                                                                    <input type="text" name="company_name" id="company_name_in" value="{{isset($invoicedata->company_name)?$invoicedata->company_name:''}}" onblur="removeerror('error_company_name')">
                                                                    <span id="error_company_name"></span>
                                                                </div>

                                                                <div class="form-group col-lg-12 col-md-12">
                                                                    <label>Billing Address</label>
                                                                    <input type="text" name="billing_address" id="billing_address_in" value="{{isset($invoicedata->billing_address)?$invoicedata->billing_address:''}}" onblur="removeerror('error_billing_address')">
                                                                    <span id="error_billing_address"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Country</label>                                                                    
                                                                    <select id="country_in" name="country" class="country country_select" onchange="getstatebycountry(this.value,'in')">
                                                                        <option value="">Select Country</option>
                                                                        @foreach($country as $c)
                                                                           <option value="{{$c->sortname}}" <?= isset($invoicedata->country_id)&&$invoicedata->country_id==$c->id?'selected="selected"':''?> >{{ucwords(strtolower($c->name))}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="error_country_in"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>State</label>      
                                                                    <input type="text" id="state_in" name="state" class="country_select"  value="{{isset($invoicedata->state_id)?$invoicedata->state_id:''}}" onblur="removeerror('error_state_in')" required>
                                                                       
                                                                    <span id="error_state_in"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Town/City</label>
                                                                    <input id="city_in" name="city" class="country_select" value="{{isset($invoicedata->city_id)?$invoicedata->city_id:''}}" onblur="removeerror('error_city_in')" required>
                                                                      
                                                                    <span id="error_city_in"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Postcode/Zipcode</label>
                                                                    <input type="text" name="pincode" id="pincode_in" value="{{isset($invoicedata->pincode)?$invoicedata->pincode:''}}" onblur="removeerror('error_pincode_in')">
                                                                    <span id="error_pincode_in"></span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>Phone Number</label>
                                                                    <input type="text" name="phone" id="phone" class="numberonly"  maxlength="11"  value="{{isset($invoicedata->phone)?$invoicedata->country_code.$invoicedata->phone:''}}" onblur="removeerror('error_in_phone')">
                                                                    <span id="error_in_phone" class="error error_contact_phone"></span>
                                                                    <span id="valid-msg" class="hide valid-msg">Valid</span>
                                                                    <span id="error-msg" class="hide error-msg">Invalid number</span>
                                                                </div>
                                                                <div class="form-group col-lg-6 col-md-6">
                                                                    <label>VAT Number</label>
                                                                    <input type="text" name="vat_no" onblur="removeerror('error_vat_no')" id="vat_no" value="{{isset($invoicedata->vat_no)?$invoicedata->vat_no:''}}" >
                                                                    <span id="error_vat_no"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                                <div class="detail-heading">
                                                    <p>I authorise The Collecting Group to send instructions to the
                                                        financial institution that issued my card to take payments from
                                                        my card account in accordance with the Terms and Conditions.</p>
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;">
                                                            <a class="btn_border" href="javascript:updateinvoicedetail()">Update</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        </div></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
     
@stop
@section('footer')
<script src="https://js.stripe.com/v3/fingerprinted/js/shared-250240f2df10b972468b40af0fabbed6.js"></script>
<script src="https://js.stripe.com/v3/fingerprinted/js/ui-shared-8d92a34ff0de1bd66f84f68818549ef1.js"></script>
<script src="https://js.stripe.com/v3/fingerprinted/js/ui-shared-8d92a34ff0de1bd66f84f68818549ef1.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 <script type="text/javascript">
 if($("#is_invoice_data").val()==0){
var stripe = Stripe('{{$setting->stripe_key}}');
var elements = stripe.elements();

var card = elements.create('card', {
  hidePostalCode: true,
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: 'robots',
      fontSize: '18px',

      '::placeholder': {
        color: 'gray',
      },
    },
  }
});
card.mount('#card-element');
}


function setOutcome(result) {
  var successElement = document.querySelector('.success');
  var errorElement = document.getElementById('card-errors');
  successElement.classList.remove('visible');
  errorElement.classList.remove('visible');

  if (result.token) {
    console.log(result.token.id);
    // In this example, we're simply displaying the token
    successElement.querySelector('.token').textContent = result.token.id;
    successElement.classList.add('visible');
     errorElement.classList.remove('visible');

    // In a real integration, you'd submit the form with the token to your backend server
    //var form = document.querySelector('form');
    //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
    //form.submit();
  } else if (result.error) {
    errorElement.textContent = result.error.message;
    errorElement.classList.add('visible');
    successElement.classList.remove('visible');
  }
}
 if($("#is_invoice_data").val()==0){
card.on('change', function(event) {
  setOutcome(event);
});
}


function updatepaymentmethod(){
    var name = $("#name_on_card").val();
    var billing_address = $("#billing_address_pay").val();
    var state = $("#state_pay").val();
    var country = $("#country_pay").val();
    var city = $("#city_pay").val();
    var phone = $("#phone_pay").val();
    var pincode_in = $("#pincode_pay").val();
    var msg = "";  
    if(name==""){
        $("#error_name_on_card_pay").html("Please Enter  Name On Card");
        $("#error_name_on_card_pay").css("color","red");
        msg=1;
    }
    if(billing_address==""){
        $("#error_billing_address_pay").html("Please Enter Billing Address");
        $("#error_billing_address_pay").css("color","red");
        msg=1;
    }
    if(state==""){
        $("#error_state_pay").html("Please Select Your State");
        $("#error_state_pay").css("color","red");
        msg=1;
    }
    if(city==""){
        $("#error_city_pay").html("Please Select Your city");
        $("#error_city_pay").css("color","red");
        msg=1;
    }
    
    if(pincode_in==""){
        $("#error_pincode_pay").html("Please Enter Pincode");
        $("#error_pincode_pay").css("color","red");
        msg=1;
    }
    
    if(country==""){
        $("#error_country_pay").html("Please Select Country");
        $("#error_country_pay").css("color","red");
        msg=1;
    }
    if(phone==""){
        $("#error_phone_pay").html("Please Enter Phone no");
        msg=1;
    }else{
        if($("#vaildphoneno_pay").val()!=1){
            $("#error_phone_pay").html("Please Enter Vaild Phoneno");
            msg=1;
        }
    }
    if(msg==""){
          $("#error_name_on_card_pay").html("");
         $("#error_billing_address_pay").html("");
          if($("#is_invoice_data").val()==0){
         stripe.createToken(card).then(function(result) {
            if (result.error) {
              // Inform the customer that there was an error.
              var errorElement = document.getElementById('card-errors');
              $("#card-errors").html(result.error.message);
              $("#card-errors").css("color","red");
            } else {
                
                $("#stripe_token").val(result.token.id);
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });
                $.ajax({
                            url: $("#site_url").val()+"/update_payment_detail",
                            method: 'post',
                            data: $('#payment-form').serialize(),
                            success: function(response){
                                if(response!=0&&response!=1){
                                    $("#card-errors").html(response);
                                    $("#card-errors").css("color","red");
                                }else{
                                    if(response==1){                            
                                        window.location.reload();
                                    }
                                }
                                
                            }
                });
            }
          });
          }else{
              $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });
                $.ajax({
                            url: $("#site_url").val()+"/update_payment_detail",
                            method: 'post',
                            data: $('#payment-form').serialize(),
                            success: function(response){
                                if(response!=0&&response!=1){
                                    $("#card-errors").html(response);
                                    $("#card-errors").css("color","red");
                                }else{
                                    if(response==1){                            
                                        window.location.reload();
                                    }
                                }
                            }
                });
          }
        
    }
     
   
}


</script>
@stop