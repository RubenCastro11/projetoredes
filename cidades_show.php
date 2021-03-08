<?php
	if ($_SERVER['REQUEST_METHOD']=="GET"){

		if(!isset($_GET['cidade']) || !is_numeric($_GET['cidade'])) {
			echo '<script>alert("Erro ao abrir a cidade");</script>';
			echo 'Aguarde um momento. A recaminhar página';
			header("refresh:5; url=cidades_index.php");
			exit();
		}
		$idCidade=$_GET['cidade'];
		$con=new mysqli("localhost","root","","projetoredes");

		if($con->connect_errno!=0){
			echo 'Ocorreu um erro no acesso à base de dados.<br>'.$con->connect_error;
			exit;
		}
		else {
			$sql='select * from cidades where id=?';
			$stm=$con->prepare($sql);
			if ($stm!=false){
				$stm->bind_param('i',$idCidade);
				$stm->execute();
				$res=$stm->get_result();
				$cidades=$res->fetch_assoc();
				$stm->close( );
			}
			else{
				echo '<br>';
				echo ($con->error);
				echo '<br>';
				echo "Aguarde um momento.A reencaminhar página";
				echo '<br>';
				header("refresh:5;url=cidades_index.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Detalhes</title>
</head>
<body style="background-color:lightgreen;color:green"> 
<h1>Detalhes Da Cidade</h1>
<?php

if(isset($cidades)) {
	echo '<br>';
	echo "Cidade: ".$cidades['cidade'];
	echo '<br>';
	echo "Número De Habitantes: ".$cidades['numhabitantes'];
	echo '<br>';


}

else{
	echo '<h2>Parece que a cidade selecionado não existe.<br>Confirme a sua seleção.</h2>';

}
echo '<button> <a href="cidades_edit.php?cidade='.$cidades['id'].'">Editar</a></button>';
    echo "<br>";
    echo '<button> <a href="cidades_delete.php?cidade='.$cidades['id'].'">Eliminar</a></button>';
?>

</body>
</html>