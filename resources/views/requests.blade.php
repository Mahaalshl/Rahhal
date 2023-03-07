@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg_2">
        <h3>Requests</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{__('messages.Requests')}}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="" method="post" id="contactForm"
                          novalidate="novalidate">
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestsType')}}</h4>
                            </div>
                            <div class="col-9">
                                <select name="type" class="nice-select" id="type">
                                    <option value="event">{{__('messages.RequestsEvent')}}</option>
                                    <option value="place">{{__('messages.RequestsPlace')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestsTitle')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title"
                                           placeholder="Title"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestsImage')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="image" id="image"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestsDate')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date" id="date"
                                           value="@php echo date('Y-m-d'); @endphp"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestsDescription')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="description" id="description" cols="30"
                                              rows="9" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{__('messages.RequestsSend')}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.RequestsKsa')}}</h3>
                            <p>{{__('messages.RequestsEP')}} </p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.RequestsNo')}}</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.RequestsEmail')}}</h3>
                            <p>{{__('messages.RequestsMsg')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
