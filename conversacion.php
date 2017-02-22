<?php
session_start();
$bd="chat";
$server="localhost";
$user="root";
 $password="";
 $conexion=mysqli_connect($server,$user,$password,$bd);
 if (!$conexion) die("error conexion".mysqli_connect_error());
 $id=$_POST['id'];
 $sesion=$_SESSION['email'];
 $_SESSION['id_cv']=$id;
 $update="UPDATE conversacion set estado_msj='v', estado_mu='m' WHERE id_conversacion='$id' and id_receptor='$sesion' and estado_msj='nv'";
 $update=mysqli_query($conexion,$update);
 $sql="select * from conversacion WHERE id_conversacion='$id' order by id asc";
 $result=mysqli_query($conexion,$sql);
 while ($a = mysqli_fetch_assoc($result)) {
   echo '<p><b>'.$a['id_emisor'].'</b> Dice: '.$a['mensaje'].'</p>';
       if ($a['id_emisor']==$_SESSION['email']) {
         $_SESSION['idr']=$a['id_receptor'];
       }else{
         $_SESSION['idr']=$a['id_emisor'];
       }
 }
 ?>
