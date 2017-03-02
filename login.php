<?php
$usuario=$_POST['usuario'];
$password=$_POST['pass'];
require_once 'conectar.php';
$clase=new login();
$login=$clase->entrar($usuario,$password);

class login
{

  function __construct()
  {
     $this->con = new Database();
  }
  public function entrar($u,$p)
  {
    $sql=$this->con->prepare("SELECT * FROM usuarios WHERE usuario=:usu AND pass=:p");
    $sql->bindParam(":usu",$u);
    $sql->bindParam(":p",$p);
    $sql->execute();
    $booleano=$sql->rowCount();
    if ($sql) {
      if ($booleano>0) {
        session_start();
        $_SESSION['email']=$u;
        header('location:inicio.php?'.$u.'');
      }else {
        $_GET['error']=1;
        $usuario=trim($usuario);
        header('location:index.php');
      }
    }else {
      header('location:index.php?2');
    }
  }
}



 ?>
