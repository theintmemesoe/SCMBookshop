@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Add Book') }}</div>
                <div class="card-body">
                <form class="form-horizontal" method="POST" action="/newBook" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Book Name</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
                                  @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="price" class="col-md-4 col-form-label text-md-right">Book Price</label>
                              <div class="col-md-6">
                                  <input id="price" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="price">
                                  @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="author_id" class="col-md-4 col-form-label text-md-right">Book Author</label>
                              <div class="col-md-6">
                              <select name="author_id" id="author_id" class="form-control{{ $errors->has('author_id') ? ' is-invalid' : '' }}">
                            <option value=""></option>
                            @foreach($author as $ans)
                                <option>{{$ans->id}}</option>
                                @endforeach
                             </select>
                             @if ($errors->has('author_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author_id') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="genre_id" class="col-md-4 col-form-label text-md-right">Book Genre</label>
                              <div class="col-md-6">
                              <select name="genre_id" id="genre_id" class="form-control{{ $errors->has('genre_id') ? ' is-invalid' : '' }}">
                            <option value=""></option>
                            @foreach($genre as $ans)
                                <option>{{$ans->id}}</option>
                                @endforeach
                             </select>
                             @if ($errors->has('genre_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('genre_id') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Book Image</label>
                              <div class="col-md-6">
                                  <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                  @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="sample_pdf" class="col-md-4 col-form-label text-md-right">Book Sample</label>
                              <div class="col-md-6">
                                  <input id="sample_pdf" type="file" class="form-control{{ $errors->has('sample_pdf') ? ' is-invalid' : '' }}" name="sample_pdf">
                                  @if ($errors->has('sample_pdf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sample_pdf') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="published_date" class="col-md-4 col-form-label text-md-right">Book Published Date</label>
                              <div class="col-md-6">
                                  <input id="published_date" type="date" class="form-control{{ $errors->has('published_date') ? ' is-invalid' : '' }}" name="published_date">
                                  @if ($errors->has('published_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('published_date') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="description" class="col-md-4 col-form-label text-md-right">Book Description</label>
                              <div class="col-md-6">
                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" value="add">
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


@endsection
