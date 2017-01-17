@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
@endsection