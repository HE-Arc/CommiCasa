@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        @if (isset(Auth::user()->name))
        <h1 class="display-3">Hello <strong>{{Auth::user()->name}}</strong> </h1>
        <p>Learn not to forget to buy what is needed at your home</p>
        @else
        <h1 class="display-3">Welcome to CommiCasa </h1>
        <p>Learn not to forget to buy what is needed at your home</p>
        <p><button class="btn-secondary" onclick="window.location.href='{{route('login')}}'">Login</button></p>
        <p><button class="btn-secondary" onclick="window.location.href='{{route('register')}}'">Register</button></p>
        @endif
    </div>
</div>
<div class="container">
    @if(isset(Auth::user()->name))
        <div class="row justify-content-center">
            <hr>
            <div class="container marketing">
                <div class="row justify-content-center" align="center">
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/product.jpg" width="149" height="149">
                        <h2>Your products list</h2>
                        <p>Discover your products list</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listProduct')}}'">Create your products</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/shopping.jpg" width="149" height="149">
                        <h2>Your shopping list</h2>
                        <p>Discover your shopping list</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listRecipe')}}'">Create your shopping list</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/recipe.jpg" width="149" height="149">
                        <h2>Your recipes list</h2>
                        <p>Discover your recipes</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listShopping')}}'">Create your recipes</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/category.jpg" width="149" height="149">
                        <h2>Your list of categories</h2>
                        <p>Discover your categories</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listCategory')}}'">Create new categories</button></p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <hr>
            <div class="container marketing">
                <div class="row justify-content-center" align="center">
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/product.jpg" width="149" height="149">
                        <h2>List your products</h2>
                        <p>get yourself logged in...</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='#product'">Details</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/shopping.jpg" width="149" height="149">
                        <h2>Create a shopping list</h2>
                        <p>Discover your shopping list</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='#shopping'">Details</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/recipe.jpg" width="149" height="149">
                        <h2>Compose your recipes</h2>
                        <p>Discover your recipes</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='#recipe'">Details</button></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="rounded-circle" alt="Generic placeholder image" src="images/category.jpg" width="149" height="149">
                        <h2>Sort by <catégorie> A</catégorie>
                        </h2>
                        <p>Discover your categories</p>
                        <p><button class="btn btn-secondary" onclick="window.location.href='#category'">Details</button></p>
                    </div>
                </div>
                <hr>
                <div class="row" id="product">
                    <div class="col-md-7">
                        <h2 class="details-heading"><strong>List products you use or have at home!</strong></h2>
                        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                    </div>
                    <div class="col-md-5">
                        <figure>
                            <img class="img-fluid mx-auto" src="images/listeproduit.jpg" alt="500x500" style="width: 500px; height: 500px;">
                            <figcaption align="center">Shopping list example</figcaption>
                        </figure>

                    </div>
                    <div></div>
                </div>
                <hr class="container" id="shopping">
                <div class="row">
                    <div class="col-md-5 pull-md-7">
                        <figure>
                            <img class="img-fluid mx-auto" src="images/listecourse.jpg" alt="500x500" style="width: 500px; height: 500px;">
                            <figcaption align="center">Usual shopping list</figcaption>
                        </figure>
                    </div>


                    <div class="col-md-7">
                        <h2 class="details-heading"><strong>Easily done shopping list</strong></h2>
                        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                    </div>

                    <div></div>

                </div>

                <hr class="container marketing">
                <div class="row" id="recipe">
                    <div class="col-md-7">
                        <h2 class="details-heading"><strong>Compose your own recipes!</strong></h2>
                        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                    </div>
                    <div class="col-md-5">
                        <figure>
                            <img class="img-fluid mx-auto" src="images/listerecipe.jpg" alt="500x500" style="width: 500px; height: 500px;">
                            <figcaption align="center">Recipe</figcaption>
                        </figure>

                    </div>
                    <div></div>
                </div>

                <hr class="container marketing">
                <div class="row" id="category">
                    <div class="col-md-5">
                        <figure>
                            <img class="img-fluid mx-auto" src="images/listecategory.jpg" alt="500x500" style="width: 500px; height: 500px;">
                            <figcaption align="center">Multiple type of products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-7">
                        <h2 class="details-heading"><strong>Sort your products with different categories!</strong></h2>
                        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                    </div>
                </div>
            </div>
            @endif

        </div>

        @endsection