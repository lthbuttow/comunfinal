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
              <li class="breadcrumb-item active" aria-current="page">Lista de usuários inativos</li>
            </ol>
          </nav>
        </div>
      </div>    
        <h4 class="mb-5 mt-5">Listagem de Usuários</h4>
        

        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-md-12 ">
              <div class="table-responsive">
                  <table class="table" id="usersList">
                      <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Reativar</th>
                            <th scope="col">Deletar</th>
                          </tr>
                      </thead>
                      <tbody id = content>
                          @foreach($listagem as $user)
                            <tr>
                              <td scope="row">{{ $user['id'] }}</td>
                              <td>{{$user['nome']}}</td>
                              <td>{{$user['email']}}</td>
                            <td><a id="ativar" onclick="activateUser({{$user['id']}})"><i class="fa-2x far fa-plus-square hv"></i></a></td>
                              <td><a class="excluir" onclick="deleteUser({{$user['id']}})"><i class="fa-2x far fa-minus-square hv"></i></a></td>
                            </tr>
                          @endforeach      
                      </tbody>
                  </table>
              </div> 
            </div>
            
                    
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
        <h5 class="modal-title" id="TituloModalCentralizado">Deletar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você realmente deseja deletar este usuário?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmaExcluir">Sim</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>    
      </div>
    </div>
  </div>
</div>

{{-- Modal Reativar user --}}
<div class="modal fade" id="ReativarUsuario" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Reativar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você realmente deseja reativar este usuário?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmaReativar">Sim</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>    
      </div>
    </div>
  </div>
</div>