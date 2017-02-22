<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio Chat</title>
  </head>
  <body>
<a href="mensajes.php"><button class="btn btn-primary" type="button">
  Mensajes <span id="chat" class="badge"></span> <span id="men" class="badge"></span>
</button></a>
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
   <script src="jquery.js"></script>
   <script type="text/javascript">
   setInterval("alertmsg()",200)
         function alertmsg() {
            $.ajax({
              type:"POST",
              url:"alertmsg.php",
            }).done(function(info){
              cadena=info.split(",");
               $("#chat").html(cadena[1]);
               $("#men").html(cadena[0]);
            })
       }
   </script>
  </body>
</html>
