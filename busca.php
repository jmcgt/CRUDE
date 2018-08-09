<?php 
include "conexao.php";

$saida = '';

if(isset($_POST["searchVal"]) && !empty($_POST["searchVal"]))
{
    $searchq = $_POST["searchVal"];
    
    $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
    
    $q = mysqli_query($con, "select * from v_ps where nome LIKE '%$searchq%' or email like '%$searchq%' ORDER BY nome ASC") or die ("Erro, não foi possível pesquisar o termo");
    
    $num = mysqli_num_rows($q);
    
    if($num == 0)
    {
        $saida = "Pessoa não encontrada";
    }
    else
    {
        $saida = "
        <table class='table table-hover table-responsive-sm'>
            <thead>
                <tr>
                    <th scope='col'><input type='checkbox' class='mr-1' name='marcar_todos' id='marcar_todos'>ID</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>
                        <a href='cadastro.php' class='float-right'>
                            <i class='far fa-plus-square'>
                                <span class='sr-only'>(Cadastrar outro)</span>
                            </i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>";
        
        while($linhas = mysqli_fetch_array($q))
        {
            $saida .= "
            <tr>
                <td class='align-middle'><input type='checkbox'  name='ids[]' value='".$linhas["id"]."'> #".$linhas["id"]."</td>
                <td class='align-middle'>".$linhas["nome"]."</td>
                <td class='align-middle' colspan='2'>
                    ".$linhas["email"]." 
                    <ul class='list-inline-item float-right mb-0'>
                        <li class='list-inline-item'>
                            <a href='editar.php?id=".$linhas["id"]."' title='Editar'>
                                <i class='far fa-edit'>
                                    <span class='sr-only'>(Editar)</span>
                                </i>
                            </a>
                        </li>
                        <li class='list-inline-item'>
                            <a href='#' onclick='return false' class='excluir-linha' title='Excluir'>
                                <i class='fas fa-trash-alt'>
                                    <span class='sr-only'>(Excluir)</span>
                                </i>
                             </a>
                        </li>
                    </ul>
                </td>
            </tr>";
        }
        
        $saida .= "
            </tbody>
        </table>";
    }
}


echo $saida;
?>