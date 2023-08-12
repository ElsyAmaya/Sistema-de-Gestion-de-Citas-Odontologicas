<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DentPro</title>
  <link rel="shortcut icon" href="../img/LogoDentProO.svg" type="image/x-icon">
  <meta name="description" content="DentPro">
  <meta name="author" content="Grupo#1">
  <meta name="keywords" content="html,DentPro">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

  <div id="mySidebar" class="sidebar">
    <li> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"> × </a></li>
    <li> <a href="main.php"><img src="../img/LogoDentProO.svg" alt="" class="small-img"></a></li>
    <li> <a class="over my-class" href="main.php"><img src="../img/home.svg" alt="">Inicio</a></li>
    <?php

  
  session_start();

  if (empty($_SESSION["username"]) || $_SESSION["username"] === ""){
    header("Location: login.php");
  }
    if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Recepcionista') {
    echo '
    <div class="over my-class">
      <li> <a href="pacientes.php"><img src="../img/paciente.svg" alt="">Pacientes</a>
    </div>';
  };
    if ($_SESSION['rol'] === 'Administrador') {
    echo '
    <div class="over my-class">
      <li> <a href="especialistas.php"><img src="../img/medico.svg" alt="">Especialistas</a></li>
    </div>';
  };
    if ($_SESSION['rol'] === 'Administrador') {
    echo '
    <div class="over my-class">
      <li> <a href="servicios.php"><img src="../img/dentista.svg" alt="">Servicios y tratamientos</a></li>
    </div>';
  };
    if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Recepcionista') {
    echo '
    <div class="over my-class">
      <li> <a href="citas.php"><img src="../img/cita.svg" alt="">Citas</a></li>
    </div>';
  };
    if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Especialista') {
    echo '
    <div class="over my-class">
      <li> <a href="#"><img src="../img/consulta.svg" alt="">Consultas</a></li>
    </div>';
  };
    if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Recepcionista') {
    echo '
    <div class="over my-class">
      <li> <a href="#"><img src="../img/factura.svg" alt="">Facturación</a></li>
    </div>';
  };

  if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Recepcionista') {
    echo '
    <div class="over my-class">
      <li><a href="#"><img src="../img/reportes.svg" alt="">Reportes</a>
        <ul class="ul1">
          <li><a href="reportecita.php">- Citas</a></li>
          <li><a href="">- Consultas</a></li>
          <li><a href="">- Facturación</a></li>
        </ul>
      </li>
    </div>';
  };
   

  if ($_SESSION['rol'] === 'Administrador'){
    echo ' <div class="over my-class">
    <li> <a href="#"><img src="../img/configuracion.svg" alt="">Configuración</a>
        <ul class="ul1">
          <li><a href="usuarios.php">- Usuarios</a></li>
          <li><a href="descuentos.php">- Descuentos</a></li>
          </ul>
          </li>
        </div>';
  };
?>
      
  </div>
  </ul>
  </div>
  <div id="main">
    <div style="background-color: #5CB9E8;">
      <div class="content-menu">
        <button class="openbtn" onclick="openNav()">☰</button>
        <div class="content-cerrar">
          <?php 
        echo '<div class="usuario">' . $_SESSION['username'] . '</div>' 
    ?>
          <a class="btn-cerrar" href="../crud/logout.php"><img src="../img/logout.svg" alt="" width="20%">Cerrar
            sesión</a>
        </div>
      </div>
    </div>


    <script src="../js/bootstrap.min.js"></script>

    <script>
      function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
      }

      function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
      }
    </script>

</body>

</html>