<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthencationController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SpotLightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FRQController;
use App\Http\Controllers\SearchCarsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('config-cache', function () {
    Artisan::call("config:cache");
    Artisan::call("optimize:clear");
    echo "clear";
    echo Hash::make(123456);
    //return view('welcome');
});

Route::get("cronrun", function () {
    Artisan::call("car:read");
   // Artisan::call("live:auction");
    echo "done";
});

Route::get("teststipe", function () {
    return view("front.teststripe");
});


Route::get("testtimezone",[AuthencationController::class,"testtimezone"]);


Route::get('testv3', [FrontController::class, 'testv3']);
Route::post('testv3', [FrontController::class, 'storev3']);


Route::get('page_not_found',[FrontController::class,"page_not_found"])->name('page_not_found');

Route::get("remove_card",[FrontController::class,"remove_card"])->name("remove-card");
Route::get('sendemail',[FrontController::class,"sendemail"]);
Route::get("improtoldusers",[FrontController::class,"improtolduser"]);
Route::Get("getcurrenttime/{offset}",[FrontController::class,"getcurrenttime"]);

Route::get("/",[FrontController::class,"show_home"])->name("home");
Route::post("save_contact_detail",[FrontController::class,"save_contact_detail"])->name("save-contact-detail");
Route::get("contact",[FrontController::class,"contact_page"])->name("contact-us");
Route::post("register_user",[FrontController::class,"post_register_user"])->name("register-user");
Route::get("check_username",[FrontController::class,"check_username"])->name("check-username");
Route::get("news_details",[FrontController::class,"show_news_details"])->name("news-detail");
Route::get("spotlight",[FrontController::class,"show_spotlight"])->name("spotlight");
Route::post("newsletter_user",[FrontController::class,"post_newsletter_user"])->name("newsletter-user");
Route::get("about",[FrontController::class,"about_us"])->name("about-us");
Route::get("sell_with_us",[FrontController::class,"sell_with_us"])->name("sell-with-us");
Route::get("sell_your_vehicle",[FrontController::class,"sell_your_vehicle"])->name("sell-your-vehicle");
Route::get("vehicle_detail",[FrontController::class,"vehicle_detail"])->name("vehicle-detail");
Route::get("my_watch",[FrontController::class,"show_my_watch"])->name("my-watch");
Route::get("my_listing",[FrontController::class,"show_my_listing"])->name("my-listing");
Route::get("my_details",[FrontController::class,"show_my_details"])->name("my-details");
Route::get("billing",[FrontController::class,"show_billing"])->name("billing");
Route::get("check_username",[FrontController::class,"post_check_username"])->name('check-username');
Route::get("check_email",[FrontController::class,"check_email"])->name("check-email");
Route::post("update_my_detail",[FrontController::class,"update_my_detail"])->name("update_my_detail");
Route::get("check_user_pwd",[FrontController::class,"check_user_pwd"])->name("check-user-pwd");
Route::post("update_my_password",[FrontController::class,"update_my_password"])->name("update_my_password");
Route::post("emailsubscription",[FrontController::class,"emailsubscription"]);
Route::post("notificationuser",[FrontController::class,"notificationuser"]);
Route::post('post_sell_with_us',[FrontController::class,"post_sell_with_us"])->name('post_sell_with_us');
Route::get("emailverified",[FrontController::class,"emailverified"])->name("email-verified");
Route::get("getstatelist",[FrontController::class,"getstatelist"])->name("getstatelist");
Route::get("getcitylist",[FrontController::class,"getcitylist"])->name("getcitylist");
Route::post("user_forgotpassword",[FrontController::class,"forgotpassword"])->name("user_forgotpassword");
Route::get("reset_password",[FrontController::class,"show_reset_password"])->name("reset-password");
Route::post("reset_new_password",[FrontController::class,"reset_new_password"])->name("reset-new-password");
Route::post("update_invoice_detail",[FrontController::class,"update_invoice_detail"])->name("update-invoice-detail");
Route::get("cookie_policy",[FrontController::class,"show_cookie_policy"])->name("cookie-policy");
Route::get("term_privacy",[FrontController::class,"show_term_and_condition"])->name("term-privacy");
Route::get("faq",[FrontController::class,"show_frq"])->name("frq");
Route::get("searchcars",[SearchCarsController::class,"searchcars"])->name("searchcars");

Route::post("login_user",[FrontController::class,"show_login_user"]);
Route::get("myaccount",[FrontController::class,"show_myaccount"])->name("myaccount");
Route::get('user_logout',[FrontController::class,"user_logout"])->name('user-logout');
Route::get("add_book_Car",[FrontController::class,"add_book_Car"])->name("add_book_Car");
Route::post("add_comment",[FrontController::class,"add_comment"])->name("add_comment");

Route::post("add_live_bid",[FrontController::class,"add_live_bid"])->name("add_live_bid");
Route::post("update_payment_detail",[FrontController::class,"update_payment_detail"])->name("update-payment-detail");
Route::get("fetch_visitor",[FrontController::class,"fetch_visitor"])->name("fetch-visitor");
Route::get("get_txt",[FrontController::class,"get_txt"]);

Route::get("auction",[FrontController::class,"show_auction"])->name("auction");
Route::get("inventory",[FrontController::class,"show_inventory"])->name("inventory");


Route::get("buy_now",[FrontController::class,"buy_now"])->name("buy-now");
Route::group(['prefix' => 'admin'], function () {

    Route::get("/",[AuthencationController::class,"show_admin_login"])->name("login");
    Route::post("post-login",[AuthencationController::class,"post_login"])->name("admin-post-login");

    Route::group(['middleware' => ['admincheck']], function () {
            Route::get("dashboard",[AuthencationController::class,"show_dashboard"])->name('dashboard');
            Route::get("logout",[AuthencationController::class,"admin_logout"])->name('admin-logout');

            Route::get('make',[MakeController::class,"show_make_list"])->name('make');
            Route::get('/make_data_table',[MakeController::class,"make_data_table"])->name('make-data-table');
            Route::get('save-make',[MakeController::class,"show_save_make"])->name('save-make');
            Route::post('update_make',[MakeController::class,"update_make"])->name("update-make");
            Route::get("delete_make",[MakeController::class,"delete_make"])->name("delete-make");

            Route::get("allcars",[CarController::class,"show_all_cars"])->name("all-cars");
            Route::get("all_cars_data_table",[CarController::class,"show_all_cars_data_table"])->name("all-cars-data-table");
            Route::get("save_car/{id}",[CarController::class,"show_save_car"])->name("save-car");
            Route::get("delete_car/{id}",[CarController::class,"show_delete_car"])->name("delete-car");
            Route::post("post_car_general_info",[CarController::class,"post_car_general_info"])->name('post-car-general-info');
            Route::get('get_city_list_by_country_id/{id}',[CarController::class,"get_city_list_by_country_id"])->name('get-city-list-by-country_id');
           
            Route::get('get_media/{id}',[CarController::class,"get_media"])->name('get-media');
            Route::post("save_auction_time",[CarController::class,"save_auction_time"])->name('save-auction-time');
            Route::get('change_car_status',[CarController::class,"change_car_status"])->name('change-car-status');
            Route::get("sold_cars",[CarController::class,"show_sold_cars"])->name("sold-cars");
            Route::get("sold_cars_data_table",[CarController::class,"sold_cars_data_table"])->name("sold-cars-data-table");


            Route::get("news",[SpotLightController::class,"show_news"])->name("news");
            Route::get("news_data_table",[SpotLightController::class,"show_news_data_table"])->name("news-data-table");
            Route::get("save_news",[SpotLightController::class,"show_news_save"])->name('save-news');
            Route::post("update_news",[SpotLightController::class,"update_news"])->name('update-news');
            Route::get("delete_news",[SpotLightController::class,"delete_news"])->name('delete-news');

            Route::get("contact_us_list",[AuthencationController::class,"show_contact_us_list"])->name("contact-us-list");
            Route::get("contact_us_data_table",[AuthencationController::class,"contact_us_data_table"])->name("contact-us-data-table");
            Route::get("delete_contact/{id}",[AuthencationController::class,"delete_contact"])->name("delete-contact");

            Route::get("sales_help",[AuthencationController::class,"show_sales_help"])->name('sales-help');
            Route::get("sales_help_data_table",[AuthencationController::class,"sales_help_data_table"])->name('sales-help-data-table');
            Route::get("delete_sales_inquiry/{id}",[AuthencationController::class,"delete_sales_inquiry"])->name('delete-sales-inquiry');


            Route::get('subscriber',[AuthencationController::class,"show_subscriber"])->name('subscriber');
            Route::get("subscriber-data-table",[AuthencationController::class,"subscriber_data_table"])->name("subscriber-data-table");

            Route::get("users",[UserController::class,"show_users_list"])->name('users');
            Route::get("user_data_table",[UserController::class,"user_data_table"])->name("users-data-table");
            Route::get("delete_user",[UserController::class,"delete_user"])->name("delete-user");

            Route::get("my-account",[AuthencationController::class,"show_my_account"])->name("my-account");
            Route::post("update-profile",[AuthencationController::class,"update_profile"])->name("update-profile");

            Route::get("change-password",[AuthencationController::class,"show_change_password"])->name('change-password');
            Route::get("check_current_password/{val}",[AuthencationController::class,"check_current_password"])->name("check-current-password");
            Route::post("update_my_password",[AuthencationController::class,"update_my_password"])->name("update-my-password");

            Route::get("live_car_data_table",[CarController::class,"show_live_car_data_table"])->name('live-car-data-table');

            Route::get("Live_car",[CarController::class,"show_live_car"])->name('live-car');
            Route::get("coming_soon",[CarController::class,"show_coming_soon"])->name("coming-soon");
            Route::get('coming_soon_cars_data_table',[CarController::class,"coming_soon_cars_data_table"])->name('coming-soon-cars-data-table');

            Route::get("buy_now_cars",[CarController::class,"show_buy_now_cars"])->name("buy-now-cars");
            Route::get("buy-now-cars-data-table",[CarController::class,"buy_now_cars_data_table"])->name("buy-now-cars-data-table");
            Route::get("settle_car",[CarController::class,"settle_car"])->name("settle-car");

          

            Route::get("setting",[SettingController::class,"show_setting"])->name("setting");
            Route::post("update-setting",[SettingController::class,"update_setting"])->name("update-setting");

            Route::get("user_cars_list",[UserController::class,"show_user_cars_list"])->name("user-cars-list");
            Route::get("users_cars_data_table",[UserController::class,"show_users_cars_data_table"])->name("users-cars-data-table");

            Route::get('frqlist',[FRQController::class,"show_frqlist"])->name('frqlist');
            Route::get("frq_main_data_table",[FRQController::class,"frq_main_data_table"])->name("frq-main-data-table");
            Route::get("save_topic",[FRQController::class,"save_topic"])->name('save-topic');
            Route::post("update-frq-main",[FRQController::class,"update_frq_main"])->name("update-frq-main");
            Route::get('delete_topic',[FRQController::class,"delete_faq"])->name('delete-topic');

            Route::get("show_frq",[FRQController::class,"show_frq_list"])->name('show-frq');
            Route::get("frq_ques_data_table",[FRQController::class,"frq_ques_data_table"])->name("frq-ques-data-table");
            Route::get("save_ques",[FRQController::class,"save_ques"])->name("save-ques");
            Route::post("update_frq_ques",[FRQController::class,"update_frq_ques"])->name("update-frq-ques");
            Route::get('delete_faq',[FRQController::class,"delete_topic"])->name('delete-ques');


            route::get("get_invoice_data",[UserController::class,"get_invoice_data"])->name("get-invoice-data");
            route::get("get_payment_data",[UserController::class,"get_payment_data"])->name("get-payment-data");
            Route::get("get_user_data",[UserController::class,"get_user_data"])->name("get-user-data");

            Route::get("bid_gap",[SettingController::class,"show_bid_gaps"])->name("bid-gap");
            Route::post("update_bid_gaps",[SettingController::class,"update_bid_gaps"])->name("update-bid-gaps");
            
            Route::get("remove_card_request",[SettingController::class,"remove_card_request"])->name("remove-card-request");
            Route::get("request_card_data_table",[SettingController::class,"request_card_data_table"])->name("request-card-data-table");
            Route::get("change_request_card_status",[SettingController::class,"change_request_card_status"])->name("change_request_card_status");
            
            Route::get("upload_inventory",[SettingController::class,"upload_inventory"])->name("upload_inventory");
            Route::post("post_update_inventory",[SettingController::class,"post_update_inventory"])->name("post-update-inventory");
            
            
            Route::get("car_sync_data",[CarController::class,"update_car_sync_data"])->name("car-sync-data");
          /*  Route::get("payment_setting",[SettingController::class,"payment_setting"])->name("payment-setting");
            Route::post("update_payment_setting",[SettingController::class,"update_payment_setting"])->name("update-payment-setting");*/



    });
});
