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
                </h5>
            </div>
            <div id="collapse{{$listRecipe->id}}" class="collapse" aria-labelledby="heading{{$listRecipe->id}}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div>
                            {{$listRecipe->image}}
                        </div>
                        <div>
                            <table>
                                <tr>
                                    {{$listRecipe->description}}
                                </tr>
                                <tr>
                                    <table>
                                        @foreach ($recipes as $recipe)
                                        @if ($recipe->name_recipe_id==$listRecipe->id)
                                        <tr>
                                            <td>{{$recipe->product_id}}</td>
                                            <td>{{$recipe->quantity}}</td>
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