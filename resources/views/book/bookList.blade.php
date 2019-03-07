@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-4 col-md-offset-4">
         <form action="#" method="post">
              <div class="col-md-12">
                  <div class="form-group">
                      <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" autofocus>
                      </div>
                  </div>   
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-block">Search</button>
                      </div>
                  </div>   
              </div> 
              {{csrf_field()}}
         </form>   
              <div class="col-md-12">
                  <div class="form-group">
                      <div class="col-md-6">
                      <button type="submit" data-toggle="modal" data-target="#addBook" class="btn btn-info btn-block">Add</button>
                      </div>
                  </div>   
              </div>
              
            <div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form method="post" action="/newBook">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Book Name</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="price" class="col-md-4 col-form-label text-md-right">Book Price</label>
                              <div class="col-md-6">
                                  <input id="price" type="text" class="form-control" name="price">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="author_id" class="col-md-4 col-form-label text-md-right">Book Author</label>
                              <div class="col-md-6">
                              <input id="author_id" type="text" class="form-control" name="author_id">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="genre_id" class="col-md-4 col-form-label text-md-right">Book Genre</label>
                              <div class="col-md-6">
                                  <input id="genre_id" type="text" class="form-control" name="genre_id">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Book Image</label>
                              <div class="col-md-6">
                                  <input id="image" type="file" class="form-control" name="image">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="sample_pdf" class="col-md-4 col-form-label text-md-right">Book Sample</label>
                              <div class="col-md-6">
                                  <input id="sample_pdf" type="file" class="form-control" name="sample_pdf">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="published_date" class="col-md-4 col-form-label text-md-right">Book Published Date</label>
                              <div class="col-md-6">
                                  <input id="published_date" type="date" class="form-control" name="published_date">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="description" class="col-md-4 col-form-label text-md-right">Book Description</label>
                              <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description"></textarea>
                              </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>

                    
    </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Book List') }}</div>
                <div class="card-body">
                <table class="table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Book Name</td>
                    <td>Book Price</td>
                    <td>Book Author</td>
                    <td>Book Genre</td>
                    <td>Book Image</td>
                    <td>Book Sample PDF</td>
                    <td>Book Publish Date</td>
                    <td>Book Description</td>
                </tr>
                </thead>
                @foreach($book as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->author_id}}</td>
                        <td>{{$row->genre_id}}</td>
                        <td>{{$row->image}}</td>
                        <td>{{$row->sample_pdf}}</td>
                        <td>{{$row->published_date}}</td>
                        <td>{{$row->description}}</td>
                        <td><a href="/book/editBook/{{ $row->id }}">Edit</a></td>
                        <td><a href="#">delete</a></td>
                    </tr>
                    
                    @endforeach
                
                </tbody>
             
                </table>
                
                </div>
            </div>
         
        </div>
   
    </div>
 
</div>


@endsection
