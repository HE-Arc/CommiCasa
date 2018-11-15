@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Add Product</h1>

        <form method="post" action="{{route('validateProduct')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Categories</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" value="1" name="quantity" id="quantity" class="form-control" min="1">
            </div>

            <div class="form-group">
                <label for="alert">Minimum alert</label>
                <input type="number" value="0" name="alert" id="alert" class="form-control" min="0">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image" accept=".png, .jpg, .jpeg">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe your product..."></textarea>
            </div>

            <div class="form-group">
                <label for="regular">Automatically add in the shopping list when is empty</label>
                <input type='hidden' value='off' name='regular'>
                <input type="checkbox" name="regular" id="regular">
            </div>

            <input type='hidden' value={{ Auth::user()->id }} name='user_id'>

            <div class="form-group">
                <button type="submit" class="btn btn-info"> Add Product</button>
            </div>
        </form>
    </div>
@endsection