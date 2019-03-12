@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="col-md-4">
            <div class="form-group">
                <div class="col-md-6">
                 <input id="name" type="text" class="form-control" name="name" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                <button type="submit" value="Search" class="btn btn-primary"> 
            </button>
                </div>
            </div>
            
            </div>

            <div class="card">
                <div class="card-header text-center">{{ __('SCM Book Shop') }}</div>

                <div class="card-body">
                   
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
