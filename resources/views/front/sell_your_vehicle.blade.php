@extends('front.layout')
@section('title')
Front Line Ready - Sell Your Vehicle
@stop
@section('meta-data')
@stop
@section('content')
<?php $path = asset('public/theme/images/sell-banner-2.jpg');?>
<div class="banner slider section hold" style="background-image: url('{{$path}}');">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold sell-with-us-heading">
                    <h2>The auto dealer exclusively for dealers.</h2>
                    <p>SELL YOUR CLASSIC OR PERFORMANCE WITH US</p>
                </div>
            </div>
        </div>
    </div>
    <!--Banner Slider end -->

    <!--My-accont style start here -->

    <div class="my-accont-section">
        <div class="heading-border-section">
            <span class="firts"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box cutsom-white-bg sell-with-heading--second">
                            <h2>SELL YOUR VEHICLE</h2>
                        </div>
                        <span class="left"></span>
                        <span class="Right"></span>
                    </div>
                </div>
            </div>
            <span class="second"></span>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="my-acconut-content">
                        <h6>ABOUT YOUR VEHICLE</h6>
                        <p>We will contact you to find out as much about the vehicle and its history we can and work
                            with you to create a honest, professional advert that details the vehicle as best as
                            possible to ensure that you get the highest price. Vehicle
                            stays with you throughout the auction and you facilitate inspections / viewings by potential
                            bidders.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form_contact_box my-account-form-hold">
                        <form>
                            <div class="contact_form_box">
                                <div class="my_account_form_box my-accont-input">
                                    <label>VEHICLE REGISTRATION NUMBER</label>
                                    <input type="text" name="">
                                </div>
                                <div class="contact_left_side_box my-accont-input">
                                    <label>MAKE</label>
                                    <input type="text" name="" placeholder="e.g. Audi">
                                    <label>VARIANT</label>
                                    <input type="text" name="" placeholder="e.g. Coupe">
                                    <label>MILEAGE</label>
                                    <input type="text" name="">
                                    <label>STEERING POSITION</label>
                                    <i class="fas fa-angle-down"></i>
                                    <select id="street" name="street" class="form-control">
                                        <option value="Right-hand Drive" selected>Right-hand Drive</option>
                                    </select>

                                    <label>COLOR</label>
                                    <input type="text" name="color">
                                    <label>IN WHAT COUNTRY IS THE VEHICLE LOCATED?</label>
                                    <i class="fas fa-angle-down"></i>
                                    <select id="country" name="country" class="form-control">
                                        <option value="United Kingdom" selected>United Kingdom</option>
                                    </select>
                                    <label>FORMER KEEPERS</label>
                                    <input type="text" name="">
                                </div>
                                <div class="contact_right_side_box my-accont-input">
                                    <label>MODEL</label>
                                    <input type="text" name="" placeholder="e.g. A8">
                                    <label>YEAR</label>
                                    <input type="text" name="">
                                    <label>GEARBOX (AUTO/MANUAL/SEMI)</label>
                                    <input type="text" name="">
                                    <label>ENGINE SIZE</label>
                                    <input type="text" name="" placeholder="e.g. 4.0L">
                                    <label>CHASSIS NUMBER</label>
                                    <input type="text" name="">
                                    <label>WHERE IS THE VEHICLE LOCATED (TOWN/CITY)?</label>
                                    <input type="text" name="">
                                    <label>EDEALER OR PRIVATE</label>
                                    <i class="fas fa-angle-down"></i>
                                    <select id="country" name="country" class="form-control">
                                        <option value="Private">Private</option>
                                    </select>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="photo-and-description-section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="photo-and-description-content">
                        <span>PHOTO & DESCRIPTION</span>
                        <p>Upload an image (pick one that gives a good overview of the vehicle), a higher resolution
                            image will work better!</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <!-- <div class="photo-and-description-left-collapse">
                            <div class="accordion accordion-flush">
                                <div class="accordion-item photo-and-desc-collaps">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Exterior Image
                                    </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body collase-content-iiner">
                                            <ul>
                                                <li>Interior Image</li>
                                                <li>Mechanics Image</li>
                                                <li>Document Image</li>
                                                <li>Video</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <div class="exterior-img-box">
                        <ul>
                            <li class="active-ext"><a href="#">Exterior Image</a></li>
                            <li><a href="#">Interior Image</a></li>
                            <li><a href="#">Mechanics Image</a></li>
                            <li><a href="#">Document Image</a></li>
                            <li><a href="#">Video</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="upload-images-and-files">
                        <span>
                            <div class=" end-border-and-btn ">
                                <div class="actions-btn-hold btn_box_border ">
                                    <a class="btn_border " href=" " style="padding: 3px 45px;
                                    font-size: 13px; ">Upload multiple files</a>
                                </div>
                            </div>
                            <p>or drag and drop</p>
                        </span>
                        <p>PNG or JPEG up to 20MB or MP4</p>
                        <ul class="img-uploads">
                            <li>
                                <a href="">
                                    <i class="fas fa-times-circle"></i>
                                    <img src="{{asset('public/theme/images/sell-upload.jpg')}}"></a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fas fa-times-circle"></i>
                                    <img src="{{asset('public/theme/images/sell-upload.jpg')}}"></a>
                            </li>
                            <li>
                                <a href=""><img></a>
                            </li>
                            <li>
                                <a href=""><img></a>
                            </li>
                            <li>
                                <a href=""><img></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form>
                        <div class="contact_form_box vehicle-form-info">
                            <p>Please provide as much information about your vehicle as possible</p>
                            <div class="my_account_form_box my-accont-input">
                                <label>Wheel & Tyres</label>
                                <textarea id="contact_msg" name="message" spellcheck="false"></textarea>
                                <br>
                                <label>Bodywork</label>
                                <textarea id="contact_msg" name="message" spellcheck="false"></textarea>
                                <br>
                                <label>Paint</label>
                                <textarea id="contact_msg" name="message" spellcheck="false"></textarea>
                                <br>
                                <label>Glass & Trim</label>
                                <textarea id="contact_msg" name="message" spellcheck="false"></textarea>
                                <br>

                                <form>
                                    <div class="contact_form_box">

                                        <div class="contact_left_side_box my-accont-input ipad-hold-with-hold">
                                            <label>CURRENCY</label>
                                            <i class="fas fa-angle-down"></i>
                                            <select id="country" name="country" class="form-control">
                                                <option value="GBP">GBP</option>
                                            </select>
                                        </div>
                                        <div class="contact_right_side_box my-accont-input ipad-hold-with-hold">
                                            <label>SET A RESERVE (LEAVE 0 FOR NO RESERVE) *</label>
                                            <input type="text" name="" placeholder="0">
                                        </div>

                                    </div>
                                </form>
                                <br>
                                <br>
                                <p>By completing and submitting this Form, you declare to agree with the terms and
                                    conditions. We are responsible for the processing of your data in accordance with
                                    our privacy statement. Both documents can be found, downloaded
                                    and printed on the website.</p>
                                <div class="end-border-and-btn last-bottom-pd">
                                    <div class="actions-btn-hold btn_box_border">
                                        <a class="btn_border" href="" style="padding:0px 45px;" data-bs-toggle="modal"
                                            data-bs-target="#myModalsell-out-sumit">SUBMIT <i
                                                class="fal fa-long-arrow-right" style="margin-left: 8px;"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('footer')
@stop