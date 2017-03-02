<?php
require 'conectar.php';
$clase= new notificaciones();
$re=$clase->noticias();
/**
 *
 */
class notificaciones
{

  function __construct()
  {
    $this->con= new Database();
  }
  public function noticias()
  {
    session_start();

     $id=$_SESSION['email'];
     $sql=$this->con->prepare("select * from conversacion WHERE id_receptor='$id' and estado_msj='nv' ");
     $sql->bindParam(":id",$id);
     $sql->execute();
     $result=$sql->fetchAll();
     $me=0;
     $chat=0;
     $id=null;
     if ($sql){
    foreach ($result as $a) {
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
  }
}



 ?>
