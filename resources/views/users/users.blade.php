@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                
                @if(Storage::disk('local')->exists('public/profile_images/'.$user->id.'.jpg'))
                <img src="../../storage/profile_images/{{ $user->id }}.jpg" class="img-fluid rounded mx-auto d-block p-1" width="75px" >
                @else
                <img class="mr-2 mb-3 rounded" src="{{ Gravatar::src($user->email, 70) }}" alt="">
                @endif
                
                <div class="media-body">
                    <div class="pt-2">
                        <h5><a href="{{ route('users.show',['id' => $user->id]) }}">{{ $user->name }}</a></h5>
                        <div class="row">
                            <div class="col-4">
                                @if (Auth::id() != $user->id)
                                    @if (Auth::user()->is_following($user->id))
                                        {!! Form::open(['route' => ['follow.unfollow', $user->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('フォロー解除', ['class' => "btn btn-danger btn-block"]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route' => ['follow.follow', $user->id]]) !!}
                                            {!! Form::submit('フォロー', ['class' => "btn btn-primary btn-block"]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </li>
        @endforeach
    </ul>
    {{ $users->links('pagination::bootstrap-4') }}
@endif
