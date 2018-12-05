@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{isset($category) ? 'Update' : 'Add'}} Category</h1>

        <form method="post" action="{{isset($category) ? route('updateCategory' ,['id' => $category->id]) : route('createCategory')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" value="{{isset($category) ? $category->name: ''}}" required>
            </div>
            <input type='hidden' value={{ Auth::user()->id }} name='user_id'>
            <div class="form-group">
                <button type="submit" class="btn btn-info">{{isset($category) ? 'Update' : 'Add'}}</button>
            </div>
        </form>

        <div style="{{isset($category) ? '' : 'display: none;'}}" >
            <button  class="btn btn-danger" onclick="window.location.href='{{isset($category) ? route('deleteCategory', ['id' => $category->id]) : ''}}'">Delete this category</button>
        </div>

    </div>
@endsection