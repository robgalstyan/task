{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-8 col-md-offset-2">--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading">Dashboard</div>--}}

{{--                <div class="panel-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                        @if (session('success'))--}}
{{--                            <div class="alert alert-success">--}}
{{--                                {{ session('success') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                    You are logged in!--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="row links-row">--}}
{{--        <div class="col-md-4">--}}
{{--            <a class="see" href="{{ url('/business/create') }}">Create New Business</a>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--            <a class="see" href="{{ url('/business/all') }}">All Businesses</a>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--            <a class="see" href="{{ url('/business/reviews') }}">My Reviews</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 back-img"></div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}






<style>

    ,links-row>div>a
    {

    }

    .see
    {
        display: inline-block;
        width: 300px;
        text-align: center;
        /*height: 50px;*/
        /*line-height: 50px;*/
        /*text-align: center;*/
        /*border-radius: 3px;*/
        /*background-color: #777777;*/
        color: #101010;
        font-size: 19px;
        font-weight: bold;
    }


    .back-img
    {
        background-image: url("/images/business.jpg");
    }






</style>



