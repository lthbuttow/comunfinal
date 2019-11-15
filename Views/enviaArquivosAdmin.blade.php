<?php 
// include 'assets/hf/header.php'; 
// if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
//     $id_para = $_GET['id_user'];
// ?>
<!-- topo -->
<div id="page-top" role="header">
  
    <article class="mastheads text-center text-white d-flex">
      <div class="container my-auto">
        <?php 
        if (isset($_SESSION['mensagem'])) {
          echo $_SESSION['mensagem'];
          unset($_SESSION['mensagem']);
        }
        ?> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../" style="color: #2c3e50;">Painel do Administrador</a></li>
          <li class="breadcrumb-item"><a href="../listagemUsuarios" style="color: #2c3e50;">Menu de Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista de Arquivos/Envio</li>
        </ol>
        </nav>

        <div class="row justify-content-center mt-4 mb-2">
          <div class="col-lg-6 col-md-6">
            <div id="alert">
            
            </div>
            <form method="POST" enctype="multipart/form-data" id="form_envia_user">
                  <div class="form-group">
                    <label for="arquivo"><h3>Envie seus arquivos aqui</h3></label>
                    <input type="file" name="arquivo" class="form-control-file" id="arquivo" aria-describedby="enviodearquivos">
                  </div> 
                  <div class="form-group">
                    <label for="comment">Deixe seu comentário aqui</label>
                    <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Digite sua mensagem..."></textarea>
                  </div>                               
                  <button type="submit" class="btn btn-primary" id="envia_arquivo">Enviar</button>
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




