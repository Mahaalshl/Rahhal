@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.PlacesPage')}} </h3>
    </div>
    <!-- bradcam_area_end -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @forelse($places as $place)
                            <article class="blog_item">

                                <div class="blog_item_img">
                                    <img class="rounded-0" height="350" src="{{$place->picture}}" alt="">

                                    @auth
                                        <div style="position: absolute;top: 3%;right: 3%;">
                                            @if(Auth::id()==$place->created_by  )
                                                <a href="/place/{{$place->id}}/edit"><i
                                                        class="fa fa-edit"
                                                    ></i></a>
                                            @endif
                                            @if(Auth::id()==$place->created_by || Auth::user()->role=='admin' )
                                                <a class="place_delete"
                                                   data-id="{{$place->id}}"><i
                                                        class="fa fa-close"
                                                    ></i></a>
                                            @endif
                                        </div>

                                    @endauth
                                </div>

                                <div class="blog_details">

                                    <a class="d-inline-block" href="/place/{{$place->id}}">
                                        <h2>{{$place->title}}-<span
                                                style="font-size: medium">{{$place->region->name}}</span></h2>

                                    </a>

                                    <p>{{$place->description}}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-comments"></i> {{$place->comments->count()}}
                                            {{__('messages.PlacePageComments')}} </a></li>
                                    </ul>
                                </div>
                            </article>
                        @empty
                            <article class="blog_item">
                                <h3>{{__('messages.PlaceNoSearchResults')}} </h3>
                            </article>

                        @endforelse
                        {{$places->withQueryString()->links()}}

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="/places" type="get">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name='s' class="form-control" placeholder='Search Keyword'
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <h4 class="form-text">{{__('messages.PlaceCreateRegion')}} </h4>
                                        </div>
                                        <div class="col-9">
                                            <select name="region" class="nice-select" style="width: 100%" id="type">
                                                <option value="-1"> {{__('messages.PlaceAll')}} </option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                        type="submit">{{__('messages.PlaceSearch')}} 
                                </button>
                            </form>
                        </aside>


                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{__('messages.PlaceRecent')}} </h3>
                            @foreach($recentPlaces as $recentPlace)
                                <div class="media post_item">
                                    <img height="50" src="{{$recentPlace->picture}}" alt="place">
                                    <div class="media-body">
                                        <a href="place/{{$recentPlace->id}}">
                                            <h3>{{$recentPlace->title}}</h3>
                                        </a>
                                        <p>{{date('d-m-Y', strtotime($recentPlace->created_at))}}</p>
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

        $(".place_delete").click(function () {
            let place_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.parentElement;

            $.get("/place/delete/" + place_id, function (data, status) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
        });
    </script>
@endsection
