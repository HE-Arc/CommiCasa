@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Show Category</h1>
        <p>{{$category->name}}</p>
    </div>
@endsection