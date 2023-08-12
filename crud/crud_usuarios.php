<?php
require_once 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == 'insertar') {
            $user = $_POST['user'];
            $password = md5($_POST['txtpassword']); 
            $confirmpass =md5($_POST['confirmPassword']);
            $rol = $_POST['rol'];
            if($rol=='Especialista'){
            $estado = 'Disponible';
            }else{
                $estado = 'Activo';

            }
            
            $datos_usuario = array(
                'usuario' => $user,
                'password' => $password,
                'rol' => $rol,
                'estado'  => $estado,
            );
            if($password==$confirmpass){
            if (crearRegistro('tb_usuarios', $datos_usuario)) {
                header('Location: ../pages/usuarios.php');
                exit;
            } else {
                echo "Error al insertar el usuario en la base de datos.";
            }}else{

                echo'<script type="text/javascript">
                alert("La confirmación de contraseñas no coincide.");
                window.location.href="../pages/usuarios.php";
                </script>';
            }
        } elseif ($accion == 'editar') {
            $id_usuario = $_POST['id_usuario'];
            $user = $_POST['user'];
            $rol = $_POST['rol'];

            if($rol=='Recepcionista' || $rol=='Administrador'){
                $estado = 'Activo';
            }else{
                $estado = $_POST['estado'];
            }

            $datos_actualizados = array(
                'usuario' => $user,
                'rol' => $rol,
                'estado'  => $estado,
            );
          
            if (actualizarRegistro('tb_usuarios', 'id_usuario', $id_usuario, $datos_actualizados)) {
                header('Location: ../pages/usuarios.php');
                exit;
            } else {
                echo "Error al actualizar los datos del usuario en la base de datos.";
            }
        } elseif ($accion == 'refresh') {
            $id_usuario = $_POST['id_Usuario'];
            $password= md5($_POST['txtPassword']); 
            $confirmpass =md5($_POST['ConfirmPassword']);

            $datos_actualizados = array(
                'password' => $password,
            );
          if($password==$confirmpass){
            if (actualizarRegistro('tb_usuarios', 'id_usuario', $id_usuario, $datos_actualizados)) {
                header('Location: ../pages/usuarios.php');
                exit;
            } else {
                echo "Error al actualizar los datos del usuario en la base de datos.";
            }}else{

                echo'<script type="text/javascript">
                alert("La confirmación de contraseñas no coincide.");
                window.location.href="../pages/usuarios.php";
                </script>';
            }
        }elseif ($accion == 'eliminar') {
            $id_usuario = $_POST['id_usuario'];
        
            if (actualizarEstadoRegistro('tb_usuarios', 'id_usuario', $id_usuario, 'Inactivo')) {
                header('Location: ../pages/usuarios.php');
                exit;
            } else {
                echo "Error al eliminar el registro del usuario en la base de datos.";
            }
        }
    }
}
?>
