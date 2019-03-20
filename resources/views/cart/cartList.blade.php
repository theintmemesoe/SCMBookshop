@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4">
    <h1 class="text-primary">Cart List</h1>
    </div>
        <div class="col-md-8">
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
            @if(Session::has('cart'))
                @foreach($carts as $cart)
                    <tr>
                        <td>{{$cart['item']['image']}}</td>
                        <td>{{$cart['item']['name']}}</td>
                        <td>{{$cart['item']['price']}}</td>
                        <td>{{$cart['item']['sample_pdf']}}</td>
                        <td><input type="text" name="quantity" id="quantity"></td>
                        <td><a href="/cart/removeCart/{{$cart['item']['id']}}" class="btn btn-primary">Remove</a></td>
                    </tr>
                @endforeach
            @endif
        </table>

                        <form method="post" action="/cart/confirmBook">
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

