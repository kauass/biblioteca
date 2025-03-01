@extends('welcome')

@section('title', 'Empréstimo de Livro')

@section('content')

  <h2>Cadastrar Empréstimo de Livro</h2>

  <form id="createEmprestimoForm" method="POST" action="{{ route('emprestimos.store') }}">
    @csrf

    <div class="form-group">
      <label for="usuario_id">Usuário:</label>
      <select class="form-control" id="usuario_id" name="usuario_id" required>
        <option value="">Selecione o Usuário</option>
        @foreach ($usuarios as $usuario)
          <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
        @endforeach
      </select>
    </div>
    
    <div class="form-group">
      <label for="livro_id">Livro:</label>
      <select class="form-control" id="livro_id" name="livro_id" required>
        <option value="">Selecione o Livro</option>
        @foreach ($livros as $livro)
          <option value="{{ $livro->id }}">{{ $livro->nome }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="situacao">Situação:</label>
      <select class="form-control" id="situacao" name="situacao" required>
        <option value="">Selecione a situação</option>
        @foreach ($situacoes_emprestimo as $situacao_emprestimo)
          <option value="{{ $situacao_emprestimo->id }}">{{ $situacao_emprestimo->situacao }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="data_devolucao">Data de Devolução:</label>
      <input type="date" class="form-control" id="data_devolucao" name="data_devolucao" required>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Empréstimo</button>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
 $(document).ready(function() {
      $('#createEmprestimoForm').on('submit', function(e) {
          e.preventDefault();

          $.ajax({
              url: $(this).attr('action'),
              method: 'POST',
              data: $(this).serialize(),
              success: function(response) {
                  alert(response.message);
                    window.location.href = '{{ route('emprestimos.index') }}';       
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
