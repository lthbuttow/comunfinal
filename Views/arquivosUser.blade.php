
    
      <?php
      // require 'classes/arquivos.class.php';
      // $arquivo = NEW Arquivo(); 
      // $result = $arquivo->meusArquivos($id_para);
      ?>
    <article class="mastheads article text-center text-white d-flex">
      <div class="container my-auto">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../" style="color: #2c3e50;">Painel do Usuário</a></li>
              <li class="breadcrumb-item active" aria-current="page">Arquivos Recebidos</li>
            </ol>
          </nav>	
        <div class="row">
        <div class="col-md-12 ">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Arquivo</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Data</th>
                        <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // foreach($result as $arquivo){
                        // $html = '
                        // <tr>
                        // <th scope="row">'.$arquivo['link'].'</th>
                        // <td>'.$arquivo['comentario'].'</td>
                        // <td>'.data_br($arquivo['dt_envio']).'</td>
                        // <td><a href="arquivos/'. $arquivo['link'].'" download class="btn btn-info">Baixar</a></td>
                        // </tr>';
                        // echo $html;
                        // }
                        ?>
                        @foreach ($arquivos as $arquivo)
                        <tr>
                           <th scope="row">{{$arquivo['url']}}</th>
                           <td>{{$arquivo['comentario']}}</td>
                           <td>{{date("d/m/Y - H:i", strtotime($arquivo['data_envio']))}}</td>
                          <td><a href="../../arquivos/{{$arquivo['url']}}" download class="btn btn-info">Baixar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            </div>         
          </div>
        </div>
        </div>       
    </article>

</div>
<div class="container-fluid bg-dark text-center text-white">
  <p class="pb-2 mb-0 pt-2">Desenvolvido por Lucas Büttow <i class="fas fa-copyright"></i></p>
</div>




