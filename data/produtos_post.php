<?php
header("Content-type:application/json"); 
require_once('connect.php');

$json='[{"lista":1,"codigo":2,"nome":"Carne","qtde":5,"valor":29.55,"$$hashKey":"object:20"},{"lista":1,"codigo":3,"nome":"Carvão","qtde":6,"valor":8.35,"$$hashKey":"object:21"},{"lista":1,"codigo":4,"nome":"Chá","qtde":7,"valor":3.6,"$$hashKey":"object:22"},{"lista":"1","codigo":0,"nome":"Pão dágua","qtde":5,"valor":1.3,"cesta":false,"$$hashKey":"object:36"}]';

//$decode = json_decode(file_get_contents('php://input'), true);

$dados = json_decode($json);
$i=0;

if (is_array($dados))
{
	mysqli_query($conn,'delete from produto where cd_lista = '.(int)$dados[0]->lista);
	
	foreach ($dados as $k => $rec)
	{
		++$i;
		$sql = 'insert into produto (cd_lista,nm_produto,qt_produto,vl_produto) values ('.(int)$rec->lista .',"'. addslashes(utf8_decode($rec->nome)) .'",'. $rec->qtde .','. $rec->valor.')'."\n";
		mysqli_query($conn,$sql);
	}
}


?>