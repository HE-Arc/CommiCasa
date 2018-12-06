@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="jumbotron">
            <div class="container">

            </div>
            <h1 class="display-3">Hello <strong>{{Auth::user()->name}}</strong>, bienvenu sur CommiCasa </h1>
            <p>Apprenez à ne plus oublier ce que vous devez acheter dans votre maison</p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Votre liste de produit</h2>
                    <p>Découvrez votre liste de course</p>
                    <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listProduct')}}'">Créer votre propre liste de course</button></p>
                </div>
                <div class="col-md-4">
                    <h2>Votre liste de Shopping</h2>
                    <p>Découvrez votre liste de shopping</p>
                    <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listRecipe')}}'">Créer votre propre liste de course</button></p>
                </div>
                <div class="col-md-4">
                    <h2>Votre liste de produit</h2>
                    <p>Découvrez vos recettes</p>
                    <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listShopping')}}'">Créer votre propre liste de course</button></p>
                </div>
                <div class="col-md-4">
                    <h2>Votre liste de catégories</h2>
                    <p>Découvrez votre catérogies</p>
                    <p><button class="btn btn-secondary" onclick="window.location.href='{{route('listCategory')}}'">Créer votre propre liste de course</button></p>
                </div>
            </div>
        </div>


        <!--
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                -->
        </div>

    </div>
</div>
@endsection
