@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Category List</h1>

        <button class="btn btn-info" onclick="window.location.href='{{route('addCategory')}}'">Add category</button>
        @if(count($categories) > 0)
        <table class="table table-hover">
            <tr>
                <td><strong>@lang('#')</strong></td>
                <td><strong>@lang('Name')</strong></td>
            </tr>
            @foreach($categories as $category)
                <tr onclick="location.href='{{route('updateCategory', ['id' => $category->id])}}'">
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                </tr>
            @endforeach
        </table>
        @else
            <h5>@lang("No categories !")</h5>
        @endif
    </div>
@endsection