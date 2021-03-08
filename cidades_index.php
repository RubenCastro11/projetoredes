<?php
    session_start();
$con=new mysqli("localhost", "root", "", "projetoredes");
if ($con->connect_errno!=0) {
echo "Ocorreu um erro no acesso à base de dados" .$con->connect_error;
exit;
}
else{
if(!isset($_SESSION['login'])){
$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"){
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cidades</title>
</head>
<body style="background-color:lightgreen;color:green"> 
<h1>Lista De Cidades</h1>
<?php
$stm=$con->prepare('select * from cidades');
$stm->execute();
$res=$stm->get_result();
while($resultado=$res->fetch_assoc()){
echo '<a href="cidades_show.php?cidade='.$resultado['id'].'">';
echo $resultado ['cidade'];
echo '</a>';
echo '<br>';
}
$stm->close();
?>
<br>
<button>
<a href="cidades_create.php">Adicionar cidade</a><br>
</button>
<br>
<button>
<a href="paises_create.php">Adicionar pais</a><br>
</button>
</body>
</html>

<?php
}
else{
echo'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
header('refresh:2;url=login.php');
}

}

?>