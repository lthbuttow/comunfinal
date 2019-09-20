<div id="page-top" role="header">
  <article class="mastheads article text-center text-white d-flex">
    <div class="container my-auto">

    <nav aria-label="breadcrumb" id="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin" style="color: #2c3e50">Painel do Administrador</a></li>
      <li class="breadcrumb-item active" aria-current="page">Mensagens</li>
      </ol>
    </nav>
      <div class="row justify-content-center mt-4 mb-5">
          <div class="col-md-12 ">
          <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                      <th scope="col">E-mail</th>
                      <th scope="col">Mensagem</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($msgs as $msg)
                      <tr>
                        <td>{{$msg->email}}</td>
                        <td>{{$msg->mensagem}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div> 
          </div>         
        </div>
    </div>    
  </article>
</div>
<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>

