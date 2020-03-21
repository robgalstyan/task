
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 href="#"><a href="{{ url('business/dashboard') }}" style="font-weight: bold">Dashboard</a></h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            @foreach($businesses as $business)
                <div class="row">
                    <div class="col-sm-offset-1 businesses">
{{--                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
{{--                                    Add Review--}}
{{--                                </button>--}}

                        <h3>Name: <strong>{{ $business->name }}</strong></h3>
                        <p>Adress: <strong>{{ $business->address }}</strong></p>
                        @if($business->reviews->count() == 0)
                            <p>Total rate <strong> {{ ceil($business->total_rate/(1+$business->reviews->count())) }}</strong></p>
                        @else
                            <p>Total rate <strong>{{ ceil($business->total_rate/$business->reviews->count()) }}</strong></p>
                        @endif
                        <a href="{{ url('business/edit/'.$business->id) }}">
                            <button class="btn btn-info">Edit</button>
                        </a>
                        <a href="{{ url('business/delete/'.$business->id) }}">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                        <a href="{{ url('business/reviews/'.$business->id.'?type=good') }}">
                            <button class="btn btn-success">Good Reviews</button>
                        </a>
                        <a href="{{ url('business/reviews/'.$business->id.'?type=bad') }}">
                            <button class="btn btn-warning">Bad Reviews</button>
                        </a>
                    </div>
                 </div>
            @endforeach
    </div>

@endsection




<style>

    .businesses
    {
        background-color: #FFFFFF;
        margin-bottom: 37px;
        padding: 28px;
        border: 20px;
        border-radius: 17px;
        box-shadow: 5px 5px 5px 5px #888888;
    }

    .comment
    {
        text-indent: 13px;
    }

</style>