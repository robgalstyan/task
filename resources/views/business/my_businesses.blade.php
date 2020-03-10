
@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <h3 style="text-align: center">The average rating of all businesses: <strong>{{ $rate}}</strong></h3>
        @foreach($businesses as $business)
            <div class="row">
                <div class="col-sm-offset-1 businesses">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        Add Review
                    </button>
                    </a>

                    <h3>Name: <strong>{{ $business->name }}</strong></h3>
                    <p>Adress: <strong>{{ $business->address }}</strong></p>
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




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New review</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="new_review" action="{{ url('review/test') }}">
                    {{ csrf_field() }}
                    <div class="rate">
                        <label for="b_{{ $business->id }}_1">1</label><input id="b_{{ $business->id }}_1" type="radio" value="1" name="rate">
                        <label for="b_{{ $business->id }}_2">2</label><input id="b_{{ $business->id }}_2" type="radio" value="2" name="rate">
                        <label for="b_{{ $business->id }}_3">3</label><input id="b_{{ $business->id }}_3" type="radio" value="3" name="rate">
                        <label for="b_{{ $business->id }}_4">4</label><input id="b_{{ $business->id }}_4" type="radio" value="4" name="rate">
                        <label for="b_{{ $business->id }}_5">5</label><input id="b_{{ $business->id }}_5" type="radio" value="5" name="rate">
                    </div>
                    <textarea placeholder="Your review" rows="6" cols="70" name="review" class="comment"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button form="new_review" type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>




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