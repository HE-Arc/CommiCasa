@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your list of recipe</h1>
    <button class="btn btn-lg btn-primary" onclick="location.href='{{route('addRecipe')}}'">Add a new recipe</button>
    <hr>
    @if(count($listRecipes) > 0)
    <div id="accordion">
        @foreach ($listRecipes as $listRecipe)
        <div class="card">
            <div class="card-header container" id="heading{{$listRecipe->id}}" style="vertical-align: middle;" data-toggle="collapse" data-target="#collapse{{$listRecipe->id}}" aria-expanded="false" aria-controls="collapse{{$listRecipe->id}}">
                <div class="row align-items-center">
                    <div class="col align-text-left" style="text-indent: 50px;font-size: 35px;">
                        <h2>{{$listRecipe->name}}</h2>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                @if($listRecipe->image != "default.png")
                                    <img src="{{URL::to("recipes/images/". Auth::user()->id . "/" . $listRecipe->image)}}" alt="" height="200" width="200">
                                    @else
                                    <img src="{{ URL::to('recipes/images/default.png')}}" alt="" height="200" width="200">
                                    @endif
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <tr>
                                                <th>Ingredients</th>
                                                <th>Quantity Required</th>
                                            </tr>
                                            @foreach ($products as $product)
                                            @if ($product->name_recipe_id==$listRecipe->id)
                                            <tr>
                                                <td>
                                                    {{$product->name}}
                                                </td>
                                                <td>
                                                    {{$product->quantity_required}}
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h5><strong>Description</strong></h5>
                                        <p>{{$listRecipe->description}}</p>
                                    </div>
                                </div>
                            </div>
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