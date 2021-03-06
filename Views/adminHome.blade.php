 
    <article class="mastheads text-center text-white d-flex">
      <div class="container my-auto">
        <h2>Olá {{ $_SESSION['nome'] }}</h2>
        <div class="row">
          <!-- <div class="col-lg-4 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <a href="chat_admin.php"><i class="fas fa-4x fa-comment-dots text-orange mb-3 sr-icon-2"></i>
              <h4 class="mb-3">Iniciar Chat</h4></a>
              <p class="text-muted mb-0">Uma opção de conversa em tempo real!</p>
            </div>
          </div> -->
          <div class="col-lg-6 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <a href="https://projetocomun.com/admin/listagemUsuarios"><i class="fas fa-4x fa-id-card text-orange mb-3 sr-icon-3"></i>
              <h4 class="mb-3">Menu de Usuários</h4></a>
              <?php 
                // $qtd_arquivos = $arquivo->getStatus();
                $qtd_arquivos = 3;
              ?>
              <p class="text-muted mb-0">Visão geral dos usuários do sistema</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <a href="https://projetocomun.com/admin/notificacoes"><i class="fas fa-4x fa-envelope text-orange mb-3 sr-icon-4"></i>
              <h4 class="mb-3">Arquivos Recebidos</h4></a>
              @if($unreadFilesCount)
                <p class="text-muted mb-0">Você tem {{ $unreadFilesCount }} arquivos a serem visualizados</p>
              @else
                <p class="text-muted mb-0">Nenhum novo arquivo recebido</p>
              @endif  
            </div>
          </div>
        </div>
      </div>
    </article>


<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>




