<div id="page-top" role="header">
  <article class="mastheads article text-center text-white d-flex">
    <div class="container my-auto">

    <nav aria-label="breadcrumb" id="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin" style="color: #2c3e50">Painel do Administrador</a></li>
      <li class="breadcrumb-item active" aria-current="page">Notificações</li>
      </ol>
    </nav>
      <div class="row justify-content-center mt-4 mb-5">
          <div class="col-md-12 ">
          <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                      <th scope="col">Usuário</th>
                      <th scope="col">Data de envio</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($notificacoes as $notificacoes)
                       
                        <tr>
                          <td>
                            <a href="arquivosAdmin/{{$notificacoes->id_de}}">
                              {{$notificacoes->nome}}
                            </a>
                          </td>
                          <td>{{$notificacoes->data_envio}}</td>
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

