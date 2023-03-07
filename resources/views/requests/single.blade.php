@extends('master')

@section('body')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.RequestPage')}} </h3>
    </div>
    <!-- bradcam_area_end -->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{$request->picture}}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{$request->title}}@if($request->request_type=='place')
                                    -<span
                                        style="font-size: medium">{{$request->region->name}}</span>
                                @endif</h2>

                            @if($request->state=='pending')
                                <span class="badge badge-warning"
                                      style="float: right">{{__('messages.RequestPagePending')}} </span>
                            @elseif($request->state=='accepted')
                                <span class="badge badge-success"
                                      style="float: right">{{__('messages.RequestPageApproved')}} </span>
                            @else
                                <span class="badge badge-danger"
                                      style="float: right">{{__('messages.RequestPageRejected')}} </span>
                            @endif
                            <span class="badge badge-secondary"
                                  style="float: right">{{ucfirst($request->request_type)}}</span>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><i class="fa fa-comments"></i> {{$request->comments->count()}} {{__('messages.RequestPageComments')}} </li>
                            </ul>
                            <p class="excert">
                                {{$request->description}}
                            </p>

                        </div>
                    </div>

                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{$request->creator->image}}" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>{{$request->creator->name}}</h4>
                                </a>
                                <p>{{$request->creator->description}}</p>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->role=='admin' and $request->state=='pending')
                    <div class="navigation-top">
                        <div class="">
                            <div class="col-12 text-center my-2 my-sm-0">
                                <a class="btn btn-lg btn-success float-left" href="/request/{{$request->id}}/accept">{{__('messages.RequestPageApprove')}}</a>
                                <a class="btn btn-lg btn-danger float-right" href="/request/{{$request->id}}/reject">{{__('messages.RequestPageRejecte')}}</a>
                            </div>

                        </div>
                    </div>
                    @endif
                    <div class="comments-area">
                        <h4><span id="comments_count"> {{$request->comments->count()}} </span>{{__('messages.RequestPageComments')}} </h4>
                        <div class="comment-list">
                            @forelse($request->comments as $comment)
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
                                                        @if(Auth::id()==$comment->user_id || Auth::user()->role='admin' || Auth::id() == $request->created_by)
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
                                        <h3> {{__('messages.RequestNoComments')}} </h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @Auth()
                        <div class="comment-form">
                            <h4> {{__('messages.RequestLeaveComment')}} </h4>
                            <form class="form-contact comment_form" action="/request/comment" method="post"
                                  id="commentForm">
                                @csrf
                                <input type="hidden" name="request_id" id="request_id" value="{{$request->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                        placeholder="Write Comment"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button button-contactForm btn_1 boxed-btn">{{__('messages.RequestPageComment')}} 
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endAuth
                    @guest()
                        <div class="comment-form">
                            <h3>{{__('messages.RequestPleaseWriteComment')}} </h3>
                        </div>
                    @endguest
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

    <!--================ Blog Area end =================-->
@endsection


@section("scripts")

    <script>
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
