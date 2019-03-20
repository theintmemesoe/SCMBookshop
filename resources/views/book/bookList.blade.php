@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-4">

         <form action="/searchBook" method="post" enctype="multipart/form-data">
         
                    <div class="form-group row">
                        <div class="col-md-6">
                        <select name="aname" id="aname" class="form-control">
                        <option value="">Author Name</option>
                        @foreach($author as $ans)
                            <option value="{{$ans->id}}">{{$ans->name}}</option>
                            @endforeach          
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        <select name="gname" id="gname" class="form-control">
                        <option value="">Genre Name</option>
                        @foreach($genre as $ans)
                            <option value="{{$ans->id}}">{{$ans->name}}</option>
                            @endforeach            
                        </select>
                        </div>
                    </div>

                  <div class="form-group">
                      <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" placeholder="Book Name" autofocus>
                      </div>
                  </div>  
                  <div class="form-group">
                      <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-block">Search</button>
                      </div>
                  </div>   
              {{csrf_field()}}
         </form>   
             
        <div class="form-group">
            <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="/addBook"> Add</a>            
            </div>
        </div> 

            @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            
        <form action="/uploadCSV" method="post" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        <div class="form-group">
        <div class="col-md-6">
            <input id="file" type="file" class="form-control" name="file">
            <button type="submit" class="btn btn-info btn-block">Upload</button>
        </div>
        </div>
        </form>

        <form action="/downloadCSV" method="get" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-info btn-block">Download</button>
            </div>
        </div>
        </form> 
       

    </div>
 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Book List') }}</div>
                <div class="card-body">
                <table class="table" id="myTable">
                <thead>
                <tr>
                    <td>Book Name</td>
                    <td>Author Name</td>
                    <td>Genre Name</td>
                    <td>Price</td>
                    <td>Sample PDF</td>
                    <td>Cart</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                @foreach($book as $row)
                    <tr>
                        <td><a href="/book/bookDetail/{{$row->id}}">{{$row->name}}</a></td>
                        <td>{{$row->author->name}}</td>
                        <td>{{$row->genre->name}}</td>
                        <td>{{$row->price}}</td>
                        <td><a href="#">{{$row->sample_pdf}}</a></td>
                        <td><a href="/cart/addToCart/{{ $row->id }}">Add to cart</a></td>
                        <td><a href="/book/editBook/{{ $row->id }}">Edit</a></td>
                        <td><a href="/book/deleteBook/{{$row->id}}" id="btnDeleteProduct">delete</a></td>   
                    </tr>
                    @endforeach
                 
                </tbody>
             
                </table>
                
                </div>
            </div>
          {{$book->links()}}
        </div>
    </div>
 
</div>
<script>
$(document).ready(function () 
{
    $('body').on('click', '#btnDeleteProduct', function () {

    var id = $(this).data("id");
    var result=confirm("Are you sure want to delete?");
    if(result){
    $.ajax({
    type:'get',
    url:'/book/deleteBook/{id}',
    data:{id:id},
    success: function (data) {
    $("#id" + id).remove();
    },
    error: function (data) {
    console.log('Error:', data);
    }
    });
    }
    });
});

</script>
@endsection
