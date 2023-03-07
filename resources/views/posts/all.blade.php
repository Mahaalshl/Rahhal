@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3> {{__('messages.PostsPage')}} </h3>
    </div>
    <!-- bradcam_area_end -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @forelse($posts as $post)
                            <article class="blog_item">

                                <div class="blog_item_img">
                                    <img class="rounded-0" height="350" src="{{$post->picture}}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{date('d', strtotime($post->created_at))}}</h3>
                                        <p>{{date('M-y', strtotime($post->created_at))}}</p>
                                    </a>
                                    @auth
                                        <div style="position: absolute;top: 3%;right: 3%;">
                                        @if(Auth::id()==$post->created_by  )
                                            <a href="/post/{{$post->id}}/edit"><i
                                                    class="fa fa-edit"
                                                ></i></a>
                                        @endif
                                        @if(Auth::id()==$post->created_by || Auth::user()->role=='admin' )
                                            <a class="post_delete"
                                               data-id="{{$post->id}}"><i
                                                    class="fa fa-close"
                                                ></i></a>
                                        @endif
                                        </div>

                                    @endauth
                                </div>

                                <div class="blog_details">

                                    <a class="d-inline-block" href="/post/{{$post->id}}">
                                        <h2>{{$post->title}}</h2>

                                    </a>

                                    <p>{{$post->description}}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-comments"></i> {{$post->comments->count()}}
                                            {{__('messages.PostPageComment')}}</a></li>
                                    </ul>
                                </div>
                            </article>
                        @empty
                            <article class="blog_item">
                                <h3>{{__('messages.PostPageResult')}}</h3>
                            </article>

                        @endforelse
                        {{$posts->withQueryString()->links()}}

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="/posts" type="get">
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
                                        type="submit">{{__('messages.PostPageSearch')}} 
                                </button>
                            </form>
                        </aside>


                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{__('messages.PostPageRecent')}} </h3>
                            @foreach($recentPosts as $recentPost)
                                <div class="media post_item">
                                    <img height="50" src="{{$recentPost->picture}}" alt="post">
                                    <div class="media-body">
                                        <a href="post/{{$recentPost->id}}">
                                            <h3>{{$recentPost->title}}</h3>
                                        </a>
                                        <p>{{date('d-m-Y', strtotime($recentPost->created_at))}}</p>
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

        $(".post_delete").click(function () {
            let post_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.parentElement;

            $.get("/post/delete/" + post_id, function (data, status) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
        });
    </script>
@endsection
