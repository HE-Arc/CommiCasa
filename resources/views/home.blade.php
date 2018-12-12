@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            @if (isset(Auth::user()->name))
                <h1 class="display-3">Hello <strong>{{Auth::user()->name}}</strong> </h1>
                <p>Apprenez à ne plus oublier ce que vous devez acheter dans votre maison</p>
                @else
                <h1 class="display-3">Bienvenu sur CommiCasa </h1>
                <p>Apprenez à ne plus oublier ce que vous devez acheter dans votre maison</p>
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
                            <h2>Votre liste de produit</h2>
                            <p>Découvrez votre liste de course</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listProduct')}}'">Créer vos produits</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/shopping.jpg" width="149" height="149">
                            <h2>Votre liste de Shopping</h2>
                            <p>Découvrez votre liste de shopping</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listRecipe')}}'">Créer votre liste de shopping</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/recipe.jpg" width="149" height="149">
                            <h2>Votre liste de recettes</h2>
                            <p>Découvrez vos recettes</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listShopping')}}'">Créer vos recettes</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/category.jpg" width="149" height="149">
                            <h2>Votre liste de catégories</h2>
                            <p>Découvrez votre catérogies</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listCategory')}}'">Créer des catégories</button></p>
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
                            <h2>Lister vos produit</h2>
                            <p>Loggez vous...</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='#product'">Détails</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/shopping.jpg" width="149" height="149">
                            <h2>Créer une liste de course</h2>
                            <p>Découvrez votre liste de shopping</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='#shopping'">Détails</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/recipe.jpg" width="149" height="149">
                            <h2>Composer ses recettes</h2>
                            <p>Découvrez vos recettes</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='#recipe'">Détails</button></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle" alt="Generic placeholder image" src="images/category.jpg" width="149" height="149">
                            <h2>Trier par <catégorie>       A</catégorie></h2>
                            <p>Découvrez votre catérogies</p>
                            <p><button class="btn btn-secondary" onclick="window.location.href='#category'">Détails</button></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="product">
                        <div class="col-md-7">
                            <h2 class="details-heading"><strong>Lister les produits de chez vous !</strong></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                        <div class="col-md-5">
                            <figure>
                                <img class="img-fluid mx-auto" src="images/listeproduit.jpg" alt="500x500" style="width: 500px; height: 500px;">
                                <figcaption align="center">Exemple liste de course</figcaption>
                            </figure>

                        </div>
                        <div></div>
                    </div>
                    <hr class="container" id="shopping">
                    <div class="row">
                        <div class="col-md-5 pull-md-7">
                            <figure>
                                <img class="img-fluid mx-auto" src="images/listecourse.jpg" alt="500x500" style="width: 500px; height: 500px;">
                                <figcaption align="center">Liste de course habituelle</figcaption>
                            </figure>
                        </div>


                        <div class="col-md-7">
                            <h2 class="details-heading"><strong>Faire sa liste de course facilement</strong></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>

                        <div></div>

                    </div>

                    <hr class="container marketing" >
                    <div class="row" id="recipe">
                        <div class="col-md-7">
                            <h2 class="details-heading"><strong>Composer vos recettes !</strong></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                        <div class="col-md-5">
                            <figure>
                                <img class="img-fluid mx-auto" src="images/listerecipe.jpg" alt="500x500" style="width: 500px; height: 500px;">
                                <figcaption align="center">Recette</figcaption>
                            </figure>

                        </div>
                        <div></div>
                    </div>

                    <hr class="container marketing">
                    <div class="row" id="category">
                        <div class="col-md-5">
                            <figure>
                                <img class="img-fluid mx-auto" src="images/listecategory.jpg" alt="500x500" style="width: 500px; height: 500px;">
                                <figcaption align="center">Différente type de produit</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-7">
                            <h2 class="details-heading"><strong>Mettez des catégoris à vos produits !</strong></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                    </div>
                </div>
        @endif

    </div>

@endsection
