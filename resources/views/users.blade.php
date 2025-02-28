@extends('welcome')

@section('title', 'Criar Usuário')

@section('content')

  <h2>Formulário de Criação de Usuário</h2>

  <form id="createUserForm" method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="form-group">
      <label for="numero_cadastro">Número de Cadastro:</label>
      <input type="text" class="form-control input-sm" id="numero_cadastro" name="numero_cadastro" value="{{ $proximo_id }}" required readonly style="width: 100px;">
    </div>
    
    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <button type="submit" class="btn btn-primary">Criar Usuário</button>
  </form>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
        $('#createUserForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#createUserForm')[0].reset(); 
                    alert(response.message); 
                    window.location.href = '{{ route('users.index') }}'; 
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {  
                        let errors = xhr.responseJSON.errors;
                        alert(errors.email ? errors.email : (errors.numero_cadastro ? errors.numero_cadastro : 'Ocorreu um erro inesperado.'));
                    } else {
                        alert('Ocorreu um erro ao tentar cadastrar o usuário.');
                    }
                }
            });
        });
    });
  </script>

@endsection
