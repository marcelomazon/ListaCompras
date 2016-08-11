<?php
header("Content-type:application/json"); 
require_once('connect.php');

$request = $_SERVER['REQUEST_METHOD'];

if ($request == 'GET')
{
	if (isset($_GET['lista']))
		$add_sql = "and cd_lista = " . (int)$_GET['lista'];
	else
		$add_sql = "";

	$sql = "select cd_lista, cd_produto, nm_produto, qt_produto, vl_produto, id_cesta 
			from produto
			where 1 $add_sql
			order by nm_produto";
	$res = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($res))
	{
		$itens[] = array('lista'=>$row['cd_lista'], 
						'codigo' => $row['cd_produto'], 
						'nome' => utf8_encode($row['nm_produto']), 
						'qtde' =>$row['qt_produto'], 
						'valor' => $row['vl_produto'],
						'cesta' => $row['id_cesta']);
	}

	echo $json = json_encode($itens,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
}

if ($request == 'POST')
{
	//$json='[{"lista":1,"codigo":2,"nome":"Carne","qtde":5,"valor":29.55,"$$hashKey":"object:20"},{"lista":1,"codigo":3,"nome":"Carvão","qtde":6,"valor":8.35,"$$hashKey":"object:21"},{"lista":1,"codigo":4,"nome":"Chá","qtde":7,"valor":3.6,"$$hashKey":"object:22"},{"lista":"1","codigo":0,"nome":"Pão dágua","qtde":5,"valor":1.3,"cesta":false,"$$hashKey":"object:36"}]';

	$json = file_get_contents('php://input');	
	$dados = json_decode($json);
	
	//print_r($dados);

	$i=0;

	if (is_array($dados))
	{
		mysqli_query($conn,'delete from produto where cd_lista = '.(int)$dados[0]->lista);
		
		foreach ($dados as $k => $rec)
		{
			if ($rec->valor > 0 && $rec->nome != '')
			{
				++$i;
				$sql = 'insert into produto (cd_lista, nm_produto, qt_produto, vl_produto, id_cesta)
						values ('.(int)$rec->lista .',"'. addslashes(utf8_decode($rec->nome)) .'",'. $rec->qtde .','. $rec->valor.','.$rec->cesta.')'."\n";
				mysqli_query($conn,$sql);
			}
		}
	}
	
	echo $i;
	
}
?>