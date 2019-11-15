<?php 
include 'assets/hf/header.php';
if (isset($_SESSION['login']) && !empty($_SESSION['login']) || isset($_SESSION['admin']) && !empty($_SESSION['admin']) ) {
	$_SESSION['id_para'] = $_GET['id_para'];
?>
<!-- topo -->
<body class="over">
    <div class="row justify-content-center" >
    <div class="col-md-6 mt-5">
	<?php 
	if (isset($_SESSION['admin']) && !empty($_SESSION['admin']) ) {
	?>	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="admin.php" style="color: #2c3e50;">Painel do Administrador</a></li>
		<li class="breadcrumb-item"><a href="menu_users.php" style="color: #2c3e50;">Menu de Usuários</a></li>
		<li class="breadcrumb-item active" aria-current="page">Chat</li>
		</ol>
    </nav>
	<?php 
	} else{
	?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="user.php" style="color: #2c3e50;">Painel do Usuário</a></li>
		<li class="breadcrumb-item active" aria-current="page">Chat</li>
		</ol>
    </nav>	
	<?php
	}
	?>
		<h1 class="text-center">CHAT - SUPORTE</h1>
		<div id="content">
			<div id="lista">

			</div>
			<hr/>
			<form id="form-chat" method="POST">
					<div class="input-group">
						<input type="text" name="mensagem" id="mensagem" placeholder="Digite sua mensagem" class="form-control" />
						<span class="input-group-btn">
							<input type="submit" value="&rang;&rang;" id="envMsg" class="btn btn-info">
						</span>
					</div>
			</form>
		</div>
	</div>		
	</div>
</body>	
<?php  
} else{
    header("Location: index.php");
}
?>



