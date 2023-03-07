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
    @include('sweetalert::alert')

    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.CommentsPage')}}</h3>
    </div>

    <div class="section-top-border">

        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">{{__('messages.CommentsPageSerialNum')}}</div>
                    <div class="country">{{__('messages.CommentsPageType')}}</div>
                    <div class="visit">{{__('messages.CommentsPageRole')}}</div>
                    <div class="percentage">{{__('messages.CommentsPageActions')}}</div>
                </div>
                @foreach($comments as $comment)
                    <div class="table-row">
                        <div class="serial">{{$comment->id}}</div>
                        <div class="country">{{$data[$comment->commentable_type]}}</div>
                        <div class="visit">{{$comment->body}}</div>
                        <div class="percentage">
                                <a href="{{$url[$comment->commentable_type].$comment->commentable_id}}"><i
                                        class="ml-2 mr-2 fa fa-2x fa-edit"
                                    ></i></a>

                                <a class="request_delete"
                                   data-id="{{$comment->id}}"><i
                                        class="ml-2 mr-2 fa fa-2x fa-close" style="color: red"
                                    ></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("scripts")

    <script>
        // import {swal} from './sweetalert.js';
        $(".request_delete").click(function () {
            let request_id = this.getAttribute('data-id');
            let grand_parent = this.parentElement.parentElement;
            $.get("/comment/delete/" + request_id, function (data) {
                if (data == 1) {
                    grand_parent.remove();
                }
            });
            location.reload();
            new swal({
                    icon: "success",
                    text: "Comment deleted Successfully",
                    type: "success",
                    timer: 400000,
            });

        });
    </script>
@endsection
