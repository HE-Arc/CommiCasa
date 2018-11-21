@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Category List</h1>

        <button class="btn btn-info" onclick="window.location.href='{{route('addCategory')}}'">Add category</button>
        <hr>
        <table class="table table-hover">
            <tr>
                <td>#</td>
                <td>Name</td>
            </tr>
            @foreach($categories as $category)
                <tr >
                    <td>{{$category->name}}</td>
                    <td><a href="{{route('showCategory', ['id' => $category->id])}}">Detail</a></td>
                    <td><a href="{{route('updateCategory', ['id' => $category->id])}}">Modify</a></td>
                    <td><a href="{{route('deleteCategory', ['id' => $category->id])}}">Remove-</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection