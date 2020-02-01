<?php 
// include 'assets/hf/header.php';
// include 'funcs/function.php';
// include 'classes/arquivos.class.php';
// $arquivo = NEW Arquivo();  
// if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
//     $id_de = $_GET['id_user'];
//     $id_para = $_SESSION['id_user'];
?>
<!-- topo -->
<body>
<div id="page-top" role="header">
      <?php
      // $total_arquivos = $arquivo->getTotalArquivos($id_de);
      // $total_arquivos = $total_arquivos['contagem'];
      // $qt_por_pag = 4;
      // $paginas = $total_arquivos / $qt_por_pag;
      // $pg = 1;
      // if(isset($_GET['p']) && !empty($_GET['p'])){
      //   $pg = $_GET['p'];
      // }

      // $p = ($pg-1) * $qt_por_pag;      
      // $result = $arquivo->meusArquivosAdminPag($id_de,$id_para,$p,$qt_por_pag);
      ?>
    <article class="mastheads article text-center text-white d-flex">
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
            <li class="breadcrumb-item active" aria-current="page">Lista de Arquivos</li>
          </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 text-left mb-1">
              <a class="btn btn-success" href="../enviaArquivosAdmin/{{$id_para}}" role="button">ENVIAR ARQUIVO</a>
            </div>
        </div>          
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
                        @foreach ($result as $arquivo)
                        <tr>
                           <th scope="row">{{$arquivo['url']}}</th>
                           <td>{{$arquivo['comentario']}}</td>
                           <td>{{date("d/m/Y - H:i", strtotime($arquivo['data_envio']))}}</td>
                          <td><a href="../../arquivos/{{$arquivo['url']}}" download class="btn btn-info">Baixar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pagination justify-content-center mb-4">

                  @for($q=0; $q<$paginas; $q++)
                  
                  <li class="page-item"><a class="page-link" style="color: #2c3e50;" href="http://localhost:8888/projetocomun/admin/arquivosAdmin?p={{$q+1}}">{{$q+1}}</a></li>
                  
                  @endfor
                  
                </ul>
            <?php
              // echo '<ul class="pagination justify-content-center mb-4>';
              // for($q=0; $q<$paginas; $q++){
              // $paginacao = '  
              //     <li class="page-item"><a class="page-link" style="color: #2c3e50;" href="caixa_arquivos_admin.php?id_user='.$id_de.'&p='.($q+1).'">'.($q+1).'</a></li>';
              // echo $paginacao;
              // }
              // echo '</ul>';
            ?>
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



