<div class="scrollbar-sidebar">
                  <div class="app-sidebar__inner">
                     <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li class="">
                           <a href="{{route('dashboard')}}" class="" > <!-- mm-active -->
                           <i class="metismenu-icon pe-7s-rocket"></i>Dashboard
                           </a>
                        </li>
                        <!-- <li class="">
                           <a href="{{route('make')}}" >
                           <i class="metismenu-icon pe-7s-paint-bucket"></i>Make
                           </a>
                        </li> -->
                        
                        <li class="<?=Session::get('sub_menu')=="11"?'mm-active':''?>">
                           <a href="{{route('upload_inventroy')}}" >
                           <i class="metismenu-icon pe-7s-paint-bucket"></i>Upload Inventory
                           </a>
                        </li>
                        
                        <li  class="<?=Session::get('main_menu')=="cars"?'mm-active':''?>">
                           <a href="#">
                           <i class="metismenu-icon pe-7s-car"></i>Cars
                           <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                           </a>
                           <ul>
                              <li>
                                 <a href="{{route('all-cars')}}"  class="<?=Session::get('sub_menu')=="01"?'mm-active':''?>" >
                                 <i class="metismenu-icon"></i>All
                                 </a>
                              </li>
                              <li>
                                 <a href="{{route('live-car')}}" class="<?=Session::get('sub_menu')=="02"?'mm-active':''?>">
                                 <i class="metismenu-icon"></i>Live Auction
                                 </a>
                              </li>
                              <li>
                                 <a href="{{route('coming-soon')}}" class="<?=Session::get('sub_menu')=="03"?'mm-active':''?>">
                                 <i class="metismenu-icon">
                                 </i>Coming Soon
                                 </a>
                              </li>
                             <li>
                                 <a href="{{route('sold-cars')}}" class="<?=Session::get('sub_menu')=="04"?'mm-active':''?>">
                                 <i class="metismenu-icon"></i> Sold Cars
                                 </a>
                              </li>
                           </ul>
                        </li>
                        
                       <!--  <li>
                           <a href="#">
                           <i class="metismenu-icon pe-7s-news-paper"></i>In The SpotLight
                           <i class="metismenu-state-icon pe-7s-angle-down"></i>
                           </a>
                           <ul  
                              >
                              <li>
                                 <a href="{{route('news')}}" >
                                 <i class="metismenu-icon"></i> News
                                 </a>
                              </li>
                           </ul>
                        </li> -->

                        <li class="<?=Session::get('main_menu')=="dealers"?'mm-active':''?>" >
                           <a href="#">
                           <i class="metismenu-icon pe-7s-car"></i>Dealers
                           <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                           </a>
                           <ul>
                              <li>
                                 <a href="{{route('users',['status'=>1])}}" class="<?=Session::get('sub_menu')=="1"?'mm-active':''?>" >
                                 <i class="metismenu-icon"></i>Active Dealers
                                 </a>
                              </li>
                              <li>
                                 <a href="{{route('users',['status'=>0])}}" class="<?=Session::get('sub_menu')=="2"?'mm-active':''?>">
                                 <i class="metismenu-icon"></i>Pending Dealers
                                 </a>
                              </li>
                           </ul>
                        </li>


                       <!--  <li class="">
                           <a href="{{route('users')}}" >
                           <i class="metismenu-icon pe-7s-users"></i>
                           </a>
                        </li> -->
                        <!--<li class="">
                           <a href="{{route('subscriber')}}" >
                           <i class="metismenu-icon pe-7s-safe"></i>Subscriber
                           </a>
                        </li> 
                         <li class="">
                           <a href="{{route('sales-help')}}" >
                           <i class="metismenu-icon pe-7s-safe"></i>Sales Inquiry
                           </a>
                        </li> 
                        <li class="">
                           <a href="{{route('contact-us-list')}}" >
                           <i class="metismenu-icon pe-7s-id"></i>Contact Us
                           </a>
                        </li>-->
                        
                       
                        
                        <li  class="<?=Session::get('main_menu')=="setting"?'mm-active':''?>">
                           <a href="#">
                           <i class="metismenu-icon pe-7s-settings"></i>Setting
                           <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                           </a>
                           <ul>
                              <li>
                                 <a href="{{route('setting')}}"  class="<?=Session::get('sub_menu')=="001"?'mm-active':''?>">
                                 <i class="metismenu-icon"></i>General
                                 </a>
                              </li>
                              <li>
                                 <a href="{{route('bid-gap')}}" class="<?=Session::get('sub_menu')=="002"?'mm-active':''?>">
                                 <i class="metismenu-icon"></i>Bid Gap
                                 </a>
                              </li>
                          
                             <!--  <li>
                                 <a href="{{route('frqlist')}}" >
                                 <i class="metismenu-icon"></i>FAQ Section
                                 </a>
                              </li> -->
                              
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>