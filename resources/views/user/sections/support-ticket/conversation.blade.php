@extends('user.layouts.master')
@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Support Tickets")])
@endsection
@section('content') 
    <div class="body-wrapper">
        <div class="custom-card support-card mt-20">
            <div class="support-card-wrapper">
                <div class="card-header">
                    <div class="card-header-user-area">
                        <img class="avatar" src="{{ get_image($support_ticket->user->image,"user-profile") }}" alt="client">
                        <div class="card-header-user-content">
                            <h6 class="title">{{ $support_ticket->user->fullname }}</h6>
                            <span class="sub-title">{{ __("Ticket ID") }} : <span class="text--warning">#{{ $support_ticket->token }}</span></span>
                        </div>
                    </div>
                    <div class="info-btn">
                        <i class="las la-info-circle"></i>
                    </div>
                </div>
                <div class="support-chat-area">
                    <div class="chat-container messages">
                        <ul>
                            @foreach ($support_ticket->conversations ?? [] as $item)
                                <li class="media media-chat @if ($item->sender_type == "USER") media-chat-reverse sent @else replies @endif">
                                    <img class="avatar" src="{{ $item->senderImage }}" alt="Profile">
                                    <div class="media-body">
                                        <p>{{ $item->message }}</p> 
                                        @if ($item->file_path != null)
                                            <img src="{{ get_image($item->file_path,'support-attachment') }}" style="float: right" alt="$item->file_path" width="240"> 
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @include('admin.components.support-ticket.conversation.message-input',['support_ticket' => $support_ticket])
                </div>
            </div> 
            @include('admin.components.support-ticket.details',['support_ticket' => $support_ticket])
        </div>
    </div>
@endsection
@include('admin.components.support-ticket.conversation.connection-user',[
    'support_ticket' => $support_ticket,
    'route'          => setRoute('user.support.ticket.message.send'),
])
