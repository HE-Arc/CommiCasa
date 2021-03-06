@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{isset($product) ? 'Edit the' : 'Add a new'}} product</h1>

        <form method="post" action="{{isset($product) ? route('editProduct' ,['id' => $product->id]) : route('validateProduct')}}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" required
                       value="{{isset($product) ? $product->name: ''}}">
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" selected="" required>
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
                <input type="number" name="alert" id="alert" class="form-control" min="1"
                       value="{{isset($product) ? $product->alert: '1'}}">
            </div>

            @if(isset($product))
                <img src="{{URL::to("products/images/". Auth::user()->id . "/" . $product->image)}}" alt="" height="200" width="200">
            @elseif (isset($product) && $product->image == "default.png")
                <img src="{{ URL::to('products/images/default.png')}}" alt="" height="200" width="200">
            @else
            @endif
            <div class="form-group">
                <label for="image">Image</label> <br>
                <input type="file" class="form-control-file" name="image" id="image" accept=".png, .jpg, .jpeg"
                       value="{{isset($product) ? $product->image : 'default.png'}}">
            </div>
            <br>
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
                <button type="submit" class="btn btn-lg btn-primary"> {{isset($product) ? 'Edit' : 'Add'}}</button>
            </div>
        </form>
    </div>


@endsection