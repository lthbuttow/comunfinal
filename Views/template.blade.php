<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Comun.</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://projetocomun.com/assets/css/style.css">
	<link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon" />
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container">
		<?php if( isset($_SESSION['admin']) ){ ?>	
			<a class="navbar-brand" href="https://projetocomun.com/admin">Comun.</a>
		<?php
		}
		else {
		?>
			<a class="navbar-brand" href="https://projetocomun.com/usuario">Comun.</a>
		<?php	
		} 
		?>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
			<?php if( !isset($_SESSION['login']) ){ ?>
			<li class="nav-item">
				<a class="nav-link" href="#about" id="scrollSuave">Sobre</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#formulario" data-toggle="modal" data-target="#exampleModalCenter">Contato</a>
			</li>
			
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#userModal">Área do Cliente</a>
			</li>                    

			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#adminModal">Administrador</a>
			</li>
			<?php
			}
			else if ( $_SESSION['admin'] != 'ativo'){
			?>	
				<li class="nav-item">
					<a class="nav-link" href="https://projetocomun.com/login/logout" id="scrollSuave">Logout</a>
				</li>
			<?php	
			}
			else if ($_SESSION['admin'] == 'ativo'){
			?>

			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item items-align" href="https://projetocomun.com/admin/notificacoes">Notificações
						<?php if ( $_SESSION['unreadFiles']) {?>
							<span class="badge badge-pill badge-secondary"><?php echo $_SESSION['unreadFiles'] ?></span></a>
						<?php 
						}
						?>
					<a class="dropdown-item" href="https://projetocomun.com/admin/usuariosDesativados">Usuários Desativados</a>		
          <a class="dropdown-item" href="https://projetocomun.com/log/log.txt" download>Baixar Logs</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://projetocomun.com/login/logout" id="scrollSuave">Logout</a>
        </div>
      </li>
			<?php	
			} 
			
			?>
			</ul>
		</div>
		</div>
	</nav>   	

	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
<script type="text/javascript" src="https://projetocomun.com/assets/js/script.js"></script>	
</body>
</html>