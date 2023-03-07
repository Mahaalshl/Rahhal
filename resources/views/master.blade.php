<!doctype html>
<html class="no-js" lang="{{app()->getLocale()}}" 
data-textdirection="{{app()->getLocale() == "ar" ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rahhal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href={{url('/')."/img/home/R.png"}}>
    <!-- Place favicon.ico in the root directory -->
    @if(app()->getLocale() == "en")
        <link rel="stylesheet" href={{url('/')."/css/bootstrap.min.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/owl.carousel.min.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/magnific-popup.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/font-awesome.min.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/themify-icons.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/nice-select.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/flaticon.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/gijgo.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/animate.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/slicknav.css"}}>
        <link rel="stylesheet" href={{url('/')."/css/style.css"}}>
    @elseif(app()->getLocale() == "ar")
        <link rel="stylesheet" href={{url('/')."/rtl_css/bootstrap.min.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/owl.carousel.min.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/magnific-popup.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/font-awesome.min.css"}}>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <link rel="stylesheet" href={{url('/')."/rtl_css/themify-icons.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/nice-select.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/flaticon.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/gijgo.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/animate.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/slicknav.css"}}>
        <link rel="stylesheet" href={{url('/')."/rtl_css/style.css"}}>
    @endif 
    <!-- CSS here -->
    {{-- <link rel="stylesheet" href={{url('/')."/css/bootstrap.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/owl.carousel.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/magnific-popup.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/font-awesome.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/themify-icons.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/nice-select.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/flaticon.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/gijgo.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/animate.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/slicknav.css"}}>
    <link rel="stylesheet" href={{url('/')."/css/style.css"}}> --}}
    {{-- rtl --}}
    {{-- <link rel="stylesheet" href={{url('/')."/rtl_css/bootstrap.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/owl.carousel.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/magnific-popup.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/font-awesome.min.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/themify-icons.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/nice-select.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/flaticon.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/gijgo.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/animate.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/slicknav.css"}}>
    <link rel="stylesheet" href={{url('/')."/rtl_css/style.css"}}> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>      
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body>
@include('sweetalert::alert')

<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-5 col-lg-6">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation" >
                                    <li><a href="/">{{__('messages.home')}}</a></li>

                                    @auth
                                        @if(auth()->user()->role =='admin')
                                        <li><a href="#"> {{__('messages.places')}} <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href='/places'>{{__('messages.all_places')}} </a></li>
                                                <li><a href="/place/create">{{__('messages.MCreateAplace')}}</a></li>
                                            </ul>
                                        </li>
                                        @else
                                            <li><a href="/places">{{__('messages.places')}}</a></li>
                                        @endif
                                    @endauth
                                    @guest
                                        <li><a href="/places">{{__('messages.places')}}</a></li>
                                    @endguest

                                    @auth
                                        @if(auth()->user()->role =='visitor' || auth()->user()->role =='traveler' )
                                            <li><a href="#">{{__('messages.posts')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href='/posts'>{{__('messages.all_posts')}}</a></li>
                                                    <li><a href="/post/create">{{__('messages.create_a_post')}}</a></li>
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="/posts">{{__('messages.posts')}}</a></li>
                                        @endif
                                    @endauth
                                    @guest
                                        <li><a href="/posts">{{__('messages.posts')}}</a></li>
                                    @endguest

                                    <li><a href="#">{{__('messages.events')}} <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href='/events'>{{__('messages.all_events')}}</a></li>
                                            <li><a href='/events/upcoming'>{{__('messages.upcoming_events')}}</a></li>
                                            @auth
                                                @if(auth()->user()->role =='admin')
                                                    <li><a href="/event/create">{{__('messages.create_an_event')}}</a></li>
                                                @endif
                                            @endauth
                                        </ul>
                                    </li>
                                    @auth
                                        @if(auth()->user()->role =='admin')
                                            <li><a href="/requests">{{__('messages.requests')}}</a></li>
                                            <li><a href="#"> {{__('messages.admin')}}  <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href='/users'> {{__('messages.users')}} </a></li>
                                                    <li><a href='/comments'> {{__('messages.comments')}} </a></li>
                                                </ul>
                                            </li>
                                            
                                        @elseif(auth()->user()->role =='traveler')
                                            <li><a href="#"> {{__('messages.requests')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href='/requests'>{{__('messages.my_requests')}}</a></li>
                                                    <li><a href="/request/create">{{__('messages.apply_a_request')}}</a></li>
                                                </ul>
                                            </li>

                                        @endif
                                    @endauth
                                    <li><a href="/about">{{__('messages.about')}}</a></li>
                                    @guest
                                    <li><a href="/contact">{{__('messages.contact')}}</a></li>
                                    @endguest
                                    @auth
                                    @if(auth()->user()->role !=='admin')
                                    <li><a href="/contact">{{__('messages.contact')}}</a></li>
                                    @endif
                                    @endauth
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.html">
                                <img width="80" src={{url('/')."/img/home/logoo.png"}} alt="">
                            </a>
                    </div>
                    
                    </div>
                    <div id="navigation" class="col-xl-5 col-lg-4 d-none d-lg-block" role="menuitem">
                        <div class="book_room">

                            @auth              

                                <p style="color: #ffffff; font-weight: 600;font-family: 'Cairo', Raleway,sans-serif;"> {{__('messages.welcome')}} {{auth()->user()->name}} </p>
                                <div class="btn btn-danger" style="margin:20px; background-color:purple; border-color: purple;">
                                    <a href="/logout" style="color: aliceblue; font-weight: 600;font-family:'Cairo', Raleway,sans-serif;">{{__('messages.logout')}}</a>
                                </div>
                            @endauth
                            @guest
                                <div class="btn btn-primary" style="margin:10px; background-color:purple; border-color: purple;">
                                    <a class="popup-with-form" style="color: aliceblue; font-weight: 600;font-family:'Cairo', Raleway,sans-serif;" href="#login-form">{{__('messages.login')}}</a>
                                </div>
                                <div class="btn btn-info" style="margin:10px; background-color:purple; border-color: purple;">
                                    <a class="popup-with-form" style="color: aliceblue; font-weight: 600;font-family: 'Cairo', Raleway,sans-serif;" href="#signup-form" >{{__('messages.signup')}}</a>
                                </div>
                            @endguest
                                
                            <li class="nav-item dropdown" style="color: #ffffff; font-weight: 600;font-family: 'Cairo', Raleway,sans-serif; margin: 20px; ">
                                <a class="fa fa-globe" style="color:#ffffff ; font-size:26px" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{-- {{ Config::get('languages')[App::getLocale()] }} --}}
                                </a>
                                <div class="dropdown-menu" style="color: #ffffff; font-weight: 600;font-family: 'Cairo', Raleway,sans-serif;" aria-labelledby="navbarDropdownMenuLink">
                                @foreach (Config::get('languages') as $lang => $language)
                                    {{-- @if ($lang != App::getLocale()) --}}
                                            <a class="dropdown-item" style="font-weight: 600;font-family:'Cairo', Raleway,sans-serif;" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                    {{-- @endif --}}
                                @endforeach
                                </div>
                            </li>


                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<!-- header-end -->

<!-- master-page-body -->
@yield('body')
<!-- master-page-body-end -->

<!-- footer -->
<div class="footerMain">
    <footer class="footer">
        <div class="footerContainer">
            <div class="footerRow">
                <div class="footerColumn">
                    <h4> {{__('messages.TripPlan')}} </h4>
                    <ul>
                        <li><a href="https://www.almosafer.com/ar/hotels-home">{{__('messages.stay')}}</a></li>
                        <li><a href="#">{{__('messages.eat')}} </a></li>
                        <li><a href="#">{{__('messages.visit')}} </a></li>
                    </ul>
                </div>
                <div class="footerColumn"> 
                    <h4>{{__('messages.Travelinfo')}}</h4>
                    <ul>
                        <li><a href="#">{{__('messages.emergency')}} </a></li>
                        <li><a href="#">{{__('messages.TouristVisa')}} </a></li>
                        <li><a href="#">{{__('messages.Currency')}} </a></li>
                    </ul>
                </div>
                <div class="footerColumn">
                    <h4>{{__('messages.Follow')}} </h4>
                    <div class="SMLink">
                        <a href="https://twitter.com/rahhalteam4"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
    
                    </div>
                </div>
                
            </div>
            
        </div>	
    </footer></div>

<!-- link that opens popup -->

<!-- form itself end-->
<form id="login-form" method="post" action="/login" class="test-form white-popup-block mfp-hide">
    @csrf
    <div class="popup_box ">
        <div class="popup_inner">
            <h3>{{__('messages.login')}} </h3>
            <form action="#">
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.email')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="email" name="email" class="form-control" type="text" placeholder="Email">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.password')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="password" name="password" class="form-control" type="password"
                               placeholder="Password">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-12">
                        <button type="submit" class="boxed-btn3">{{__('messages.login')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</form>
<!-- form itself end -->
<!-- form itself end-->
<form id="signup-form" method="post" action="/signup" class="test-form white-popup-block mfp-hide" enctype="multipart/form-data">
    @csrf
    <div class="popup_box ">
        <div class="popup_inner">
            <h3>{{__('messages.signup')}} </h3>
            <form action="#">
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.MName')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="signup_name" name="signup_name" type="text" placeholder="FullName"
                               class="form-control">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.email')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="signup_email" name="signup_email" type="email" placeholder="Email"
                               class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.MPassword')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="signup_password" name="signup_password" type="password" placeholder="Password"
                               class="form-control">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.MImage')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="signup_image" name="signup_image" type="file" class="form-control form-control-file">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-2">
                        <h4 class="form-text">{{__('messages.MDescription')}} </h4>
                    </div>
                    <div class="col-10">
                        <input id="signup_description" name="signup_description" type="text" placeholder="Description"
                               class="form-control">
                    </div>
                </div>
                <br/>
                <div class="col-xl-12">
                    <button type="submit" class="boxed-btn3">{{__('messages.MSignup')}} </button>
                </div>
            </form>
        </div>
    </div>
</form>

<div class="modal" id="messages"
     style="position: absolute;left: 50%; top:30%;width: 100%;height: 300px;margin-left: -20%;margin-top: -150px ">
    <div class="popup_box" role="document">
        <div class="popup_inner">
            <h5 class="modal-title">{{__('messages.errors')}} </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
        </form>
    </div>
</div>
</div>

<!-- JS here -->
<script src={{url('/')."/js/vendor/modernizr-3.5.0.min.js"}}></script>
<script src={{url('/')."/js/vendor/jquery-1.12.4.min.js"}}></script>
<script src={{url('/')."/js/popper.min.js"}}></script>
<script src={{url('/')."/js/bootstrap.min.js"}}></script>
<script src={{url('/')."/js/owl.carousel.min.js"}}></script>
<script src={{url('/')."/js/isotope.pkgd.min.js"}}></script>
<script src={{url('/')."/js/ajax-form.js"}}></script>
<script src={{url('/')."/js/waypoints.min.js"}}></script>
<script src={{url('/')."/js/jquery.counterup.min.js"}}></script>
<script src={{url('/')."/js/imagesloaded.pkgd.min.js"}}></script>
<script src={{url('/')."/js/scrollIt.js"}}></script>
<script src={{url('/')."/js/jquery.scrollUp.min.js"}}></script>
<script src={{url('/')."/js/wow.min.js"}}></script>
<script src={{url('/')."/js/nice-select.min.js"}}></script>
<script src={{url('/')."/js/jquery.slicknav.min.js"}}></script>
<script src={{url('/')."/js/jquery.magnific-popup.min.js"}}></script>
<script src={{url('/')."/js/plugins.js"}}></script>
<script src={{url('/')."/js/gijgo.min.js"}}></script>

<!--contact js-->
<script src={{url('/')."/js/contact.js"}}></script>
<script src={{url('/')."/js/jquery.ajaxchimp.min.js"}}></script>
<script src={{url('/')."/js/jquery.form.js"}}></script>
<script src={{url('/')."/js/jquery.validate.min.js"}}></script>
<script src={{url('/')."/js/mail-script.js"}}></script>
{{-- <script src="{{url('/')."/rtl_js/main.js"}}"></script>
<script src="{{url('/')."/js/main.js"}}"></script> --}}
{{-- <script src="{{url('/')."/js/main.js"}}"></script> --}}
{{-- <script src="{{url('/')."/js/main.js"}}"></script> --}}
<script src="{{url('/')."/js/sweetalert.all.js"}}"></script>
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- @if(app()->getLocale() == "en"){
}@elseif(app()->getLocale() == "ar"){
    <script src="{{url('/')."/rtl_js/main.js"}}"></script>
}@endif --}}
    @if(app()->getLocale() == "ar")
        <script>
                document.body.style.direction = "rtl";
        </script>
    <script src="{{url('/')."/rtl_js/main.js"}}"></script>
    @else
        <script src="{{url('/')."/js/main.js"}}"></script>

    @endif 
@if($errors->any()) 

    <script>
        // function displayInfo(){
        //     alert('messages');  // display string message

        // }
        $('#messages').modal('show');
        setTimeout(() => {
            $('#messages').modal('hide');
        }, 4000);
        
    </script>
@endif
@yield("scripts")

</body>

</html>
