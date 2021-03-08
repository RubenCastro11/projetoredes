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
<title>Países</title>
</head>
<body style="background-color:lightblue;color:blue">
<h1>Lista De Países</h1>
<?php
$stm=$con->prepare('select * from paises');
$stm->execute();
$res=$stm->get_result();
while($resultado=$res->fetch_assoc()){
echo '<a href="paises_show.php?pais='.$resultado['id'].'">';
echo $resultado ['pais'];
echo '</a>';
echo '<br>';
}
$stm->close();
?>
<br>
<button>
<a href="paises_create.php">Adicionar pais</a><br>
</button>
<br>
<button>
<a href="cidades_create.php">Adicionar cidade</a><br>
</button>
<br>
<button>
<a href="cidades_index.php">Lista De Cidades</a><br>
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

