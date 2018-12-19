@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your list of category</h1>

    <button class="btn btn-lg btn-primary" onclick="window.location.href='{{route('addCategory')}}'">Add a new category</button>
    @if(count($categories) > 0)
    <table class="table table-hover">
        <tr>
            <th>
                <strong>
                    @lang('Name')
                </strong>
            </th>
            <th>
                <strong>
                    @lang('Delete')
                </strong>
            </th>
        </tr>
        @foreach($categories as $category)
        <tr onclick="location.href='{{route('updateCategory', ['id' => $category->id])}}'">
            <td>{{$category->name}}</td>
            <td>
                <form action="{{route('deleteCategory', ['id' => $category->id])}}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-sm btn-danger" style="width:35px; height:35px"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <h5>
        @lang("No categories !")</h5>
    @endif
</div>
@endsection