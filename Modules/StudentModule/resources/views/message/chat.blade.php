@extends('frontendmodule::layouts.master')

@section('title', 'Messages')

@push('css')
    <style>
        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper {
            height: 600px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
            padding-left: 10px;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            right: 20px;
            top: 10px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received,
        .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach ($users as $user)
                            <li class="user" id="{{ $user->id }}">
                                @if ($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-body">
                                        <p class="name"><strong>{{ $user->first_name }}
                                                {{ $user->last_name }}</strong>
                                        </p>
                                        <p class="email">{{ $user->user_type }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8" id="messages">
                <h1 class="h1">Select one user for start conversations</h1>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script>
        var receiver_id = '';
        var my_id = "{{ auth()->id() }}";
        $(document).ready(function() {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('984ed3922289f8033038', {
                cluster: 'ap2'
            });
            var channelName = "<?php echo 'notify-channel'; ?>";
            //var channelName =  'notify-channel';
            var status = $('#id').val();
            var channel = pusher.subscribe('notify-channel');
            channel.bind('App\\Events\\Notify', function(data) {
                //  alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').click(function() {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                // alert("receiver_id");
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function(data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                        //alert("receiver_id");
                    }
                });
            });

            $(document).on('click', '#send-btn', function(e) {
                var message = $('#message-input').val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (message != '' && receiver_id != '') {
                    $('#message-input').val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {},
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
@endpush
