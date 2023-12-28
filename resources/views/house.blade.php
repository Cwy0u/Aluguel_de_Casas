@extends('layouts.main')

@section('title', 'Detalhes da Casa')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="house-details">
                <img src="/img/house.png" class="img-fluid mb-3" style="max-height: 200px; object-fit: cover;" alt="Imagem da Casa">
                <h5>{{ $house->descricao }}</h5>
                <p><strong>Preço:</strong> R$ {{ $house->valor }}</p>
                <p><strong>Quartos:</strong> {{ $house->quartos }}</p>
                <p><strong>Banheiros:</strong> {{ $house->banheiros }}</p>
                <p><strong>Área:</strong> {{ $house->area }} m²</p>
                <p><strong>Disponível:</strong> {{ $house->disponivel ? 'Sim' : 'Não' }}</p>
                <a href="/alugar/{{$house->id}}" class="btn btn-primary">Alugar</a>
            </div>
        </div>
    </div>
</div>
@endsection
