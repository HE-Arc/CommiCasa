@extends('layouts.app')
@section('content')
<div class="container">
    <h1> Your shopping list</h1>
    @if(count($products) > 0)
    <table class="table table-hover">
        <tr>
            <th>
                @lang('Image')</th>
            <th>
                @lang('Name')</th>
            <th>
                @lang('Quantity')</th>
            <th>
                @lang('Action')</th>
        </tr>
        @foreach($products as $product)
            <tr
                @if($product->quantity > ($product->alert + $product->quantity_wanted))
                class="bg-success"
                @endif
                onclick="location.href='{{route('editProduct', ['id' => $product->id])}}'">
            <td class="align-middle">
                @if($product->image!= "default.png")
                    <img src="products/images/{{Auth::user()->id}}/{{$product->image}}" alt="" height="75" width="75">
                    @else
                    <img src="images/default.png" alt="" height="75" width="75">
                    @endif
            </td>
            <td class="align-middle" >{{ $product->name}}</td>
            <td class="align-middle" >{{ $product->quantity}} / {{ $product->alert + $product->quantity_wanted }}</td>
            <td class="buttons align-middle text-justify">
                <div class="row float-left">
                    <form action="{{ route('updateProduct') }}" method="POST">
                        @csrf
                        <input type='hidden' value='{{$product->id}}' name='product_id'>
                        <button name="quantity" value="1" class="btn btn-sm btn-primary" style="width:35px; height:35px"><i class="fas fa-plus"></i></button>
                        <button name="quantity" value="-1" class="btn btn-sm btn-primary" style="width:35px; height:35px"><i class="fas fa-minus"></i></button>
                    </form>
                </div>
                <div class="row float-right">

                        <form action="{{ route('deleteShopping') }}" method="POST">
                            @csrf
                            <input type='hidden' value='{{$product->id}}' name='product_id'>
                            <button class="btn btn-sm btn-sm btn-danger" style="width:35px; height:35px"
                            @if($product->regular == 1 || $product->quantity < ($product->alert))
                                disabled
                            @endif
                            ><i class="fas fa-trash"></i></button>
                        </form>

                </div>
        </tr>
        @endforeach
    </table>
    @else
    <h5>
        @lang("No shopping list available !")</h5>
    @endif
</div>
@endsection