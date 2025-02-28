@extends('welcome')

@section('title', 'Detalhes do Usuário')

@section('content')

  <h2>Detalhes do Usuário</h2>

  <form id="atualizar_usuario" method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="numero_cadastro">Número de Cadastro:</label>
      <input type="text" class="form-control input-sm" id="numero_cadastro" name="numero_cadastro" value="{{ $user->id }}" readonly style="width: 100px;">
    </div>

    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
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
                    window.location.href = '{{ route('users.index') }}'; 
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
