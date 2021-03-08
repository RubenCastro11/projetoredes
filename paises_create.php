<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {
	$pais="";
	$idioma="";
	$continente="";


	if(isset($_POST['pais'])){
		$pais=$_POST['pais'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome do pais.");</script>';
	}
	if (isset($_POST['idioma'])) {
		$idioma=$_POST['idioma'];	
	}
	 if(isset($_POST['continente'])){
            $continente = $_POST['continente'];
    }
	$con=new mysqli("localhost","root","","projetoredes");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso à base de dados.<br>". $con->connect_error;
		exit;
	}
	else{
		$sql='insert into paises(pais,idioma,continente) values(?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false){
			$stm->bind_param("sss",$pais,$idioma,$continente);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Pais adicionado com sucesso");<script>';
			echo 'Aguarde um momento.A reencaminhar página';
			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index.php");
		}
	}
}
else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Adicionar Pais</title>
</head>
<body style="background-color:lightblue;color:blue"> 
<h1></h1>
<form action="paises_create.php" method="post">
<label>Pais</label><input type="text" name="pais" required><br>
<label>Idioma</label><input type="text" name="idioma"><br>
<label>Continente</label><input type="text" name="continente"><br>
<input type="submit" name="enviar"><br>
</form>
</body>
</html>

<?php
}
?>