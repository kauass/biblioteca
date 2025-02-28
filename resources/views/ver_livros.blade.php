@extends('welcome')

@section('title', 'Lista de livros')

@section('content')

<h2>Lista de Livros</h2>

@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th style="width: 10%;">ID</th>
      <th style="width: 40%;">Nome</th>
      <th>Autor</th>
      <th>Gênero</th>
      <th>Situação</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($livros as $livro)
      <tr>
        <td>{{ $livro->id }}</td>
        <td>{{ $livro->nome }}</td>
        <td>{{ $livro->autor }}</td>
        <td>{{ $livro->generos->nome }}</td>

        <td> 
          @if ($livro->situacao == 1)
            <span class="text-success" style="font-weight: 700;">Disponível</span>
          @else
            <span class="text-warning" style="font-weight: 700;">Emprestado</span>
          @endif
        </td>
        <td>
          <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-warning btn-sm">Editar</a>
          @if($livro->situacao == 1)
            <a href="{{ route('livros.emprestar') }}" class="btn btn-primary btn-sm">Emprestar</a>
          @endif
          @if ($livro->trashed())
            <form method="POST" style="display:inline;" action="{{ route('livro.restore', $livro->id) }}">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-success btn-sm">Ativar</button>
            </form>
          @else
            <form method="POST" style="display:inline;" action="{{ route('livro.destroy', $livro->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja inativar?')">Inativar</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>


<a href="{{ route('livros.create') }}" class="btn btn-primary">Criar Novo Livro</a>

@endsection
