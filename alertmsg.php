<?php
  session_start();
  $bd="chat";
  $server="localhost";
  $user="root";
   $password="";
   $conexion=mysqli_connect($server,$user,$password,$bd);
   if (!$conexion) die("error conexion".mysqli_connect_error());
   $id=$_SESSION['email'];
   $sql="select * from conversacion WHERE id_receptor='$id' and estado_msj='nv'  ";
   $result=mysqli_query($conexion,$sql);
   $me=0;
   $chat=0;
   $id=null;
   if ($result){
  while ($a = mysqli_fetch_assoc($result)) {
    if ($me>0) {
      if ($a['id_conversacion']==$id) {

      }else{
        $chat=$chat+1;
      }
    }else{
      $chat=$chat+1;
    }
       $me=$me+1;
       $id=$a['id_conversacion'];
     }

     echo $me.",".$chat;
   }

 ?>
