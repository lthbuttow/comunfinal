<article class="mastheader article text-center text-white d-flex">
  <div class="container my-auto">
  <?php 
  if (isset($_SESSION['mensagem'])) {
    echo ($_SESSION['mensagem']);
    unset($_SESSION['mensagem']);
  }
  ?>
  <div id="alert">
        
  </div>
  <div class="row">
    <div class="col-md-12 text-left">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../admin" style="color: #2c3e50;">Painel do Administrador</a></li>
          <li class="breadcrumb-item active" aria-current="page">Menu de usuários</li>
        </ol>
      </nav>
    </div>
  </div>    
    <h6>Pesquisar Usuários</h6>
    <form method="POST" id="form-pesquisa" class="form-group" >
      <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Digite o nome do usuário">
    </form>

    <div class="row">
        <div class="col-md-12 text-left">
          <a class="btn btn-primary" href="../admin/adicionarUsuario" role="button">ADICIONAR USUÁRIO</a>
        </div>
    </div>

        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-md-12 ">
              <div class="table-responsive">
                  <table class="table" id="usersList">
                      <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Desativar</th>
                            <th scope="col">Chat</th>
                            <th scope="col">Arquivos</th>
                          </tr>
                      </thead>
                      <tbody id = content>
                          @foreach($listagem as $user)
                            <tr>
                              <td scope="row">{{ $user['id'] }}</td>
                              <td>{{$user['nome']}}</td>
                              <td>{{$user['email']}}</td>
                            <td><a id="edita_adm" href="editarusuario/{{$user['id']}}"><i class="fa-2x far fa-edit hv"></i></a></td>
                              <td><a class="excluir" onclick="deleteUser({{$user['id']}})"><i class="fa-2x far fa-minus-square hv"></i></a></td>
                              <td><a><i class="fa-2x far fa-comment-alt hv"></i></a></td>                   
                            <td><a class="acessa hv" href="arquivosAdmin/{{$user['id']}}"><i class="fa-2x far fa-folder hv"></i></a></td>
                            </tr>
                          @endforeach      
                      </tbody>
                  </table>
              </div> 
            </div>
            
          <ul class="pagination justify-content-center mb-4">

      @for($q=0; $q<$paginas; $q++)
      
      <li class="page-item"><a class="page-link" style="color: #2c3e50;" href="https://projetocomun.com/admin/listagemUsuarios?p={{$q+1}}">{{$q+1}}</a></li>
      
      @endfor
      
      </ul>
                
      </div>
  </div>    
</article>

<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>
  
<!-- Modal -->
<div class="modal fade" id="ExcluirUsuario" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Desativar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você realmente deseja desativar este usuário?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmaExcluir">Sim</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>    
      </div>
    </div>
  </div>
</div>
