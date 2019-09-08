    <header class="masthead text-center text-white d-flex" id="main">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Comun.</strong>
            </h1>
            <hr class="hr">
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Simples, rápido e prático. Comunique-se</p>
            <a class="button" id="btinfo" href="#about"><span>Info</span></a> 
          </div>
        </div>
      </div>
    </header>
</div>

<article>
	<section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Aproximação Cliente x Empresa</h2>
            <hr class="light my-4 hr">
            <p class="text-faded mb-4">Com nosso sistema você vai poder manter uma relação direta com seus clientes, o chat é tudo o que você precisa, já com a possibilidade de enviar arquivos diretamente por aqui evitamos gasto de tempo e dinheiro com seu deslocamento.</p>
            <a class="button blue" href="#news"><span>Mais</span></a>
          </div>
        </div>
      </div>
    </section>
</article>
<div class="container-fluid" id="formulario">
  <div class="row">
    <div class="col-sm-6 mx-auto">
        <div class="well text-blue" style="margin-top: 10%;">
          <div id="alert">
          
          </div>
        <h2 class="text-center pb-2">Envie sua mensagem</h2>
        <hr class="hr-blue">
        <form role="form" id="contactForm">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="email" class="h4">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email..." data-toggle="tooltip" data-placement="top" title="Digite seu email como o exemplo xxxxxx@yyyyy.com" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="h4">Mensagem</label>
                <textarea id="message" class="form-control" rows="5" name="message" placeholder="Digite sua mensagem..." data-toggle="tooltip" data-placement="top" title="Seja direto, vai nos ajudar a tirar a sua dúvida!" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
            <div class="text-center padding mt-4">
              <button class="button blue" type="submit" id="enviaEmail"><span>Enviar</span></button>
            </div>  
        </form>
        </div>
    </div>
  </div>
</div>

<footer class="bg-darks text-white" id="news">
  <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-comments-dollar text-orange mb-3 sr-icon-1"></i>
              <h3 class="mb-3">Comunique-se</h3>
              <p class="text-muted mb-0">A solução para você melhorar sua relação com o cliente</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fab fa-4x fa-js-square text-orange mb-3 sr-icon-2"></i>
              <h3 class="mb-3">Avançando</h3>
              <p class="text-muted mb-0">Usamos sempre as melhores tecnologias para facilitar suas atividades!</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-mobile-alt text-orange mb-3 sr-icon-3"></i>
              <h3 class="mb-3">Responsividade</h3>
              <p class="text-muted mb-0">Site preparado para ser acessado por todos tipos de dispositivos</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-heart text-orange mb-3 sr-icon-4"></i>
              <h3 class="mb-3">Feito para você</h3>
              <p class="text-muted mb-0">Sempre pensando na melhor experiência para o usuário</p>
            </div>
          </div>
        </div>
      </div>
</footer>
<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>

{{-- Modal Login Cliente --}}

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Acesse a área do Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="login/loginUser">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nome/E-mail:</label>
              <input type="text" name="nome" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="recipient-pass" class="col-form-label">Senha:</label>
              <input type="text" name="senha" class="form-control" id="recipient-pass">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Login Admin --}}

<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acesse a área de Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="login/loginAdmin">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">E-mail:</label>
            <input type="email" name="email" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-pass" class="col-form-label">Senha:</label>
            <input type="text" name="senha" class="form-control" id="recipient-pass">
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>