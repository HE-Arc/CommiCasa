@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{isset($product) ? 'Edit' : 'Add'}} Product</h1>

        <form method="post" action="{{isset($product) ? route('editProduct' ,['id' => $product->id]) : route('validateProduct')}}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" required
                       value="{{isset($product) ? $product->name: ''}}">
            </div>

            <div class="form-group">
                <label for="category_id">Categories</label>
                <select class="form-control" id="category_id" name="category_id" selected="">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if(isset($product))
                                @if($product->category_id == $category->id )
                                selected
                                @endif
                            @endif
                        >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="0"
                       value="{{isset($product) ? $product->quantity: '0'}}">
            </div>

            <div class="form-group">
                <label for="alert">Minimum alert</label>
                <input type="number" name="alert" id="alert" class="form-control" min="0"
                       value="{{isset($product) ? $product->alert: '0'}}">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image" accept=".png, .jpg, .jpeg"
                       value="{{isset($product) ? : ''}}">

            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                          placeholder="Describe your product...">{{isset($product) ? $product->description : ''}}</textarea>
            </div>

            <div class="form-group">
                <label for="regular">Automatically add in the shopping list when is empty</label>
                <input type='hidden' value='off' name='regular'>
                <input type="checkbox" name="regular" id="regular"
                @if(isset($product) && $product->regular == 1)
                    checked
                @endif
                >
            </div>

            <input type='hidden' value={{ Auth::user()->id }} name='user_id'>

            <div class="form-group">
                <button type="submit" class="btn btn-info"> {{isset($product) ? 'Edit Product' : 'Add Product'}}</button>
            </div>
        </form>

        <div style="{{isset($product) ? '' : 'display: none;'}}" >
            <button  class="btn btn-danger" onclick="location.href='{{isset($product) ? route('deleteProduct', ['id' => $product->id]) : ''}}'">Delete this product</button>
        </div>
    </div>


@endsection