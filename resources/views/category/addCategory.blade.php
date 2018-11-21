@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{isset($category) ? 'Update' : 'Add'}} Category</h1>

        <form method="post" action="{{isset($category) ? route('updateCategory' ,['id' => $category->id]) : route('createCategory')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" value="{{isset($category) ? $category->name: ''}}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">{{isset($category) ? 'Update' : 'Add'}}</button>
            </div>

        </form>
    </div>
@endsection