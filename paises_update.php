<?php

$idPais=$_GET['pais'];
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $pais = "";
        $idioma="";
        $continente="";
        
        if(isset($_POST['pais'])){
            $pais = $_POST['pais'];
        }
        else{
            echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
        }

        if(isset($_POST['pais'])){
            $pais = $_POST['pais'];
        }

        if(isset($_POST['idioma'])){
            $idioma = $_POST['idioma'];
        }
         if(isset($_POST['continente'])){
            $continente = $_POST['continente'];
        }

        $con = new mysqli("localhost","root","","projetoredes");

        if($con->connect_errno!=0){
            echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
            exit;
        }
        else{
            $sql = "update paises set pais=?,idioma=?,continente=? where id=?";

            $stm=$con->prepare($sql);
            if($stm!=false){
                $stm->bind_param("sssi",$pais,$idioma,$continente,$idPais);
                $stm->execute();
                $stm->close();
                echo '<script>alert("Pais alterado com sucesso!!");</script>';
                echo "Aguarde um momento. A reencaminhar página";
                header("refresh:5; url=index.php");
            }
        }
    }
    else{
        echo "<h1> Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
        header("refresh:5; url=index.php");
    }