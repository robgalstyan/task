
@extends('layouts.app')


    <?php

        $total_rates = 0;

        foreach ($businesses as $business)
        {
        if($business->reviews->count() == 0)
        {
        $total_rates += ceil($business->every_rate/(1+$business->reviews->count()));
        }
        else
        {
        $total_rates += ceil($business->every_rate/($business->reviews->count()));
        }
        $business_total_rate = $total_rates/$business->count();
        }

    ?>

@section('content')
    @isset($business)
    <div class="container">
        <div class="row" style="margin-bottom: 40px;">
            <div class="col-sm-12">
                <h1><strong>Dashboard for my Task</strong></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 dashboards">
                <h3> You have <strong>{{ $business->count() }}</strong> active businesses</h3>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-5 dashboards">
                <h3> Total Rate of all businesses is <strong>{{ ceil($business_total_rate) }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 dashboards">
                @foreach($businesses as $business)
                    @isset($business)
                        @if($business->reviews->count() == 0)
                             <h4>Name <strong>{{$business->name}}</strong> - Rate <strong>{{ceil($business->every_rate/(1+$business->reviews->count())) }}</strong></h4>
                        @else
                            <h4>Name <strong>{{$business->name}}</strong> - Rate  <strong>{{ ceil($business->every_rate/($business->reviews->count())) }}</strong></h4>
                        @endif
                    @endisset
                @endforeach
            </div>
        </div>
    </div>
    @endisset
@endsection


<style>

    .dashboards
    {
        background-color: #FFFFFF;
        margin-bottom: 37px;
        padding: 28px;
        border: 20px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px 5px #888888;
    }

</style>





