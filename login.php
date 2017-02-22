<?php
$bd="chat";
$server="localhost";
$user="root";
 $password="";
 $conexion=mysqli_connect($server,$user,$password,$bd);
   $usuario=$_POST['usuario'];
   $password=$_POST['pass'];
   $sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$password'";
   $result=mysqli_query($conexion,$sql);
   $booleano=mysqli_num_rows($result);
   if ($result) {
     if ($booleano>0) {
       session_start();
       $_SESSION['email']=$usuario;
       header('location:inicio.php');
     }else {
       $_GET['error']=1;
       $usuario=trim($usuario);
       header('location:index.php?'.$usuario.'');
     }
   }else {
     header('location:index.php?2');
   }

 ?>
