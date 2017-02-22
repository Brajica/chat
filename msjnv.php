<?php
session_start();
 $bd="chat";
 $server="localhost";
 $user="root";
  $password="";
  $conexion=mysqli_connect($server,$user,$password,$bd);
  $id=$_SESSION['id_cv'];
    $sesion=$_SESSION['email'];
  if (!$conexion) die("error conexion".mysqli_connect_error());
  $sql="SELECT * FROM conversacion WHERE id_emisor='$sesion' or id_receptor='$sesion'
   order by id desc ";
  $con=0;
  $result=mysqli_query($conexion,$sql);
  $c=mysqli_num_rows($result);
  $m=null;
  $ids = array();
  foreach ($result as $value  ) {
    if (isset($ids[$value['id_conversacion']])) {

    }else{
      $ids[$value['id_conversacion']]=array('estado_msj' =>$value['estado_msj'] ,"id"=>$value['id'], "id_receptor"=>$value['id_receptor'],"id_emisor"=>$value['id_emisor'],"id_conversacion"=>$value['id_conversacion']);
    }
  }

  $con=0;
  if ($c>0) {
    foreach ($ids as $a) {

        if ($a['estado_msj']=='nv') {
          if ($a['id_emisor']==$_SESSION['email']) {
             $m = '<a id="'.$a['id_conversacion'].'" style="background-color:#090" href="#" class="list-group-item" onclick="vermsj(this)">'.$a['id_receptor'].'</a>';
          }elseif ($a['id_receptor']==$_SESSION['email']) {
              $m = '<a id="'.$a['id_conversacion'].'" style="background-color:#090" href="#" class="list-group-item" onclick="vermsj(this)">'.$a['id_emisor'].'</a>';
          }
        }else{
          if ($a['id_emisor']==$_SESSION['email']) {
             $m = '<a id="'.$a['id_conversacion'].'"  href="#" class="list-group-item" onclick="vermsj(this)">'.$a['id_receptor'].'</a>';
          }elseif ($a['id_receptor']==$_SESSION['email']) {
              $m = '<a id="'.$a['id_conversacion'].'"  href="#" class="list-group-item" onclick="vermsj(this)">'.$a['id_emisor'].'</a>';
          }
        }
    print_r($m);
}
 }
 ?>
