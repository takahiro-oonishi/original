
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-4">
                    @include('commons.common')
                </div>

                <div class="col-8">
                    <div class="card text-center">
                        <form method="POST" action="{{route('profile.store')}}" enctype="multipart/form-data" >
                        
                            {{ csrf_field() }}
                            <p>プロフィール画像の変更</p>
                            <input type="file" name="photo">
                            <input type="submit">
                        </form>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($is_image)
                        <figure>
                            <img src="storage/profile_images/{{ Auth::id() }}.jpg" width="350px" >
                            <figcaption>現在のプロフィール画像</figcaption>
                        </figure>
                        @else
                        <figure>
                            <img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 300) }}" alt="">
                            <figcaption>現在のプロフィール画像</figcaption>
                        </figure>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

