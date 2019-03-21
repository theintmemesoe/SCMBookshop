@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Order Confirm') }}</div>
                <div class="card-body">
                <table class="table">
                <thead>
                <tr>
                    <td>Book Name</td>
                    <td>Book Price</td>
                    <td>Book Quantity</td>
                </tr>
            @php($total = 0)
            @if(count($book) > 0)
            @foreach($book as $b)
               {{ count($b)}}
                @if(count($b) > 0)
                <tr>
                    <td>{{isset($b->name) ? $b->name: '' }}</td>
                    <td>{{isset($b->price) ? $b->price: ''}}</td>
                    <td>{{isset($b->quantity) ? $b->quantity: '' }}</td>
                   
                    @php($total += ($b->price * $b->quantity))
                </tr>
                @endif
            @endforeach
                <tr>
                    <td>Total Amount:</td>
                    <td>{{ $total }}</td>
                </tr>
            @endif
                </thead>
 
               
                </tbody>
             
                </table>
                   
                
                
            </div>
        </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <a href="/order/orderConfirm" class="btn btn-primary">Confirm</a>   
                        <a href="/order/backOrder" class="btn btn-primary">Back</a>                            
                    </div>
                </div>
    </div>
</div>
@endsection
