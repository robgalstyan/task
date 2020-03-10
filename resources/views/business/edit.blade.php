@extends('layouts.app')

@section('content')
    <div class="col-sm-offset-2 col-sm-6">
        <form method="post" action="{{ url('business/update/'.$business->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Business Name:</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ $business->name }}">
                @if($errors->has('name'))
                    <div class="has-error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input name="address" type="text" class="form-control" id="address" value="{{ $business->address }}">
                @if($errors->has('address'))
                    <div class="has-error">{{ $errors->first('address') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ url('home') }}">
                <button type="button" class="btn btn-default">Cancel</button>
            </a>
        </form>
    </div>
    @endsection