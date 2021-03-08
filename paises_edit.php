<?php
if($_SERVER['REQUEST_METHOD']=="GET"){

    if(isset($_GET['pais']) && is_numeric($_GET['pais'])){
        $idPais = $_GET['pais'];
        $con = new mysqli("localhost","root","","projetoredes");

        if($con->connect_errno!=0){
            echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error."</h1>";
            exit();
        }
        $sql = "Select * from paises where id=?";
        $stm = $con->prepare($sql);

        if($stm!=false){
            $stm->bind_param("i",$idPais);
            $stm->execute();
            $res=$stm->get_result();
            $paises = $res->fetch_assoc();
            $stm->close();
        }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <tile></title>
</head>
<body style="background-color:lightblue;color:blue">
    <h1>Editar Pais</h1>
    <form action="paises_update.php?pais=<?php echo $paises['id']; ?>" method="post">
        <label>Pais</label><input type="text" name="pais" required value="<?php echo $paises['pais'];?>"><br>
        <label>Idioma</label><input type="text" name="idioma" required value="<?php echo $paises['idioma'];?>"><br>
        <label>Continente</label><input type="text" name="continente" required value="<?php echo $paises['continente'];?>"><br>
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