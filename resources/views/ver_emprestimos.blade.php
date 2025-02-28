@extends('welcome')

@section('title', 'Empréstimo de Livro')

@section('content')

  <h3>Empréstimos Ativos</h3>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Usuário</th>
        <th>Livro</th>
        <th>Data de Empréstimo</th>
        <th>Data de Devolução</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($emprestimos as $emprestimo)
        <tr>
          <td>{{ $emprestimo->usuario->name }}</td>
          <td title="{{ $emprestimo->livro->nome }}">{{ $emprestimo->livro->nome }}</td>
          <td>{{ $emprestimo->created_at->format('d/m/Y') }}</td>
          <td>{{ $emprestimo->data_devolucao_br }}</td>
          <td>
            @if ($emprestimo->situacao->id == 1)
              <span class="text-success" style="font-weight: 700;">{{ $emprestimo->situacao->situacao }}</span>
            @elseif($emprestimo->situacao->id  == 2)
              <span class="text-danger" style="font-weight: 700;">{{ $emprestimo->situacao->situacao }}</span>
            @else  
            <span class="text-warning" style="font-weight: 700;">{{ $emprestimo->situacao->situacao }}</span>
            @endif
          </td>
          <td>
            @if (!$emprestimo->devolvido)
              <form action="{{ route('emprestimos.marcarDevolvido', $emprestimo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success btn-sm">Devolver</button>
              </form>
            @endif
  
            @if ($emprestimo->data_devolucao < now() && !$emprestimo->devolvido)
              <form action="{{ route('emprestimos.marcarAtrasado', $emprestimo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger btn-sm">Atrasado</button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
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
                    $('#createEmprestimoForm')[0].reset(); 
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro ao tentar cadastrar o empréstimo.');
                }
            });
        });
    });
  </script>

@endsection
