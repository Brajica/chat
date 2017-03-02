<?php
 require 'conectar.php';
$clase=new consultarmsj();
$re=$clase->averiguar();
class consultarmsj
{

  function __construct()
  {
  $this->con=new Database();
  }
  public function averiguar()
  {
    session_start();
     $id=$_SESSION['id_cv'];
     $sesion=$_SESSION['email'];
     $sql=$this->con->prepare("SELECT * FROM conversacion WHERE  id_receptor=:receptor and
     estado_msj='nv' and estado_mu='nm' order by id desc");
     $sql->bindParam(":receptor",$sesion);
     $sql->execute();
     $c=$sql->rowCount();
     #aqui la otra conbsulta
     $sql2=$this->con->prepare("UPDATE conversacion set estado_mu='m' where id_receptor=:receptor");
     $sql2->bindParam(":receptor",$sesion);
     $sql2->execute();
     $con=0;
     if ($sql) {
       if ($c>0) {
          echo 1;
       }else{
         echo 0;
       }
     }else{
       echo $sesion;
     }
  }
}



 ?>
