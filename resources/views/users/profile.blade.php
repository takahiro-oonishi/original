<div class="card mb-3">

    @if(Storage::disk('local')->exists('public/profile_images/'.$user->id.'.jpg'))
    <img src="../../storage/profile_images/{{ $user->id}}.jpg" class="img-fluid rounded mx-auto d-block p-3" width="300px" >
    @else
    <img src="{{ Gravatar::src($user->email, 200) }}" class="rounded mx-auto d-block p-3" alt="...">
    @endif
    
    <div class="text-center">
        @if (Auth::id() === $user->id)
            {!! Form::open(['route' => ['profile.index'], 'method' => 'get']) !!}
            {!! Form::submit('プロフィール画像の変更', ['class' => 'btn btn-primary btn-sm']) !!}
            {!! Form::close() !!}
        @endif
    </div>

    <div class="card-body text-center">
        <h1 class="card-title">{{ $user->name }}</h1>
    </div>
    
</div>