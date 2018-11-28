@extends('layouts.app')

@section('content')
    <div class="container">
       <h1> Product List</h1>

        <button class="btn btn-info" onclick="location.href='{{route('addProduct')}}'">Add Product</button>

        <table class="table table-hover">
            <tr>
                <th>@lang('Image')</th>
                <th>@lang('Name')</th>
                <th>@lang('Quantity')</th>
                <th>@lang('Action')</th>
            </tr>
        @foreach($products as $product)

            <tr onclick="location.href='{{route('editProduct', ['id' => $product->id])}}'">
                <td class="clickable align-middle" href="#" data-id="{{ $product->id }}">{{ $product->image}}</td>
                <td class="clickable align-middle" href="#" data-id="{{ $product->id }}">{{ $product->name}}</td>
                <td class="clickable align-middle" href="#" data-id="{{ $product->id }}">{{ $product->quantity}}</td>
                <td class="buttons align-middle text-justify">

                <form action="{{ route('updateProduct') }}" method="POST">
                    @csrf
                    <input type='hidden' value='{{$product->id}}' name='product_id'>
                    <button name="quantity" value="1" class="btn btn-sm btn-sm btn-primary">+1</button>
                    <button name="quantity" value="-1" class="btn btn-sm btn-sm btn-primary">-1</button>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
@endsection