<body>
 
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
              <a href="menu_users.php"><i class="fas fa-4x fa-id-card text-orange mb-3 sr-icon-3"></i>
              <h4 class="mb-3">Menu de Usuários</h4></a>
              <?php 
                // $qtd_arquivos = $arquivo->getStatus();
                // $qtd_mensagem = $arquivo->getStatusMsg();
                $qtd_arquivos = 3;
                $qtd_mensagem = 2;
              ?>
              <p class="text-muted mb-0">Atualmente você tem <?php echo $qtd_arquivos; ?> arquivos que ainda não foram visualizados</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <a href="mensagens.php"><i class="fas fa-4x fa-envelope text-orange mb-3 sr-icon-4"></i>
              <h4 class="mb-3">Mensagens</h4></a>
              <p class="text-muted mb-0">Você tem <?php echo $qtd_mensagem; ?> mensagens a serem visualizadas</p>
            </div>
          </div>
        </div>
      </div>
    </article>


<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>




