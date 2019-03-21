<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Order Confirm') }}</div>
                <div class="card-body">
                <table class="table">
                <thead>
                <tr>
                <h2>Hello, I would like to order the following books</h2>
                </tr>
                <tr>
                    <td>Book Name</td>
                    <td>Book Quantity</td>
                </tr>
                @if(count($book) > 0)
                @foreach($book as $b)
                    @if(count($b) > 0)
                    <tr>
                        <td>{{isset($b->name) ? $b->name: '' }}</td>
                        <td>{{isset($b->quantity) ? $b->quantity: '' }}</td>     
                    </tr>
                    @endif
                @endforeach
                @endif
                <tr><h3>Here is my info</h3></tr>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                </tr>
              
                    <tr>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ Auth::user()->email }}</td>  
                        <td>{{ Auth::user()->phone }}</td>
                        <td><h6>SCM Book Shop</h6></td>      
                    </tr>
                
                <tr><h4>Best regards,</h4></tr>
                <tr>{{ Auth::user()->name }}</tr>
                </thead>
                </tbody>
             
                </table>
                   
                
                
            </div>
        </div>
                
    </div>
</div>
