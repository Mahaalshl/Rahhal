@extends('master')

@section('body')

    <!-- slider_area_start -->
    <div class="slider_area">

        <div class="slider_active owl-carousel">
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{__('messages.HomeCenter')}}</h3>
                                <p>{{__('messages.HomeCenterMsg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center justify-content-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{__('messages.HomeWest')}}</h3>
                                <p>{{__('messages.HomeWestMsg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_3">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{__('messages.HomeNorth')}}</h3>
                                <p>{{__('messages.HomeNorthMsg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center justify-content-center slider_bg_4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{__('messages.HomeSouth')}}</h3>
                                <p>{{__('messages.HomeSouthMsg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_5">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{__('messages.HomeEast')}}</h3>
                                <p>{{__('messages.HomeEastMsg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->


    <!-- about_area_start -->
    <div class="about_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="about_info">
                        <div class="section_title mb-20px">
                            <span>{{__('messages.HomeAbout')}}</span>
                            <h3>{{__('messages.HomeTheRahhal')}}</h3>
                        </div>
                        <p>{{__('messages.HomeAboutRahhal')}}</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7">
                    <div class="about_thumb d-flex">
                        <div class="img_1">
                            <img src="img/about/about3.jpg" alt="">
                        </div>
                        <div class="img_2">
                            <img src="img/about/about4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->




@endsection
