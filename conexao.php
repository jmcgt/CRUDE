<?php
$con = mysqli_connect("localhost", "root", "", "crude");
mysqli_set_charset($con, 'utf8mb4');

if(mysqli_connect_errno())
{
	echo "Pedimos desculpas. N&atilde;o estamos conseguindo conectar ao Banco de Dados, erro #".mysqli_connect_errno()." - \"".mysqli_connect_error."\"";
}

$pstmt = mysqli_stmt_init($con);

function codificaURL($str)
{
	$str=kill_injection($str);
	return $url=strtr(base64_encode(addslashes($str)), '+/=', '-_,');
}

function decodificaURL($url)
{
	$url=kill_injection($url);
	return $str=stripslashes(base64_decode(strtr($url, '-_,', '+/=')));
}
?>