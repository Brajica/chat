<?php
  session_start();
  $bd="chat";
  $server="localhost";
  $user="root";
   $password="";
   $conexion=mysqli_connect($server,$user,$password,$bd);
   if (!$conexion) die("error conexion".mysqli_connect_error());
   $id=$_SESSION['id_cv'];
   $sesion=$_SESSION['email'];
   $sql="SELECT * FROM conversacion WHERE  id_receptor='$sesion' and
   estado_msj='nv' and estado_mu='nm' order by id desc";
   $sql2="UPDATE conversacion set estado_mu='m' where id_receptor='$sesion'";
   $update=mysqli_query($conexion,$sql2);
   $con=0;
   $result=mysqli_query($conexion,$sql);
   if ($result) {
     $c=mysqli_num_rows($result);
     if ($c>0) {
        echo 1;
     }else{
       echo 0;
     }
   }else{
     echo $sesion;
   }

 ?>
