@extends('welcome')

@section('title', 'Cadastrar Livro')

@section('content')

  <h2>Formulário de Cadastro de Livro</h2>

  <form id="createLivroForm" method="POST" action="{{ route('livros.store') }}">
    @csrf
    <div class="form-group">
      <label for="numero_cadastro">Número de Cadastro:</label>
      <input type="text" class="form-control input-sm" id="numero_cadastro" name="numero_cadastro" value="{{ $proximo_id }}" required readonly style="width: 100px;">
    </div>
    
    <div class="form-group">
      <label for="nome">Nome do Livro:</label>
      <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    
    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="text" class="form-control" id="autor" name="autor" required>
    </div>

    <div class="form-group">
      <label for="genero">Gênero:</label>
      <select class="form-control" id="genero" name="genero" required>
        <option value="" disabled selected>Selecione o Gênero</option>
        @foreach ($generos as $genero)
          <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
  </form>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script>
  $(document).ready(function() {
      $('#createLivroForm').on('submit', function(e) {
          e.preventDefault();

          $.ajax({
              url: $(this).attr('action'),
              method: 'POST',
              data: $(this).serialize(),
              success: function(response) {
                  alert(response.message); 
                  window.location.href = '{{ route('livros.index') }}'; 
              },
              error: function(xhr, status, error) {
                  if (xhr.status === 422) {  
                      let errors = xhr.responseJSON.errors;
                      alert(errors.nome ? errors.nome[0] : 'Ocorreu um erro inesperado.');
                  } else {
                      alert('Ocorreu um erro ao tentar cadastrar o livro.');
                  }
              }
          });
      });
  });
  </script>

@endsection