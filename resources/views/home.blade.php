@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="container">
            <h1 class="">Bienvenu sur CommiCasa</h1>
            <p>Apprenez à ne plus oublier ce que vous devez acheter dans votre maison</p>

            <button class="btn btn-info" onclick="window.location.href='{{route('listProduct')}}'">Créer votre propre liste de course</button>
            <br>
            <br>
            <button class="btn btn-info" onclick="window.location.href='{{route('listRecipe')}}'">Accèder à des recettes</button>
        </div>

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
        </div>

    </div>
</div>
@endsection
