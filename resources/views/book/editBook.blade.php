@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 my-4">
        <h3 class="mb-5">Updat Book</h3>
            <form class="form-horizontal" method="POST" action="/updateBook" enctype="multipart/form-data">
                {{ csrf_field() }}

            <input type="hidden" id="id" name="id" value="{{$bookEdit_id->id}}">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="name" name="name" value="{{$bookEdit_id->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                    <div class="col-md-8">    
                         <input type="text" class="form-control" id="price" name="price" value="{{$bookEdit_id->price}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author_id" class="col-md-4 col-form-label text-md-right">Book Author</label>
                    <div class="col-md-6">
                    <input id="author_id" type="text" class="form-control" name="author_id" value="{{$bookEdit_id->author_id}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="genre_id" class="col-md-4 col-form-label text-md-right">Book Genre</label>
                    <div class="col-md-6">
                    <input id="genre_id" type="text" class="form-control" name="genre_id" value="{{$bookEdit_id->genre_id}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Book Image</label>
                    <div class="col-md-6">
                    <input id="image" type="file" class="form-control" name="image" value="{{$bookEdit_id->image}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sample_pdf" class="col-md-4 col-form-label text-md-right">Book Sample</label>
                    <div class="col-md-6">
                    <input id="sample_pdf" type="file" class="form-control" name="sample_pdf" value="{{$bookEdit_id->sample_pdf}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="published_date" class="col-md-4 col-form-label text-md-right">Book Published Date</label>
                    <div class="col-md-6">
                    <input id="published_date" type="text" class="form-control" name="published_date" value="{{$bookEdit_id->published_date}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Book Description</label>
                    <div class="col-md-6">
                    <textarea class="form-control" id="description" name="description" value="{{$bookEdit_id->description}}">{{$bookEdit_id->description}}</textarea>
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
