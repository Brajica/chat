<?php
session_start();
 $bd="chat";
 $server="localhost";
 $user="root";
  $password="";
  $conexion=@mysqli_connect($server,$user,$password,$bd);
  if (!$conexion) die("error conexion".mysqli_connect_error());
  $mensaje=$_POST['mensaje'];
  $sesion_ini=$_SESSION['email'];
  $receptor=$_SESSION['idr'];
  $sql="SELECT * FROM id_conversacion WHERE (id_e='$sesion_ini' and id_r='$receptor')  or (id_e='$sesion_ini' and id_r='$receptor')";
  $resultado=mysqli_query($conexion,$sql);
  $con=mysqli_num_rows($resultado);
  if ($con==0) {
    $sql="INSERT INTO id_conversacion (id_e,id_r)
     VALUES('$sesion_ini','$receptor')";
  }
  $id_cv=$_SESSION['id_cv'];
  $sql="INSERT INTO conversacion (id_conversacion,id_emisor,id_receptor,mensaje) Values('$id_cv','$sesion_ini','$receptor','$mensaje')";
   $result=mysqli_query($conexion,$sql);
   if ($result) {
     echo "Mensaje Registrado";
   }else {
     print_r ($id_cv." ".$sesion_ini." ".$receptor." ".$mensaje);
   }
  ?>
