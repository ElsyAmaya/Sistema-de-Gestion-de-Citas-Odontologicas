<!DOCTYPE html>

<html lang="en">

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
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        
</head>

<body class="bodylog">

  <div class="contenedor-login">

    <table id="login">
      <tr>
        <td class="login-td">
         <h2>BIENVENIDOS A</h2>
          <img src="../img/LogoDentProO.svg" alt="Logo-DentPro" class="logo-login">
          <p>
         <h4>
           INICIO DE SESIÓN</h4>
          </p>

          <form id="accesspanel" action="main.php" method="POST">

            <div>
              <p>
                <input type="text" class="input" name="user" id="user" placeholder="Nombre Usuario">
              </p>
              <p>
                <input type="password" class="input" name="pass" id="pass" placeholder="Contraseña">
              </p>
              <p>
                <input type="submit" class="btn-ingresar" name="go" id="go" value="INGRESAR">
              </p>
            </div>
          </form>
        </td>
        <td>
          <img src="../img/portada1.jpg" alt="img-portada1" class="img">
        </td>
      </tr>
    </table>

  </div>
 
  <?php    
   /*   
   if(isset($_POST['go'])){
    include('../conexion.php');  
    session_start();
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conexion, $username);  
        $password = mysqli_real_escape_string($conexion, $password);  
      
        $sql = "select * from usuarios where nombre_usu = '$username' and contra_usu = '$password' and estado_usu = 'Activo' ";  
        $result = mysqli_query($conexion, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  

            $_SESSION['username'] = $row['nombre_usu'];
            $_SESSION['rol'] = $row['rol_usu'];
            echo '<script type="text/javascript">
            window.location.href="menu.php";
          
            </script>';
        }  
        else{  
    
        echo'<script type="text/javascript">
    alert("ERROR DE INICIO DE SESIÓN\nUsuario o contraseña invalido\nSu usuario puede estar inactivo");
    window.location.href="login.php";
  
    </script>';
            
        }  }  */
?>  


</body>

</html>
