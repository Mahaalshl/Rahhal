@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.EventsPage')}} </h3>
    </div>
    <!-- bradcam_area_end -->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{$event->picture}}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{$event->title}}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><i class="fa fa-comments"></i> {{$event->comments->count()}} {{__('messages.EventsPageComments')}} </li>
                            </ul>
                            <p class="excert">
                                {{$event->description}}
                            </p>

                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info">
                                @auth
                                    <a class="align-middle like"><i
                                            class="fa fa-heart"
                                            @if($checkLike>0) style="color:red" @endif></i></a>
                                @endauth
                                <span
                                    id="likes_count">{{$event->likes->count()}}</span>
                                    {{__('messages.Placelikes')}}</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                            </div>

                        </div>
                    </div>
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{$event->creator->image}}" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>{{$event->creator->name}}</h4>
                                </a>
                                <p>{{$event->creator->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4><span id="comments_count"> {{$event->comments->count()}} </span>{{__('messages.EventsPageComments')}} </h4>
                        <div class="comment-list">
                            @forelse($event->comments as $comment)
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="{{$comment->writer->image}}" alt="">
                                        </div>
                                        <div class="desc">
                                            <p class="comment">
                                                {{$comment->body}}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h5>
                                                        <a href="#">{{$comment->writer->name}}</a>
                                                    </h5>
                                                    @auth
                                                    @if(Auth::id()==$comment->user_id || Auth::user()->role='admin' || Auth::id() == $event->created_by)
                                                        <a class="align-middle date comment_delete"
                                                           data-id="{{$comment->id}}"><i
                                                                class="fa fa-close"
                                                            ></i></a>
                                                    @endif
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <h3>{{__('messages.EventPageNoComments')}}</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @Auth()
                        <div class="comment-form">
                            <h4>{{__('messages.EventPageLeaveComment')}} </h4>
                            <form class="form-contact comment_form" action="/event/comment" method="post"
                                  id="commentForm">
                                @csrf
                                <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                        placeholder="Write Comment"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button button-contactForm btn_1 boxed-btn">{{__('messages.EventPageComment')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endAuth
                    @guest()
                        <div class="comment-form">
                            <h3>{{__('messages.EventPleaseWriteComment')}} </h3>
                        </div>
                    @endguest
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
                                        type="submit">{{__('messages.EventSearch')}} 
                                </button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{__('messages.EventRecent')}}</h3>
                            @foreach($recentEvents as $recentEvent)
                                <div class="media post_item">
                                    <img height="50" src="{{$recentEvent->picture}}" alt="event">
                                    <div class="media-body">
                                        <a href="/event/{{$recentEvent->id}}">
                                            <h3>{{$recentEvent->title}}</h3>
                                        </a>
                                        <p>{{date('d-m-Y', strtotime($recentEvent->event_time))}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================ Blog Area end =================-->
@endsection

@section("scripts")

    <script>
        $(".like").click(function () {
            $.get("/event/{{$event->id}}/like", function (data, status) {
                let likes_count = $("span#likes_count").html();
                if (data == 1) {
                    $("i.fa-heart").css('color', 'red');
                    $("span#likes_count").html(parseInt(likes_count) + 1)
                } else {
                    $("i.fa-heart").css('color', 'black');
                    $("span#likes_count").html(parseInt(likes_count) - 1)

                }

            });
        });
        $(".comment_delete").click(function () {
            let comment_id = this.getAttribute('data-id');
            let comments_count = $("span#comments_count").html();
            let grand_parent = this.parentElement.parentElement.parentElement.parentElement.parentElement;


            $.get("/comment/delete/" + comment_id, function (data, status) {
                if (data == 1) {
                    grand_parent.remove();
                    $("span#comments_count").html(parseInt(comments_count) - 1)
                    if (comments_count == 1) {
                        $('.comment-list').html(` <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <h3>No comments yet!!</h3>
                    </div>
                </div>`);
                    }

                }
            });
        });
    </script>
@endsection
