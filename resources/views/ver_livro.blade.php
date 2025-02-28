@extends('welcome')

@section('title', 'Detalhes do Usuário')

@section('content')

  <h2>Detalhes do Livro</h2>

  <form id="atualizar_usuario" method="POST" action="{{ route('livros.update', $livro->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="numero_cadastro">Número de Cadastro:</label>
      <input type="text" class="form-control input-sm" id="numero_cadastro" name="numero_cadastro" value="{{ $livro->id }}" readonly style="width: 100px;">
    </div>

    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" name="nome" value="{{ $livro->nome }}">
    </div>

    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="autor" class="form-control" id="autor" name="autor" value="{{ $livro->autor }}">
    </div>

    <div class="form-group">
      <label for="genero">Gênero:</label>
      <select class="form-control" id="genero" name="genero" required>
        <option value="" disabled {{ !isset($livro) ? 'selected' : '' }}>Selecione o Gênero</option>
        @foreach ($generos as $genero)
          <option value="{{ $genero->id }}" 
            {{ isset($livro) && $livro->genero == $genero->id ? 'selected' : '' }}>
            {{ $genero->nome }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
        $('#atualizar_usuario').on('submit', function(e) {
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
                        alert(errors.email ? errors.email : 'Ocorreu um erro inesperado.');
                    } else {
                        alert('Ocorreu um erro ao tentar atualizar o usuário.');
                    }
                }
            });
        });
    });
  </script>

@endsection
