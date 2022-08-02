<?php
    include("../cofig/_conexion.php");
    $response=new stdClass();

    $codped=$_POST['codped'];
    $sql="UPDATE pedido set  estado=3
    WHERE codped=$codped";
    $result=mysqli_query($con,$sql);
    if($result){
        $response->state=true;
    }else{
        $response->state=true;
        $response->datail="No se pudo actulizar el estado";
    }

    echo json_encode($response);