<div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
            
                <form class="text-center border border-light p-5 mt-5" method="POST">
                    <p class="h4 mb-4">Edit User Information</p>
                <input type="text" id="nome" class="form-control mb-4" value="{{$nome}}" placeholder="Name" name="nome">
                
                    <input type="password" id="senha" class="form-control mb-4" value="{{$senha}}" placeholder="Password" name="senha">

                    <button class="btn btn-info btn-block" type="submit">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
    
    