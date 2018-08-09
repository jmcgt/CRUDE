<?php
$titulo = "Cadastro";
include "conexao.php";
include "cabecalho.php";
?>
<section class="container">
	<div class="row linha align-items-center justify-content-center">
    	<div class="col-sm-10 col-md-7 col-lg-6 formulario p-5">
            <h2 class="h1 pb-4 text-center">Pessoas</h2>
            <?php
			if(isset($_GET["acao"]) && $_GET["acao"]=="cadastrar")
			{
				if(!empty($_POST["nome"]) && !empty($_POST["email"]))
				{
					$nome = $_POST["nome"];
					$email = $_POST["email"];
				}
				
				mysqli_stmt_prepare($pstmt, "call insert_pessoa(?, ?)");
				mysqli_stmt_bind_param($pstmt, "ss", $nome, $email);
				mysqli_stmt_execute($pstmt);
				
				mysqli_stmt_close($pstmt);
				
				header("Location: index.php");
			}
			?>
            <form name="cadastro" id="cadastro" action="cadastro.php?acao=cadastrar" method="POST">
                <div class="form-group required">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" required>
                </div>
                <div class="form-group required">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@provedor.com.br" required>
                </div>
                <button type="submit" class="btn btn-primary px-4 py-2 mt-2 float-right">
                    <span class="btn-texto">Enviar</span>
                </button>
            </form>
        </div>
    </div>
</section>
<?php
$script = "
$('form').validate({
	rules:
	{
		nome:{required:true},
		email:{required:true, email:true}
	},
	messages:
	{
		nome:{required:'Informe o nome'},
		email:{required:'Digite o email', email:'Digite um e-mail v&aacute;lido.'}
	}
});";

include "rodape.php";
?>