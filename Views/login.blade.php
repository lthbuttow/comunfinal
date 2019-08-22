<div class="container">
	<div class="row">
		<div class="col-md-6 mx-auto">
		
			<form class="text-center border border-light p-5 mt-5" method="POST">
				@if (isset ($_SESSION['login']) && $_SESSION['login'] != '')
				<h1>Usuário já está logado</h1>
				@endif	
				<p class="h4 mb-4">Subscribe</p>
				<p>Join our mailing list. We write rarely, but only the best content.</p>
				<p>
					<a href="" target="_blank">See the last newsletter</a>
				</p>
				<input type="text" id="nome" class="form-control mb-4" placeholder="Name" name="nome">
			
				<input type="password" id="senha" class="form-control mb-4" placeholder="Password" name="senha">
				
				@if (isset ($_SESSION['login']) && $_SESSION['login'] != '')
					<button class="btn btn-danger btn-block" type="submit" disabled>Sign in</button>
				@else
					<button class="btn btn-info btn-block" type="submit">Sign in</button>
				@endif	
			</form>
		</div>
	</div>
</div>

