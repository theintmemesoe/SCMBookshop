@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-4 col-md-offset-4">
         <form action="/searchGenre" method="post">
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
                      <a class="btn btn-primary btn-block" href="/addGenre"> Add</a>
                      </div>
                  </div>   
              </div>
                    
    </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Genre List') }}</div>
                <div class="card-body">
                <table class="table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Genre Name</td>
                    <td>Genre History</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                @foreach($gen as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->description}}</td>
                        <td><a href="/genre/editGenre/{{ $row->id }}">Edit</a></td>
                        <td><a href="/genre/deleteGenre/{{ $row->id }}">delete</a></td>
                    </tr>  
                    @endforeach
                
                </tbody>
               
                </table>
               
                </div>
            </div>
   {{$gen->links()}}

        </div>
   
    </div>
 
</div>

@endsection
