@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4">
    <h1 class="text-primary">Cart List</h1>
    </div>
   
   
        <div class="col-md-8">
       
         <form method="post" action="/cart/confirmBook">
        <table class="table">
            <tr>
                <th>Image</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>SamplePDF</th>
                <th>Quantity</th>
                <th>Remove</th>
                <th><a href="/cart/clearCart">Clear Cart</a></th>
            </tr>
            @if(count($book) > 0)
            @foreach($book as $b)
               {{ count($b)}}
                @if(count($b) > 0)
                
                <tr>
               
                    <td>{{isset($b->image) ? $b->image : ''}}</td>
                    <td>{{isset($b->name) ? $b->name: '' }}</td>
                    <td>{{isset($b->price) ? $b->price: ''}}</td>
                    <td>{{isset($b->sample_pdf) ? $b->sample_pdf: '' }}</td>
                    <td>
                    <input type="text" name="quantity[{{$b->id}}]" id="quantity">
                    </td>
                    <td><a href="/cart/removeCart/{{ isset($b->id) ? $b->id: ''}}" class="btn btn-primary">Remove</a></td>
                </tr>
                @endif
            @endforeach
        @endif
        </table>

       
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                            {{csrf_field()}}
                        </form>
        </div>
        
    </div>
    </div>
</div>

@endsection

