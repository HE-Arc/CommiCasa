@extends('layouts.app')

@section('content')
<div class="container">
    <h1> Product List</h1>

        <button class="btn btn-info" onclick="location.href='{{route('addProduct')}}'">Add Product</button>
        @if(count($products) > 0)
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


                <form action="{{ route('addShopping') }}" method="POST">
                    @csrf
                    <input type='hidden' value='{{$product->id}}' name='product_id'>
                    <input type='hidden' value={{ Auth::user()->id }} name='user_id'>
                    <button name="addToShopping" value="1" class="btn btn-sm btn-sm btn-primary">Shopping</button>
                </form>
            </tr>
            @endforeach
        </table>
        @else
            <h5>@lang("No products in your house !")</h5>
        @endif
    </div>
@endsection