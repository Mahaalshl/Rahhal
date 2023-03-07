@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg_2">
        <h3>{{__('messages.RequestCreate')}}</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{__('messages.RequestCreate')}}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="" method="post" id="contactForm"
                          enctype="multipart/form-data"
                          novalidate="novalidate">
                        @csrf


                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestCreateTitle')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title"
                                           placeholder="Title" value="{{$request->title}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestCreateImage')}}</h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div id="event_date" class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestCreateDate')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="datetime-local" class="form-control" name="event_date" id="event_date"
                                           min="@php echo date('Y-m-d').'T'.date('h:i'); @endphp"
                                           value="{{$request->event_date}}">
                                </div>
                            </div>
                        </div>
                        <div id="place_region" class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestCreateRegion')}} </h4>
                            </div>
                            <div class="col-9">
                                <select name="region" class="nice-select" id="region">
                                    @foreach($regions as $region)
                                        <option @if($region->id == $request->region_id) selected
                                                @endif value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br id="place_br">

                        <div class="row">
                            <div class="col-3">
                                <h4 class="form-text">{{__('messages.RequestCreateDescription')}} </h4>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="description" id="description" cols="30"
                                              rows="9" placeholder="Description">{{$request->description}}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{__('messages.RequestCreateSend')}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.ContactKSA')}} </h3>
                            <p>{{__('messages.RequestsEP')}} </p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.ContactNo')}} </h3>
                            <p>{{__('messages.ContactNum')}} </p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{__('messages.ContactEAdd')}} </h3>
                            <p>{{__('messages.RequestsMsg')}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection

@section('scripts')
    <script>
        @if($request->request_type=='event')
        $("#place_region").hide();
        $("#place_br").hide();
        @endif
        @if($request->request_type=='place')
        $("#event_date").hide();
        @endif
        $("#type").change(function () {
            let newValue = $(this).val();
            if (newValue == "place") {
                $("#place_region").fadeIn();
                $("#place_br").fadeIn();
                $("#event_date").fadeOut();
            } else {
                $("#place_region").fadeOut();
                $("#place_br").fadeOut();
                $("#event_date").fadeIn();
            }
        })
    </script>
@endsection
