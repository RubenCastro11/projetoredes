<?php
if($_SERVER['REQUEST_METHOD']=="GET"){

    if(isset($_GET['cidade']) && is_numeric($_GET['cidade'])){
        $idCidade = $_GET['cidade'];
        $con = new mysqli("localhost","root","","projetoredes");

        if($con->connect_errno!=0){
            echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error."</h1>";
            exit();
        }
        $sql = "Select * from cidades where id=?";
        $stm = $con->prepare($sql);

        if($stm!=false){
            $stm->bind_param("i",$idCidade);
            $stm->execute();
            $res=$stm->get_result();
            $cidades = $res->fetch_assoc();
            $stm->close();
        }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <tile></title>
</head>
<body style="background-color:lightgreen;color:green">
    <h1>Editar Cidade</h1>
    <form action="cidades_update.php?cidade=<?php echo $cidades['id']; ?>" method="post">
        <label>Cidade</label><input type="text" name="cidade" required value="<?php echo $cidades['cidade'];?>"><br>
        <label>Número De Habitantes</label><input type="numeric" name="numhabitantes" required value="<?php echo $cidades['numhabitantes'];?>"><br>
        <input type="submit" name="enviar">
    </form>
</body>
<?php
 }
 else{
     echo ("<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>");
     header("refresh:5; url=index.php");
 }
}
?>