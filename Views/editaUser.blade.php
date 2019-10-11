<div id="page-top" role="header">

    <article class="mastheads text-center text-white d-flex">
      <div class="container my-auto">
      
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php" style="color: #2c3e50;">Painel do Administrador</a></li>
          <li class="breadcrumb-item"><a href="menu_users.php" style="color: #2c3e50;">Menu de Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
        </ol>
      </nav>
        <div class="row justify-content-center mt-4 mb-2">
          <div class="col-lg-6 col-md-6">
            <div id="alert">
            
            </div>
            <form id="editar_usuario">
              <input type="hidden" id="id_user" name="id_user" value="{{$dados['id']}}">
              <div class="form-group">
                <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome do usuário..." value="{{$dados['nome']}}">
              </div>              
              <div class="form-group">
                <label for="emai">E-mail </label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Digite o E-mail" value="{{$dados['email']}}">
              </div>
              <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite a senha..." value="<{{$dados['senha']}}">
              </div>
              <button class="btn btn-info" id="envia_alter">Confirmar</button>
            </form>
          </div>
        </div>
      </div>
    </article>
</div>
</footer>
<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>



