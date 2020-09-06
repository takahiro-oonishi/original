<ul class="list-unstyled">
    @foreach ($tweets as $tweet)
        <li class="media mb-3">
            
            @if(Storage::disk('local')->exists('public/profile_images/'.$tweet->user_id.'.jpg'))
            <img src="../../storage/profile_images/{{ $tweet->user_id }}.jpg" class="img-fluid rounded mx-auto d-block p-1" width="75px" >
            @else
            <img class="mr-2 rounded" src="{{ Gravatar::src($tweet->user->email, 70) }}" alt="">
            @endif

            <div class="media-body">
                <div>
                    <a href="{{ route('users.show',['id' => $tweet->user->id]) }}">{{ $tweet->user->name }}</a>
                </div>
                <span class="text-muted"> {{ $tweet->created_at }}</span>
                <div class="row">
                    <div class="col-10">
                        <p class="mb-0">{!! nl2br(e($tweet->content)) !!}</p>
                        
                    </div>
                    <div class="col-2">
                        @if (Auth::id() == $tweet->user_id)
                            {!! Form::open(['route' => ['tweets.destroy', $tweet->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-secondary btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $tweets->links('pagination::bootstrap-4') }}
