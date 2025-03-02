# 📚 Sistema de Gerenciamento de Biblioteca

Bem-vindo ao sistema simples de gerenciamento de biblioteca! Este projeto permite cadastrar usuários, livros e gerenciar empréstimos de forma prática e eficiente.

🚀 Funcionalidades

1️⃣ Gerenciamento de Usuários

Criar, listar, editar e excluir usuários da biblioteca.

Campos obrigatórios: Nome, Email e Número de Cadastro.

2️⃣ Gerenciamento de Livros

Criar, listar, editar e excluir livros.

Campos obrigatórios: Nome, Autor, Número de Registro e Situação (Emprestado ou Disponível).

3️⃣ Classificação por Gênero

Livros podem ser categorizados em gêneros como Ficção, Romance, Fantasia, Aventura, etc.

4️⃣ Empréstimo de Livros

Cadastrar novos empréstimos vinculando um livro a um usuário.

Definir a data de devolução.

Marcar empréstimos como Atrasado ou Devolvido.

🛠 Tecnologias Utilizadas

PHP (Laravel) - Framework principal

MySQL - Banco de dados

Blade (Laravel Views) - Para exibição das páginas

Bootstrap - Para estilização básica (opcional)

📌 Como Rodar o Projeto Localmente

1️⃣ Clone o Repositório

  ``git clone https://github.com/seuusuario/sistema-biblioteca.git ``
  ``cd sistema-biblioteca``

2️⃣ Instale as Dependências

`` composer install``
 `` npm install`` 


3️⃣ Configure o Banco de Dados

Duplique o arquivo .env.example e renomeie para .env

Edite as credenciais do banco de dados no .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
```

4️⃣ Gere a Chave da Aplicação

 `` php artisan key:generate``

5️⃣ Execute as Migrações e Seeds

 `` php artisan migrate --seed``

6️⃣ Inicie o Servidor

 `` php artisan serve``

Agora, acesse http://127.0.0.1:8000 no seu navegador! 🚀

📌 Versões
Laravel: 8.x (ou versão correspondente)
PHP: 8.1.10