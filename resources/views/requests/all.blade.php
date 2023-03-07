@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.RequestPage')}}</h3>
    </div>
    <!-- bradcam_area_end -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @forelse($requests as $request)
                            <article class="blog_item">

                                <div class="blog_item_img">
                                    <img class="rounded-0" height="350" src="{{$request->picture}}" alt="">
                                    @if($request->request_type=="event")
                                        <a href="#" class="blog_item_date">
                                            <h3>{{date('d', strtotime($request->event_date))}}</h3>
                                            <p>{{date('M-y', strtotime($request->event_date))}}</p>
                                        </a>
                                    @endif
                                    @auth
                                        <div style="position: absolute;top: 3%;right: 3%;">
                                            @if(Auth::id()==$request->created_by  )
                                                <a href="/request/{{$request->id}}/edit"><i
                                                        class="fa fa-edit"
                                                    ></i></a>
                                            @endif
                                            @if(Auth::id()==$request->created_by || Auth::user()->role='admin' )
                                                <a class="request_delete"
                                                   data-id="{{$request->id}}"><i
                                                        class="fa fa-close"
                                                    ></i></a>
                                            @endif
                                        </div>

                                    @endauth
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="/request/{{$request->id}}">
                                        <h2>{{$request->title}}@if($request->request_type=='place')
                                                -<span
                                                    style="font-size: medium">{{$request->region->name}}</span>
                                            @endif</h2>
                                    </a>
                                    @if($request->state=='pending')
                                        <span class="badge badge-warning"
                                              style="float: right">{{__('messages.RequestPagePending')}}</span>
                                    @elseif($request->state=='accepted')
                                        <span class="badge badge-success"
                                              style="float: right">{{__('messages.RequestPageApproved')}}</span>
                                    @else
                                        <span class="badge badge-danger"
                                              style="float: right">{{__('messages.RequestPageRejected')}}</span>
                                    @endif
                                    <span class="badge badge-secondary"
                                          style="float: right">{{ucfirst($request->request_type)}}</span>
                                    <p>{{$request->description}}</p>
                                </div>
                            </article>
                        @empty
                            <article class="blog_item">
                                <h3>{{__('messages.RequestPageSearchMsg')}}</h3>
                            </article>
                        @endforelse
                        {{$requests->withQueryString()->links()}}

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="/requests" type="get">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name='s' class="form-control" placeholder='Search Keyword'
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                        type="submit">{{__('messages.RequestPageSearch')}}
                                </button>
                            </form>
                        </aside>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@endsection


@section("scripts")

    <script>

        $(".request_delete").click(function () {
            let request_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.parentElement;

            $.get("/request/delete/" + request_id, function (data, status) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
        });
    </script>
@endsection
