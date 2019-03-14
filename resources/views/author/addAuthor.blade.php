@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Add Author') }}</div>
                <div class="card-body">
                <form class="form-horizontal" method="POST" action="/newAuthor" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="form-group row">
            <label for="name" class="col-md-4 control-label">Name</label>
            <div class="col-md-8">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group row">
            <label for="history" class="col-md-4 control-label">History</label>
                <div class="col-md-8">
                <textarea class="form-control{{ $errors->has('history') ? ' is-invalid' : '' }}" id="history" value="{{ old('history') }}" name="history" rows="3" autofocus>{{ old('history') }}</textarea>
                @if ($errors->has('history'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('history') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group row">
            <label for="description" class="col-md-4 control-label">Description</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="description" name="description" rows="3" autofocus>{{ old('description') }}</textarea>
                </div>
        </div>
    
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="deleteAuthor" type="submit" class="btn btn-primary" value="add">
                    Add
                </button>
            </div>
        </div>
    
    </form>
               
                </div>
            </div>

        </div>
   
    </div>
 
</div>


<script>
    $("#deleteAuthor").on("submit", function(){
        return confirm("Do you want to delete?");
    });
</script>

@endsection





