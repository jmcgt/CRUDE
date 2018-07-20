<?php 
include "bom_finder.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="João Marcos Casa Grande Terêncio">
<title><?=@$titulo?></title>
<link rel="icon" href="favicon.png" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Playfair+Display:400,700" rel="stylesheet">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.12/css/all.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-md navbar-dark bg-secondary py-2 box-shadow">
  <div class="container">
      <a href="index.php" class="navbar-brand">
        <h1 class="h3 mb-0">CRUDE</h1>
      </a>  
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="index.php">
                  Home <i class="fas fa-home"></i>
              </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pessoas</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="index.php">Visualizar</a>
              <a class="dropdown-item" href="cadastro.php">Cadastrar</a>
              <a class="dropdown-item" href="index.php">Alterar/Excluir</a>
            </div>
          </li>
        </ul>
      </div>
	</div>
</nav>