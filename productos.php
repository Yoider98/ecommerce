<?php
include("cofig/_conexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | Prodcutos</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <div class="modal" id="modal-producto" style="display: none;">
        <div class="body-modal">
            <button class="btn-close" onclick="hide_modal('modal-producto')"><i class="fa fa-times" aria-hiden="true"></i></button>
            <h3>Añadir producto</h3>
                <input type="text" id="codigo" style="display: none;">
                <div class="div-flex">
                    <label>Nombre:</label>
                    <input type="text" id="nombre">
                </div>
                <div class="div-flex">
                    <label>Descripción:</label>
                    <input type="text" id="descripcion">
                </div>
                <div class="div-flex">
                    <label>Precio:</label>
                    <input type="number" id="precio">
                </div>
                <div class="div-flex">
                    <label>Estado:</label>
                    <select id="estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="div-flex">
                
                <input type="file" id="imagen" />
                
                </div>
                <button onclick="save_producto()">Guardar</button>
        </div>
    </div>
    <div class="main-container">
        <?php
        include("layout/direcciones.php");
        ?>
        <div class="body-page">
            <h2>Mis productos</h2>
            <table class="mt10">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                        $sql="SELECT * from producto";
                        $resultado=mysqli_query($con,$sql);
                        while ($row=mysqli_fetch_array($resultado)) {
							echo 
					'<tr>
						<td>'.$row['codpro'].'</td>
						<td>'.$row['nompro'].'</td>
						<td>'.$row['despro'].'</td>
						<td>'.$row['prepro'].'</td>
						<td class="td-option">
							<div class="div-flex div-td-button">
								<button onclick="edit_product('.$row['codpro'].')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
								<button onclick="delete_product('.$row['codpro'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
							</div>
						</td>
					</tr>';
						}
					?>
                </tbody>
            </table>
            <button class="mt10" onclick="show_modal('modal-producto')">Agregar nuevo producto</button>
        </div>
    </div>
    <script type="text/javascript">
        function show_modal(id){
            document.getElementById(id).style.display="block";
        }
        function hide_modal(id){
            document.getElementById(id).style.display="none";
        }
        function save_producto(){
            var fd=new FormData();
            fd.append('codigo',document.getElementById('codigo').value);
            fd.append('nombre',document.getElementById('nombre').value);
            fd.append('descripcion',document.getElementById('descripcion').value);
            fd.append('precio',document.getElementById('precio').value);
            fd.append('estado',document.getElementById('estado').value);
            fd.append('imagen',document.getElementById('imagen').files[0]);    
            var request=new XMLHttpRequest();
            request.open('POST','api/producto-save.php',true);
            request.onload=function () {
                if(request.readyState==4 && request.status==200){
                    let response=JSON.parse(request.responseText);
                    console.log(request);
                    if(response.state){
                        alert("Correcto");
                    }else{
                        alert(response.detail);
                    }
                }
                
            }
            request.send(fd);
        }
    </script>
</body>
</html>
