<div class="card">
    
    @if(Storage::disk('local')->exists('public/profile_images/'.Auth::id().'.jpg'))
    <img src="../../storage/profile_images/{{ Auth::id() }}.jpg" class="img-fluid rounded mx-auto d-block p-3" width="200px" hight="300px">
    @else
    <img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 300) }}" alt="">
    @endif

    <div class="card-body">
        <p class="card-text">{{ Auth::user()->name }}</p>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item" >
            <a href="{{route('home')}}">ホーム</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('users.show',['id' => Auth::id()]) }}">プロフィール</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('users.index')}}">フォロー</a>
        </li>
    </ul>
    
</div>

