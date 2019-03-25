@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Book Detail') }}</div>
                <div class="card-body">
                <table class="table" id="myTable">
                <thead>

                <tr>
                    <td>Book Name</td>
                    <td>{{$book->name}}</td>
                </tr>
                <tr>
                    <td>Book Price</td>
                    <td>{{$book->price}}</td>
                </tr>
                <tr>
                    <td>Book Author</td>
                    <td>{{$book->author->name}}</td>
                </tr>
                <tr>
                    <td>Book Genre</td>
                    <td>{{$book->genre->name}}</td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><img src="{{$book->image}}" alt="{{ $book->name }}"></td>

                </tr>
                <tr>
                    <td>Sample PDF</td>
                    <td>{{$book->sample_pdf}}</td>
                </tr>
                <tr>
                    <td>Published Date</td>
                    <td>{{$book->published_date}}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{!! $book->description !!}</td>
                </tr>

                </thead>
                </tbody>
                </table>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
