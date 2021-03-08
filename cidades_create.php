<?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $cidade="";
        $numhabitantes="";
 
        if(isset($_POST['cidade'])){
            $cidade=$_POST['cidade'];
        }
        if(isset($_POST['numhabitantes'])){
            $numhabitantes=$_POST['numhabitantes'];
        }
            
        $con=new mysqli("localhost","root", "" ,"projetoredes");

        if($con->connect_errno!=0){
            echo "ocorreu um erro no acesso á base de dados.<br>". $con->connect_error;
            exit;
        }
        else{

            $sql='insert into cidades (cidade, numhabitantes) values (?,?)';
            $stm=$con->prepare($sql);
            if($stm!=false){

                $stm->bind_param('ss',$cidade,$numhabitantes);
                $stm->execute();
                $stm->close();

                echo '<script>alert("Cidade adicionada com sucesso");</script>';
                echo 'aguarde um momento. a reencaminhar pagina';
                header("refresh:5; url=cidades_index.php");
            }
            else{
                echo ($con->error);
                echo 'Aguarde um momento. A reencaminhar pagina';
                header("refresh:5; url=cidades_index.php");
            }

        }

    }
    else{

?>   
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="ISO-8859-1">
        <title>Adicionar Cidade</title>
    </head>
    <body style="background-color:lightgreen;color:green"> 
    <h1>Adicionar Cidade</h1>
    <form action="cidades_create.php" method="post">
    <label>Cidade</label><input type="text" name="cidade" required><br>
    <label>Número De Habitantes</label><input type="text" name="numhabitantes"><br>
    <input type="submit" name="enviar"><br>
    </form>
    </body>
    </html> 
<?php   
}
?>