@extends('layouts.app')

@section('content')
<div class="container">
    <h1> Recipe List</h1>
    <button class="btn btn-info" onclick="location.href='{{route('addRecipe')}}'">Add Recipe</button>
    <div id="accordion">
        @foreach ($listRecipes as $listRecipe)
        <div class="card">
            <div class="card-header" id="heading{{$listRecipe->id}}">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$listRecipe->id}}" aria-expanded="false" aria-controls="collapse{{$listRecipe->id}}">
                        {{$listRecipe->name}}
                    </button>
                    <button class="btn " onclick="location.href='{{route('editRecipe', ['id' => $listRecipe->id])}}'">Edit</button>
                    <button class="btn btn-danger" onclick="location.href='{{route('deleteRecipeList', ['id' => $listRecipe->id])}}'">Delete</button>
                </h5>
            </div>
            <div id="collapse{{$listRecipe->id}}" class="collapse" aria-labelledby="heading{{$listRecipe->id}}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div>
                            @if($listRecipe->image != "default.png")
                                <img src="{{URL::to("recipes/images/". Auth::user()->id . "/" . $listRecipe->image)}}" alt="" height="75" width="75">
                                @else
                                <img src="{{ URL::to('recipes/images/default.png')}}" alt="" height="75" width="75">
                                @endif
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <p>{{$listRecipe->description}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <table>
                                        @foreach ($products as $product)
                                        @if ($product->name_recipe_id==$listRecipe->id)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->quantity_required}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection