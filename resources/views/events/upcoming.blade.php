@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3> {{__('messages.EventsPage')}} </h3>
    </div>
    <!-- bradcam_area_end -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @forelse($events as $event)
                            <article class="blog_item">

                                <div class="blog_item_img">
                                    <img class="rounded-0" height="350" src="{{$event->picture}}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{date('d', strtotime($event->event_date))}}</h3>
                                        <p>{{date('M-y h:i A', strtotime($event->event_date))}}</p>
                                    </a>
                                    @auth
                                        <div style="position: absolute;top: 3%;right: 3%;">
                                        @if(Auth::id()==$event->created_by  )
                                            <a href="/event/{{$event->id}}/edit"><i
                                                    class="fa fa-edit"
                                                ></i></a>
                                        @endif
                                        @if(Auth::id()==$event->created_by || Auth::user()->role='admin' )
                                            <a class="event_delete"
                                               data-id="{{$event->id}}"><i
                                                    class="fa fa-close"
                                                ></i></a>
                                        @endif
                                        </div>

                                    @endauth
                                </div>

                                <div class="blog_details">

                                    <a class="d-inline-block" href="/event/{{$event->id}}">
                                        <h2>{{$event->title}}</h2>

                                    </a>

                                    <p>{{$event->description}}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-comments"></i> {{$event->comments->count()}}
                                            {{__('messages.EventsPageComments')}} </a></li>
                                    </ul>
                                </div>
                            </article>
                        @empty
                            <article class="blog_item">
                                <h3> {{__('messages.EventNoSearchResults')}} </h3>
                            </article>

                        @endforelse
                        {{$events->withQueryString()->links()}}

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="/events" type="get">
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
                                        type="submit">  {{__('messages.EventSearch')}} 
                                </button>
                            </form>
                        </aside>


                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">  {{__('messages.EventRecent')}}</h3>
                            @foreach($recentEvents as $recentEvent)
                                <div class="media post_item">
                                    <img height="50" src="{{$recentEvent->picture}}" alt="event">
                                    <div class="media-body">
                                        <a href="event/{{$recentEvent->id}}">
                                            <h3>{{$recentEvent->title}}</h3>
                                        </a>
                                        <p>{{date('d-m-Y h:i A', strtotime($recentEvent->event_date))}}</p>
                                    </div>
                                </div>
                            @endforeach
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

        $(".event_delete").click(function () {
            let event_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.parentElement;

            $.get("/event/delete/" + event_id, function (data, status) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
        });
    </script>
@endsection
