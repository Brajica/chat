<?php

 require_once 'conectar.php';

 class msj
 {

   function __construct()
   {
      $this->con = new Database();
   }
   public function leer()
   {
     session_start();
      $sesion=$_SESSION['email'];
       $sql=$this->con->prepare("SELECT * FROM conversacion WHERE id_emisor=:emisor or id_receptor=:receptor
       order by id desc ");
       $sql->bindParam(":emisor",$sesion);
       $sql->bindParam(":receptor",$sesion);
       $sql->execute();
       $c=$sql->rowCount();
       $result=$sql->fetchAll();
       return array ($result, $c);
   }
 }

$clase=new msj();
$result=$clase->leer();
$c=$result[1];
$ids = array();
 ?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Mensajes</title>
	</head>
	<body>
		<div class="row">
       <section style="margin-top:6%;">
         <div class="col-md-3">
           <ul id="listas" class="list-group">
             <?php
             foreach ($result[0] as $value  ) {
               if (isset($ids[$value['id_conversacion']])) {

               }else{
                 $ids[$value['id_conversacion']]=array('estado_msj' =>$value['estado_msj'] ,"id"=>$value['id'], "id_receptor"=>$value['id_receptor'],"id_emisor"=>$value['id_emisor'],"id_conversacion"=>$value['id_conversacion']);
               }

             }
             if ($result[1]>0) {

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
               print_r($m);
           }
            }else {
           echo "no tiene mensajes";
         }
             ?>
          </ul>
     </div>
     <div class="col-md-9">
       <div  class="container-fluid">
          <div class="row">
            <h1 class="text-center"> <small>HAYVIAJE</small></h1>
            <hr>
          </div>
          <div class="row">
            <form id="fchat" role="form">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-10" >
                    <div id="conversation" style="height:200px; border: 1px solid #CCCCCC;  border-radius: 5px; overflow-x: hidden;">
                    </div>
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea id="mensaje" name="mensaje" placeholder="Enter Message"  class="form-control" rows="3" onkeyup="enter(event)"></textarea>
                    </div>
                    <button id="enviar" onclick="registrarmsg()" class="btn btn-primary" >Send</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
      </div>
     </div>
       </section>
		</div>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<script src="jquery.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function enter(e) {
    var evt = e ? e : event;
    var key = window.Event ? evt.which : evt.keyCode;
         if (key==13) {

          registrarmsg();
         }
    }
		c=false;
		id=null;
      $(document).on("ready", function(){
         registrarmsg();
        $.ajaxSetup({"cache":false})
				setInterval("veri()",150)
        setInterval("msjnv()",150)
      })
      function registrarmsg() {
        a=$("#mensaje").val()
        if (a.length==0) {

        }else{

          var frm=$("#fchat").serialize();
            $("#mensaje").val('')
          $.ajax({
            type:"POST",
            url:"registrar.php",
            data:frm
          }).done(function(info){
              var altura=  $("#conversation").prop("scrollHeight")
              $("#conversation").scrollTop(altura);

              
          })
        }
      }


			veri=function () {
        if (c==true) {
            cargarmsg(id);
        }
			}
    function cargarmsg (idd) {
        $.ajax({
          type:"post",
          url:"conversacion.php",
					data:{
						id:idd
					}
        }).done(function (info) {
             $("#conversation").html(info);
             $("#conversation p:last-child").css({"background-color":"#e45",
                                                  "padding-boton":"20px"});
            var altura=  $("#conversation").prop("scrollHeight")
              $("#conversation").scrollTop(altura);
        })
      }
			vermsj=function(idd) {
            c=true;
						id=idd.id;
            $("#"+id).css("background-color","#fff")
      cargarmsg(id)
			}
      msjnv=function () {
        $.ajax({
          type:"post",
          url:"consultar.php",
        }).done(function (info) {//respuesta de la primera

          if (info==1) {
            $.ajax({
              type:"post",
              url:"msjnv.php",
              }).done(function (info) {


                 $("#listas").html(info)
              })//aqui termin la respuesta d ela segunda
          }
        })//aqui termin la respuesta d ela prmiera
      }
    </script>
	</body>
</html>
