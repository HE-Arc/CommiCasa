@extends('layouts.app')

@section('content')
<div class="container">
    <h1> Recipe List</h1>
    <a href="{{route('addRecipe')}}">Add new Recipe!</a>
</div>
@endsection