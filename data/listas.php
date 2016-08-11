<?php
//header("Content-type:application/json"); 
require_once('connect.php');

$request = $_SERVER['REQUEST_METHOD'];

if ($request == 'GET')
{
	$sql = "select l.cd_lista, l.nm_lista, count(p.cd_produto) 
			  qt_itens, sum(p.qt_produto * p.vl_produto) vl_total
			from lista l
			left join produto p on l.cd_lista = p.cd_lista
			group by l.cd_lista
			order by l.nm_lista";

	$res = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($res))
	{
		$itens[] = array('codigo' => $row['cd_lista'], 
						'nome'  => utf8_encode($row['nm_lista']), 
						'qtde'  => $row['qt_itens'],
						'total' => ($row['vl_total']=='')?0:$row['vl_total']);
	}

	echo $json = json_encode($itens,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);

}

if ($request == 'POST')
{
	$nm_lista = addslashes(utf8_decode(file_get_contents('php://input')));
	
	$sql = "insert into lista (nm_lista, dt_cadastro) values ('$nm_lista',now())";
	mysqli_query($conn,$sql);
	
	echo mysqli_insert_id($conn);
	
}

if ($request == 'DELETE')
{
	echo $cd_lista = (int)$_GET['id'];
	
	echo $sql = "delete from lista where cd_lista = $cd_lista"; //ps: itens cascade
	mysqli_query($conn, $sql);
	
}

?>