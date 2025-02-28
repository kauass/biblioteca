@extends('welcome')

@section('title', 'Lista de Usuários')

@section('content')

  <h2>Lista de Usuários</h2>

  <!-- Mensagens de sucesso e erro -->
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
        <th>Número de Cadastro</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>

            @if ($user->trashed())
              <!-- Se o usuário estiver inativo, mostrar o botão para ativar -->
              <form method="POST" style="display:inline;" action="{{ route('users.restore', $user->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success btn-sm">Ativar</button>
              </form>
            @else
              <!-- Se o usuário estiver ativo, mostrar o botão para inativar -->
              <form method="POST" style="display:inline;" action="{{ route('users.destroy', $user->id) }}">
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

  <!-- Links de Paginação -->
  <div class="d-flex justify-content-center">
    {{ $users->links() }} <!-- Isso gera os links de paginação -->
  </div>

  <a href="{{ route('users.create') }}" class="btn btn-primary">Criar Novo Usuário</a>

@endsection
