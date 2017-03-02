<?php
require_once 'conectar.php';

$id=$_POST['id'];
$clase=new conversacion();
$re=$clase->mostrar($id);
/**
 *
 */
class conversacion
{

  function __construct()
  {
    $this->con=new Database();
  }
  public function mostrar($id)
  {
    session_start();
    $sesion=$_SESSION['email'];
    $_SESSION['id_cv']=$id;
    $update=$this->con->prepare("UPDATE conversacion set estado_msj='v', estado_mu='m' WHERE id_conversacion=:id and id_receptor=:receptor and estado_msj='nv'");
    $update->bindParam(":id",$id);
    $update->bindParam(":receptor",$sesion);
    $update->execute();
    $sql=$this->con->prepare("SELECT * from conversacion WHERE id_conversacion=:id order by id asc");
    $sql->bindParam(":id",$id);
    $sql->execute();
    $result=$sql->fetchAll();
    foreach ( $result as $a) {
      echo '<p><b>'.$a['id_emisor'].'</b> Dice: '.$a['mensaje'].'</p>';
          if ($a['id_emisor']==$_SESSION['email']) {
            $_SESSION['idr']=$a['id_receptor'];
          }else{
            $_SESSION['idr']=$a['id_emisor'];
          }
    }
  }
}



 ?>
