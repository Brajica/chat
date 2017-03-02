<?php
//conectamos la base de datos
class Database extends PDO
{
  //nombre base de datos
private $dbname = "chat";
//nombre servidor
private $host = "localhost";
//nombre usuarios base de datos
private $user = "root";
//password usuario
private $pass = "";
//puerto postgreSql
private $port = 1024;
private $con;
  public function __construct()
  {
    try {
    	    //conectar con Postgres
	        //$this->con = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
	        //conectar con mysql
           $host = 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8';
           $op = array(
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
           );
           $this->con = parent::__construct($host, $this->user, $this->pass, $op);

	    } catch(PDOException $e) {

	        echo  $e->getMessage();

	    }
}
}
 ?>
