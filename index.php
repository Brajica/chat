<?php session_start();if (isset($_SESSION['email'])): ?>
   <?php header('location:inicio.php') ?>
<?php endif; ?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inicio sesion chat</title>
	</head>
	<body>
    <center><form style="width:30%"  action="login.php" method="post">
      <div class="row">
        <div class="span3">
          <div class="input-group">
           <span class="input-group-addon" id="basic-addon1">@</span>
           <input type="text" class="form-control" name="usuario" placeholder="Usuario" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
           <span class="input-group-addon" id="basic-addon1">P</span>
           <input type="password" class="form-control" name="pass" placeholder="Usuario" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
             <button type="submit" class="btn btn-primary">Entrar</button>
          </div>
        </div>
      </div>
    </form>
  </center>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<script src="jquery.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</body>
</html>
