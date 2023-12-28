@extends('layouts.main')

@section('title', 'Cadastro de Imovel')

@section('content')
<nav class='containerCreateHouse'>
    <form action="/house/create" method="POST" class='formCreateHouse'>
        @csrf
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" maxlength="50" required>
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        <div class="mb-3">
            <label for="quartos" class="form-label">Quartos</label>
            <input type="number" class="form-control" id="quartos" name="quartos" required>
        </div>
        <div class="mb-3">
            <label for="banheiros" class="form-label">Banheiros</label>
            <input type="number" class="form-control" id="banheiros" name="banheiros" required>
        </div>
        <div class="mb-3">
            <label for="area" class="form-label">Área em m²</label>
            <input type="number" class="form-control" id="area" name="area" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</nav>
@endsection
