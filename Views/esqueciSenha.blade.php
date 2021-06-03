<div class="container">
	<div class="row">
		<div class="col-md-6 mx-auto">
		
			<form class="text-center border border-light p-5 mt-5" method="POST">
	
				<h1>Esqueci Minha Senha</h1>

				<p>Preencha seu e-mail e clique no botão enviar para te ajudarmos ;)</p>

				<input type="email" id="email" class="form-control mb-4" placeholder="Digite seu e-mail" name="email">
			
				<button class="btn btn-info btn-block" type="submit">Enviar</button>

				@if($mensagem)
					<p class="text-muted mb-0 mt-4">{{ $mensagem }}</p>
					<a href="http://localhost:8888/projetocomun">Voltar para a home</a>
				@endif

				@if($debug)
					<p class="text-muted mb-0 mt-4">{{ $debug }}</p>
				@endif 				
			</form>	
		</div>
	</div>
</div>

