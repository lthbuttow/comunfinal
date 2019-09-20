    <article class="mastheader article text-center text-white d-flex">
      <div class="container my-auto">
      <?php 
    	if (isset($_SESSION['mensagem'])) {
    		echo $_SESSION['mensagem'];
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
        <?php
        // $total_users = $user->getTotalUsuarios();
        // $total_users = $total_users['contagem'];
        // $qt_por_pag = 5;
        // $paginas = $total_users / $qt_por_pag;
        
        // $pg = 1;
        // if(isset($_GET['p']) && !empty($_GET['p'])){
        //   $pg = $_GET['p'];
        // }

        // $p = ($pg-1) * $qt_por_pag;

        // $result = $user->getUsuariosPagination($p,$qt_por_pag);
        // $_SESSION['p'] = $p;
        // $_SESSION['qt_por_pag'] = $qt_por_pag;
        ?>
        <h6>Pesquisar Usuários</h6>
        <form method="POST" id="form-pesquisa" class="form-group" >
          <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Digite o nome do usuário">
        </form>

        <div class="row">
            <div class="col-md-12 text-left">
              <a class="btn btn-primary" href="add_user.php" role="button">ADICIONAR USUÁRIO</a>
            </div>
        </div>

        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-md-12 ">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">E-mail</th>
                          <th scope="col">Edição</th>
                          <th scope="col">Exclusão</th>
                          <th scope="col">Chat</th>
                          <th scope="col">Enviar - Receber</th>
                        </tr>
                    </thead>
                    <tbody id = content>
                        @foreach($listagem as $user)
                          <tr>
                            <td>{{$user['nome']}}</td>
                            <td>{{$user['email']}}</td>
                            <td><a class="btn btn-secondary" id="edita_adm">Editar</a></td>
                            <td><a class="btn btn-danger excluir">Excluir</a></td>
                            <td><a class="btn btn-warning">Iniciar</a></td>                   
                            <td><a class="btn btn-primary acessa">Arquivos</a></td>
                          </tr>
                        @endforeach      
                        <?php 
                        // foreach($result as $dados){
                        // $html = '
                        // <tr>
                        // <td>'.$dados['nome'].'</td>
                        // <td>'.$dados['email'].'</td>
                        // <td><a class="btn btn-secondary" id="edita_adm" href="edita_users.php?id_user='. $dados['id_user'].'">Editar</a></td>
                        // <td><a class="btn btn-danger excluir" href="funcs/exclui_user.php?id_user='. $dados['id_user'].'">Excluir</a></td>
                        // <td><a class="btn btn-warning" href="chat.php?id_para='. $dados['id_user'].'">Iniciar</a></td>                   
                        // <td><a class="btn btn-primary acessa" href="caixa_arquivos_admin.php?id_user='.$dados['id_user'].'"">Arquivos</a></td>
                        // </tr>';
                        // echo $html;
                        // }
                        ?>
                    </tbody>
                </table>
            </div> 
            </div>
          <?php
          // echo '<ul class="pagination justify-content-center mb-4>';
          // for($q=0; $q<$paginas; $q++){
          // $paginacao = '  
          //      <li class="page-item"><a class="page-link" href="menu_users.php?p='.($q+1).'">'.($q+1).'</a></li>';
          // echo $paginacao;
          // }
          // echo '</ul>';
          ?>                      
          </div>
      </div>    
    </article>

<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>

