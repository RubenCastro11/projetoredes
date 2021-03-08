<?php
	if ($_SERVER['REQUEST_METHOD']=="GET"){

		if(!isset($_GET['pais']) || !is_numeric($_GET['pais'])) {
			echo '<script>alert("Erro ao abrir pais");</script>';
			echo 'Aguarde um momento. A recaminhar página';
			header("refresh:5; url=index.php");
			exit();
		}
		$idPais=$_GET['pais'];
		$con=new mysqli("localhost","root","","projetoredes");

		if($con->connect_errno!=0){
			echo 'Ocorreu um erro no acesso à base de dados.<br>'.$con->connect_error;
			exit;
		}
		else {
			$sql='select * from paises where id=?';
			$stm=$con->prepare($sql);
			if ($stm!=false){
				$stm->bind_param('i',$idPais);
				$stm->execute();
				$res=$stm->get_result();
				$paises=$res->fetch_assoc();
				$stm->close( );
			}
			else{
				echo '<br>';
				echo ($con->error);
				echo '<br>';
				echo "Aguarde um momento.A reencaminhar página";
				echo '<br>';
				header("refresh:5;url=index.php");
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
<body style="background-color:lightblue;color:blue">
<h1>Detalhes do pais</h1>
<?php

if(isset($paises)) {
	echo '<br>';
	echo "Paises: ". $paises['pais'];
	echo '<br>';
	echo "Idioma: ". $paises['idioma'];
	echo '<br>';
	echo "Continente: ". $paises['continente'];
	echo '<br>';


}

else{
	echo '<h2>Parece que o pais selecionado não existe.<br>Confirme a sua seleção.</h2>';

}

echo '<button> <a href="paises_edit.php?pais='.$paises['id'].'">Editar</a></button>'; 
    echo "<br>";
    echo '<button> <a href="paises_delete.php?pais='.$paises['id'].'">Eliminar</a></button>';
     echo "<br>";

?>

</body>
</html>