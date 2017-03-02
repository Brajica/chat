<?php
$mensaje=$_POST['mensaje'];
require_once 'conectar.php';
$clase=new conversacion();
$re=$clase->insertar($mensaje);
/**
 *
 */
class conversacion
{

  function __construct()
  {
    $this->con=new Database();
  }
  public function insertar($m)
  {
    session_start();

      $sesion_ini=$_SESSION['email'];
      $receptor=$_SESSION['idr'];
      $sql=$this->con->prepare("SELECT * FROM id_conversacion WHERE (id_e='$sesion_ini' and id_r='$receptor')  or (id_e='$sesion_ini' and id_r='$receptor')");
      $sql->bindParam(":receptor",$receptor);
      $sql->bindParam(":emisor",$sesion_ini);
      $sql->execute();
      $con=$sql->rowCount();

      if ($con==0) {
        $sql2=$this->con->prepare("INSERT INTO id_conversacion (id_e,id_r)
         VALUES(:emisor,:receptor)");
         $sql2->bindParam(":receptor",$receptor);
         $sql2->bindParam(":emisor",$sesion_ini);
         $sql2->execute();
      }
      $id_cv=$_SESSION['id_cv'];
      $sql3=$this->con->prepare("INSERT INTO conversacion (id_conversacion,id_emisor,id_receptor,mensaje) Values(:id_cv,:emisor,:receptor,:mensaje)");
      $sql3->bindParam(":receptor",$receptor);
      $sql3->bindParam(":emisor",$sesion_ini);
      $sql3->bindParam(":mensaje",$m);
      $sql3->bindParam(":id_cv",$id_cv);
      $sql3->execute();
       
  }
}


  ?>
