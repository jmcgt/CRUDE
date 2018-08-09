<?php
$titulo = "Pessoas";
include "conexao.php";
include "cabecalho.php";
?>
	<section class="container">
    	<div class="row linha align-items-center justify-content-center">
    		<div class="col-md-10 col-lg-9 formulario p-5">
                <h2 class="h1 pb-4 text-center">Pessoas</h2>
                <?php
                $statement = "select * from v_ps";
                
                if(isset($_GET["acao"]) && $_GET["acao"]=="buscar")
                {
                    if(!empty($_POST["busca"]))
                    {
                        $busca = $_POST["busca"];
                        $statement .= " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%'";
                    }
                }
                
                $statement .= " ORDER BY nome";
                
                $q = mysqli_query($con, $statement);
                if(mysqli_num_rows($q)>0)
                {
					if(isset($_GET["acao"]) && $_GET["acao"]=="deletar")
					{
						if(!empty($_POST["ids"]))
						{
							$ids = $_POST["ids"];		
							for($i=0; $i<count($ids); $i++)
							{
								mysqli_stmt_prepare($pstmt, "select * from v_ps where id = ?");
								
								$p_id = $ids[$i];
								
								mysqli_stmt_bind_param($pstmt, "i", $p_id);
								mysqli_stmt_execute($pstmt);
								mysqli_stmt_store_result($pstmt);
								
								if(mysqli_stmt_num_rows($pstmt)>0)
								{
									mysqli_stmt_prepare($pstmt, "call delete_pessoa(?)");
									mysqli_stmt_bind_param($pstmt, "i", $ids[$i]);
									mysqli_stmt_execute($pstmt);
								}
							}
							
							header("Location: index.php");							
						}
						
						mysqli_stmt_close($pstmt);
					}				
                ?>
                <form name="lista" id="lista" method="POST" action="index.php?acao=deletar">
                    <div id="saida"></div>
                    <table class="table table-hover table-responsive-sm" id="table_lista">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="mr-1" name="marcar_todos" id="marcar_todos">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">
                                    <a href="cadastro.php" class="float-right">
                                        <i class="far fa-plus-square">
                                            <span class="sr-only">(Cadastrar outro)</span>
                                        </i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($linhas = mysqli_fetch_array($q)):
                            ?>  	
                            <tr>
                                <td class="align-middle"><input type="checkbox"  name="ids[]" value="<?=$linhas["id"]?>"> <?="#".$linhas["id"]?></td>
                                <td class="align-middle"><?=$linhas["nome"]?></td>
                                <td class="align-middle" colspan="2">
                                    <?=$linhas["email"]?> 
                                    <ul class="list-inline-item float-right mb-0">
                                        <li class="list-inline-item">
                                            <a href="editar.php?id=<?=$linhas["id"]?>" title="Editar">
                                                <i class="far fa-edit">
                                                    <span class="sr-only">(Editar)</span>
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" onclick="return false" class="excluir-linha" title="Excluir">
                                                <i class="fas fa-trash-alt">
                                                    <span class="sr-only">(Excluir)</span>
                                                </i>
                                             </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <div class="btn-group float-right mt-2" role="group" aria-label="Controles">
                      <button type="submit" name="excluir" class="btn btn-danger btn-excluir px-4 py-2" onclick="return confirm('Deseja mesmo excluir?')" disabled="disabled">
                          <span class="btn-texto">
                              <i class="fas fa-trash-alt"><span class="sr-only">(Excluir)</span></i>
                              <span class="d-none d-sm-inline">Excluir</span>
                          </span>
                      </button>
                      <button type="reset" name="limpar" class="btn btn-default btn-limpar px-4 py-2">
                          <span class="btn-texto">
                              <i class="fas fa-eraser"><span class="sr-only">(Limpar o formulário)</span></i>
                              <span class="d-none d-sm-inline">Limpar</span>
                          </span>
                      </button>
                    </div>
                </form>
                <?php 
                }
                else
                {
                ?>
                    <p class="lead text-center">Nenhuma pessoa encontrada. Clique <a href="cadastro.php" class="btn btn-primary"><span class="btn-texto">aqui</span></a> para cadastrar.</p>
                <?php 
                }
                ?>
            </div>
        </div>
    </section>
<?php
$script = "
$('.excluir-linha').click(function(){
	$('input:checkbox').removeAttr('checked');
    $(this).closest('tr').find('[type=checkbox]').prop('checked', true);
	$('.btn-excluir').removeAttr('disabled');
	$('.btn-excluir').click();
});

$('#marcar_todos').click(function(e){
	var table = $(e.target).closest('table');
	$('td input:checkbox', table).prop('checked', this.checked);
});

$('input[type=checkbox]').click(function(){
	if($(this).is(':checked'))
	{
		$('.btn-excluir').removeAttr('disabled');
	}
	else
	{
		if(!$('input[type=checkbox]').is(':checked'))
		{
			$('.btn-excluir').attr('disabled', 'disabled');
		}
	}
});

$('.btn-limpar').click(function()
{
	$('.btn-excluir').attr('disabled', 'disabled');
});
";

include "rodape.php";
?>