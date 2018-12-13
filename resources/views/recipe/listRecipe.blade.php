@extends('layouts.app')

@section('content')
<div class="container">
    <h1> Recipe List</h1>
    <button class="btn btn-info" onclick="location.href='{{route('addRecipe')}}'">Add Recipe</button>
    <hr>
    @if(count($listRecipes) > 0)
    <div id="accordion">
        @foreach ($listRecipes as $listRecipe)
        <div class="card">
            <div class="card-header container" id="heading{{$listRecipe->id}}" style="vertical-align: middle;" data-toggle="collapse" data-target="#collapse{{$listRecipe->id}}" aria-expanded="false" aria-controls="collapse{{$listRecipe->id}}">
                <div class="row align-items-center">
                    <div class="col align-text-left" style="text-indent: 50px;font-size: 35px;">
                        {{$listRecipe->name}}
                    </div>
                    <div class="col align-text-right">
                        <div class="row float-right">
                            <form action="{{ route('addRecipeShopping') }}" method="POST">
                                @csrf
                                <input type='hidden' value='{{$listRecipe->id}}' name='idR'>
                                <input type='hidden' value={{ Auth::user()->id }} name='idU'>
                                <button class="btn btn-sm btn-primary" style="width:35px; height:35px"><i class="fas fa-shopping-cart"></i></button>
                            </form>
                            <button class="btn btn-primary" style="width:35px; height:35px" onclick="location.href='{{route('editRecipe', ['id' => $listRecipe->id])}}'"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger" style="width:35px; height:35px" onclick="location.href='{{route('deleteRecipeList', ['id' => $listRecipe->id])}}'"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="collapse{{$listRecipe->id}}" class="collapse" aria-labelledby="heading{{$listRecipe->id}}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div>
                            @if($listRecipe->image != "default.png")
                                <img src="products/images/{{Auth::user()->id}}/{{$listRecipe->image}}" alt="" height="75" width="75">
                                @else
                                <img src="products/images/default.png" alt="" height="75" width="75">
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
    @else
    <h5>
        @lang("No recipes in your house !")</h5>
    @endif
</div>
@endsection