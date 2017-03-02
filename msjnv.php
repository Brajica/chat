<?php
require_once 'conectar.php';
$clase= new vermsj();
$re=$clase->verlos();
class vermsj
{

  function __construct()
  {
     $this->con = new Database();
  }
  public function verlos()
  {

      session_start();
      $id=$_SESSION['id_cv'];
        $sesion=$_SESSION['email'];

      $sql=$this->con->prepare("SELECT * FROM conversacion WHERE id_emisor=:emisor or id_receptor=:receptor
       order by id desc ");
       $sql->bindParam(":emisor",$sesion);
        $sql->bindParam(":receptor",$sesion);
        $sql->execute();
      $con=0;
      $result=$sql->fetchAll();
      $c=$sql->rowCount();
      $m=null;
      $ids = array();
      foreach ($result as $value  ) {
        if (isset($ids[$value['id_conversacion']])) {

        }else{
          $ids[$value['id_conversacion']]=array('estado_msj' =>$value['estado_msj'] ,"id"=>$value['id'], "id_receptor"=>$value['id_receptor'],"id_emisor"=>$value['id_emisor'],"id_conversacion"=>$value['id_conversacion']);
        }
      }

      if ($c>0) {
        foreach ($ids as $a) {
            if ($a['estado_msj']=='nv') {
              if ($a['id_emisor']==$_SESSION['email']) {
                 $m = '<a id="'.$a['id_conversacion'].'"  href="#" class="list-group-item" onclick="vermsj(this)">'.$a['id_receptor'].'</a>';
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
        echo $m;
    }
     }
  }
}


 ?>
