<?php

$idCidade=$_GET['cidade'];
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $cidade = "";
        $numhabitantes="";


        if(isset($_POST['cidade'])){
            $cidade = $_POST['cidade'];
        }
        else{
            echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
        }

        if(isset($_POST['cidade'])){
            $cidade = $_POST['cidade'];
        }

        if(isset($_POST['numhabitantes'])){
            $numhabitantes = $_POST['numhabitantes'];
        }

        $con = new mysqli("localhost","root","","projetoredes");

        if($con->connect_errno!=0){
            echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
            exit;
        }
        else{
            $sql = "update cidades set cidade=?,numhabitantes=? where id=?";

            $stm=$con->prepare($sql);
            if($stm!=false){
                $stm->bind_param("sii",$cidade,$numhabitantes,$idCidade);
                $stm->execute();
                $stm->close();
                echo '<script>alert("Cidade alterada com sucesso!!");</script>';
                echo "Aguarde um momento. A reencaminhar página";
                header("refresh:5; url=cidades_index.php");
            }
        }
    }
    else{
        echo "<h1> Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
        header("refresh:5; url=cidades_index.php");
    }