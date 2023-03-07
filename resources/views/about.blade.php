@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.AboutRahhal')}}</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- about_area_start -->
    <div class="about_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="about_info">
                        <div class="section_title mb-20px">
                            <span>{{__('messages.AboutPage')}}</span>
                            <h3>{{__('messages.AboutPageTheRahhal')}}</h3>
                        </div>
                        <p>{{__('messages.AboutPagePara')}}</p>
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
