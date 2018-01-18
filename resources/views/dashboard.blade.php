@extends('layouts.app')

@section('content')
<div class="control container">
    <div class="bg-grey">
        <div class="row">
            <div class="col-sm-3">
            <span class="glyphicon glyphicon-globe logo"></span> 
            </div>
            <div class="col-sm-9">
            <h2><strong>Welcome,</strong> {{ Auth::user()->name}}!</h2>
            <h4></h4> 
            <p><strong>VISION:</strong> Our vision Lorem ipsum..</p>
            </div>
        </div>
    </div>
    <br>
    <services :user_id={{ Auth::user()->id }}>  </services>
</div>  
@endsection
