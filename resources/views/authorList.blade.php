@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-4 col-md-offset-4">
         <form action="/search" method="post">
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
                      <button type="submit" data-toggle="modal" data-target="#addAuthor" class="btn btn-info btn-block">Add</button>
                      </div>
                  </div>   
              </div>
              
            <div class="modal fade" id="addAuthor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form method="post" action="/newAuthor">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Author</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Author Name</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="history" class="col-md-4 col-form-label text-md-right">Author History</label>
                              <div class="col-md-6">
                                  <input id="history" type="text" class="form-control" name="history">
                              </div>
                      </div>
                      <div class="form-group row">
                              <label for="description" class="col-md-4 col-form-label text-md-right">Author Description</label>
                              <div class="col-md-6">
                                  <input id="description" type="text" class="form-control" name="description">
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
                <div class="card-header text-center">{{ __('Author List') }}</div>
                <div class="card-body">
                <table class="table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Author Name</td>
                    <td>Author History</td>
                    <td>Author Description</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
       
                @foreach($aut as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->history}}</td>
                        <td>{{$row->description}}</td>
                        <td><a href="/editAuthor/{{ $row->id }}">Edit</a></td>
                        <td><a href="/deleteAuthor/{{ $row->id }}">delete</a></td>
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
