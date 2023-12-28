@extends('layouts.main')

@section('title', 'My Houses')

@section('content')
<div class="container containerHouses">
    <div class="row">
        @if($houses && count($houses) > 0)
            @foreach($houses as $house)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <img src="/img/house.png" class="card-img-top" alt="Imagem da Casa">
                        <div class="card-body">
                            <p class="card-title">{{ $house->descricao }}</p>
                            <p class="card-text">Preço: R$ {{ $house->valor }}</p>
                            <p>Vendedor: {{ $house->user->name }}</p>

                            <a href="/" class="btn btn-primary">Ver Mais</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="col-12">Nenhuma Casa Encontrada!</p>
        @endif
    </div>
</div>
@endsection
