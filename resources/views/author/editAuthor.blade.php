@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 my-4">
        <h3 class="mb-5">Updat Author</h3>
            <form class="form-horizontal" method="POST" action="/updateAuthor" enctype="multipart/form-data">
                {{ csrf_field() }}

            <input type="hidden" id="id" name="id" value="{{$autEdit_id->id}}">
                <div class="form-group row">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{$autEdit_id->name}}">
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
                        <textarea class="form-control{{ $errors->has('history') ? ' is-invalid' : '' }}" id="history" value="{{$autEdit_id->history}}"  name="history">{{$autEdit_id->history}}</textarea>
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
                        <textarea class="form-control" id="description" name="description" value="{{$autEdit_id->description}}">{{$autEdit_id->description}}</textarea>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" value="update">
                            Update
                        </button>
                        <button type="reset" class="btn btn-info" value="clear">
                            Clear
                        </button>
                    </div>
                </div>

            </form>
    </div>
</div>
  @endsection
