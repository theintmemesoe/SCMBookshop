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
                    <td>Delete</td>
                </tr>
               
                </thead>
       
               
                </tbody>
             
                </table>
                   
                
                
            </div>
        </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" value="Confirm">
                                Confirm
                            </button>
                            <button type="submit" class="btn btn-primary" value="Back">
                                Back
                            </button>
                    </div>
                </div>
    </div>
</div>
@endsection
