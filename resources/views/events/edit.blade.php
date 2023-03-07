@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg_2">
        <h3> {{__('messages.EventEdit')}}  {{$event->id}}</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{__('messages.EventPageRequests')}} </h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="" method="post" id="contactForm" enctype="multipart/form-data"
                          novalidate="novalidate">
@csrf
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.EventCreateTitle')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title" value="{{$event->title}}"
                                           placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.EventCreateImage')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.EventDate')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="datetime-local" class="form-control" name="event_date" id="event_date"
                                           value="{{$event->event_date}}" min="@php echo date('Y-m-d').'T'.date('h:i'); @endphp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.EventCreateDescription')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="description" id="description" cols="30"
                                              rows="9" placeholder="Description">{{$event->description}}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{__('messages.EventPageUpdate')}} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
