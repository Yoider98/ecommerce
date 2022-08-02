<?php
    include("../cofig/_conexion.php");
    $response=new stdClass();

    //$response->state=true;
    $codigo=$_POST['codigo'];
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $precio=$_POST['precio'];
    $estado=$_POST['estado'];
    

    if ($nombre==""){
        $response->state=false;
        $response->detail="falta agregar el nombre"; 
    }else{
        if($descripcion==""){
            $response->state=false;
            $response->detail="falta agregar la descricion";
        }else{
            if(isset($_FILES['imagen'])){

                $nombre_imagen =date("YmdHis").".jpg";
                $sql="INSERT INTO producto(nompro,despro,prepro,estado,rutimapro)
                VALUES ('$nombre','$descripcion','$precio','$estado','$nombre_imagen')";
                $result=mysqli_query($con,$sql);
                if($result){
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../../ecommerce1/assets/".$nombre_imagen)){
                        $response->state=true;
                    }else{
                        $response->state=false;
                        $response->detail="error al cargar la imagen";
                    }
                }else{
                    $response->state=false;
                    $response->detail="error al cargar producto";
                }
            }else{
                $response->state=false;
                $response->detail="falta agregar la imagen";
            }
            
        }
    }

    echo json_encode($response);
