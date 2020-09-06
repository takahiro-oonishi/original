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
                    <div class="card">
                        <div class="card-header">
                            @if (Auth::id() == $user->id)
                                {!! Form::open(['route' => 'tweets.store']) !!}
                                    <div class="form-group">
                                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '6']) !!}
                                        {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (Auth::check())
                                @if (count($tweets) > 0)
                                    @include('tweets.tweets', ['tweets' => $tweets])
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
