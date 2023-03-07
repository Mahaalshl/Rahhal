@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg_2">
        <h3>{{__('messages.UsersPageAdd')}}</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{__('messages.UsersPageAdmin')}}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="" method="post" id="contactForm" enctype="multipart/form-data"
                          novalidate="novalidate">
@csrf
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.UsersPageName')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Name"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.UsersPageEmail')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Email"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.UsersPagePass')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Password"></input>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.UsersPageConfirm')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="c_password" id="c_password"
                                           placeholder="Confirm Password"></input>
                                </div>
                            </div>
                        </div>



                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{__('messages.UsersPageSend')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
