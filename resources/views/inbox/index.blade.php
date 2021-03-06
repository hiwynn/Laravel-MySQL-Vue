@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">私信列表</div>
                    <div class="card-body">
                        @foreach($messages as $messageGroup)
                            <div class="media {{ $messageGroup->first()->shouldAddUnreadClass() ? 'unread' : '' }}">
                                <div class="media-left">
                                    <a href="">
                                        @if(Auth::id() == $messageGroup->last()->from_user_id)
                                            <img style="width: 60px;"
                                                 src="{{ $messageGroup->last()->toUser->avatar }}">
                                        @else
                                            <img style="width: 60px;"
                                                 src="{{ $messageGroup->last()->fromUser->avatar }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="">
                                            @if(Auth::id() == $messageGroup->last()->from_user_id)
                                                {{ $messageGroup->last()->toUser->name }}
                                            @else
                                                {{ $messageGroup->last()->fromUser->name }}
                                            @endif
                                        </a>
                                    </h4>
                                    <p>
                                        <a href="/inbox/{{ $messageGroup->first()->dialog_id }}">
                                            {{ $messageGroup->first()->body }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
