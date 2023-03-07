@extends('master')


@section('body')
@php
$data=[
    'App\Models\Post'=>'Post',
    'App\Models\RequestModel'=>'Request',
    'App\Models\Event'=>'Event',
    'App\Models\Place'=>'Place',
];
$url=[
    'App\Models\Post'=>'/post/',
    'App\Models\RequestModel'=>'/request/',
    'App\Models\Event'=>'/event/',
    'App\Models\Place'=>'/place/',
];
@endphp
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.UserAll')}}</h3>
    </div>
    <div class="btn btn-primary float-right mt-2 mr-4" 
    style=" align-items:center; width:180px; background-color:purple; border-color: purple; height:40px;  margin-top: 15px !important; ">
        <a href="/user/create" style="color: aliceblue; font-weight: 600;font-family: Raleway,sans-serif; ">{{__('messages.AddAdmin')}}</a>
    </div>

    <div class="section-top-border">

        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">{{__('messages.UserAllNo')}}</div>
                    <div class="country">{{__('messages.UserAllName')}}</div>
                    <div class="country">{{__('messages.UserNoLikes')}}</div>
                    <div class="country">{{__('messages.UserAllRole')}}</div>
                    <div class="percentage">{{__('messages.UserAllAction')}}</div>
                </div>
                @foreach($users as $user)
                    <div class="table-row">
                        <div class="serial">{{$user->id}}</div>
                        <div class="country">{{$user->name}}</div>
                        <div class="country">@php
                            $likes =  DB::table('likes')->join('posts', 'likable_type' , '!=','created_at')
                            ->where('created_by',$user->id)->where('likable_type','App\Models\Post')->count();
                         // $likes = DB::raw('SELECT COUNT(*) FROM likes WHERE = 0');
                             echo $likes/2;
                         @endphp</div>
                        <div class="country">{{$user->role}}</div>
                        <div class="percentage">
                            <a class="request_delete"
                               data-id="{{$user->id}}"><i
                                    class="ml-2 mr-2 fa fa-2x fa-close" style="color: red"
                                ></i></a>
                            @if($user->role=='visitor')
                                <a class="promote"
                                   data-id="{{$user->id}}"><i
                                        class="ml-2 mr-2 fa fa-2x fa-level-up" style="color: purple"
                                        title="Promote to traveler"
                                    ></i></a>
                            @endif
                            @if($user->role=='traveler')
                                <a class="dispromote"
                                   data-id="{{$user->id}}"><i
                                        class="ml-2 mr-2 fa fa-2x fa-level-down" style="color: purple"
                                        title=" to visitor"
                                    ></i></a>
                            @endif
                            
                        </div>
                        
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
@endsection

@section("scripts")

    <script>

        $(".request_delete").click(function () {
            let user_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement;

            $.get("/user/delete/" + user_id, function (data) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
        });

        $(".promote").click(function () {
            let user_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.children[2];
            location.reload();
            this.remove();
            grand_parent.innerHTML = 'traveler';
            $.get("/user/promote/" + user_id, function (data) {

            });
        });
        $(".dispromote").click(function () {
            let user_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement.children[2];
            location.reload();
            this.remove();
            grand_parent.innerHTML = 'visitor';
            $.get("/user/dispromote/" + user_id, function (data) {

            });
        });
        // $(".like").click(function () {
            $.get("/user/{{$user->id}}/like", function (data, status) {
                let likes_count = $("span#likes_count").html();
        })
    // });
    </script>
@endsection
