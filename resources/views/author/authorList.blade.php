@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-4 col-md-offset-4">
         <form action="/searchAuthor" method="post">
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
                      <a class="btn btn-primary btn-block" href="/addAuthor"> Add</a>
                      </div>
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
                        <td><a href="/author/editAuthor/{{ $row->id }}">Edit</a></td>
                        <td><a href="/author/deleteAuthor/{{ $row->id }}">delete</a></td>
                    </tr>
                    
                    @endforeach
                </tbody>
             
                </table>
                
                </div>
            </div>
            {{$aut->links()}}
        </div>
   
    </div>
</div>

@endsection
