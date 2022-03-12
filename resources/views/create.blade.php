@extends('layouts.app')

@section('title')
    Create Todo
@endsection

@section('content')
@if(session()->has('error'))
    <div class="alert alert-success">

        {{ session()->get('error') }}

    </div>
@endif
    <form action="store-data" method="post" class="mt-4 p-4">
        @csrf
        <div class="form-group m-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
         <div class="form-group m-3">
            <label for="description">Date</label>
            <input type="date" class="form-control" name="date">
        </div>
        <div class="form-group m-3">
            <label for="description">Time</label>
            <input type="time" class="form-control" name="time">
        </div>
        <div class="form-group m-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        
        <div class="form-group m-3">
            <input type="submit" class="btn btn-primary float-end" value="Submit">
        </div>
        
    </form>

@endsection