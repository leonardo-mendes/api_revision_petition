@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default control">
                <div class="panel-heading" >Petition Guide</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <questions :user_id={{ Auth::user()->id }}></questions>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
