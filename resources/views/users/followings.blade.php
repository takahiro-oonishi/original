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
                    @include('users.profile')
                    <div class="card">
                        @include('users.nab_tabs')
                        <div class="card-body">
                            @include('users.users')
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection