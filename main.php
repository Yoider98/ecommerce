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
            <h2>Inicio / Pendiente de despacho</h2>
            <table class="mt10">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                        $sql="SELECT ped.*,usu.*,pro.*,
                        CASE WHEN ped.estado=2 THEN 'Pendiente'ELSE 'Entregado'END estadotexto
                        from pedido ped
                        inner join usuario usu
                        on ped.codusu=usu.codusu
                        inner join producto pro
                        on ped.codpro=pro.codpro
                        where ped.estado=2";
                        $resultado=mysqli_query($con,$sql);
                        while ($row=mysqli_fetch_array($resultado)) {
							echo 
					'<tr>
						<td>'.$row['codped'].'</td>
						<td>'.$row['nomusu'].'</td>
						<td>'.$row['nompro'].'</td>
						<td>'.$row['fecped'].'</td>
						<td>'.$row['estadotexto'].'</td>
						<td>'.$row['dirusuped'].'</td>
						<td>'.$row['telusuped'].'</td>
						<td class="td-option">
                        <button onclick="despachado('.$row['codped'].')">Despachado</button>  
						</td>
					</tr>';
						}
					?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function show_modal(id){
            document.getElementById(id).style.display="block";
        }
        function hide_modal(id){
            document.getElementById(id).style.display="none";
        }
        function despachado(codped){
            var fd=new FormData();
            fd.append('codped',codped); 
            var request=new XMLHttpRequest();
            request.open('POST','api/pedido-confirm.php',true);
            request.onload=function () {
                if(request.readyState==4 && request.status==200){
                    let response=JSON.parse(request.responseText);
                    console.log(request);
                    if(response.state){
                        window.location.reload();
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

