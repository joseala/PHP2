<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Admin.php';
include_once 'clases/Grupo.php';
include_once 'clases/Alumno.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['admin'])){
    if(isset($_POST['ver'])){
        if(filter_input(INPUT_POST, "id")){
            $id = $_POST['id'];       
            $grupos = $_SESSION['grupos'];
            foreach ($grupos as $grupo) {
                if($id == $grupo->getId()){
                    $_SESSION['grupo'] = $grupo;
                }
            }
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        }else{
            $grupos = $_SESSION['grupos'];           
            include 'vistas/vista_grupos.php';
        }       
    }elseif (isset ($_POST['nuevo'])) {       
        include 'vistas/vista_nuevo.php';
    }elseif (isset ($_POST['guardar'])) { 
        if(filter_input(INPUT_POST, "nombre") && filter_input(INPUT_POST, "apellido1") && filter_input(INPUT_POST, "apellido2")
                && filter_input(INPUT_POST, "edad")){
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            $idGrupo = $_SESSION['grupo']->getId();
            $alumno = new Alumno($nombre, $apellido1, $apellido2, $edad, $sexo,$idGrupo);
            $alumno->persist($dbh);
            $_SESSION['grupo']->getAlumnos()->add($alumno);
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        }else{
            include 'vistas/vista_nuevo.php';
        }       
    }elseif (isset ($_POST['guardarModificar'])) { 
        if(filter_input(INPUT_POST, "nombre") && filter_input(INPUT_POST, "apellido1") && filter_input(INPUT_POST, "apellido2")
                && filter_input(INPUT_POST, "edad")){
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];        
            $alumno = $_SESSION['alumno'];
            $alumno->setNombre($nombre);
            $alumno->setApellido1($apellido1);
            $alumno->setApellido2($apellido2);
            $alumno->setEdad($edad);
            $alumno->setSexo($sexo);
            $alumno->update($dbh);
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        } else {
            $alumno = $_SESSION['alumno'];
            include 'vistas/vista_modificar.php';
        }
        
    }elseif (isset ($_POST['borrar'])) {
        if(filter_input(INPUT_POST, "id")){
            $id = $_POST['id'];
            $_SESSION['grupo']->getAlumnos()->removeByProperty("id", $id);
            Alumno::deleteAlumno($dbh,$id);
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        }else{
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        }
        
    }elseif (isset ($_POST['modificar'])) {
        if(filter_input(INPUT_POST, "id")){
            $id = $_POST['id'];
            $_SESSION['alumno'] = $_SESSION['grupo']->getAlumnos()->getByProperty("id", $id);
            $alumno = $_SESSION['alumno'];
            include 'vistas/vista_modificar.php';
        }else{
            $grupo = $_SESSION['grupo'];
            include 'vistas/vista_grupo_admin.php';
        }    
    }elseif (isset ($_POST['xmlFile'])) {
        $_SESSION['grupo']->doXmlFile($dbh);
        $grupo = $_SESSION['grupo'];
        include 'vistas/vista_grupo_admin.php';
    }elseif (isset ($_POST['volver_grupo'])) {
        $grupo = $_SESSION['grupo'];
        include 'vistas/vista_grupo_admin.php';
    }elseif (isset ($_POST['volver_grupos'])) {
        unset($_SESSION['grupo']);
        $grupos = $_SESSION['grupos'];
        include 'vistas/vista_grupos.php';
    }elseif (isset ($_POST['salir'])) {
        unset($_SESSION['admin']);
        $mensaje = "Bienvenido, introduzca nombre y contraseña";
        include 'vistas/vista_login.php';
    }else{
        $grupos = $_SESSION['grupos'];
        include 'vistas/vista_grupos.php';
    }
}else{
    if(isset($_POST['login'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        try {
            $_SESSION['admin'] = Admin::getByCredencial($dbh,$nombre,$pass);
            $_SESSION['grupos'] = Grupo::getGrupos($dbh);
            $grupos = $_SESSION['grupos'];
            foreach ($grupos as $grupo) {
                $grupo->getAlumnosByIdGrupo($dbh);
            }           
            include 'vistas/vista_grupos.php';
        } catch (Exception $ex) {
            $mensaje = "No existe en bbdd";
            include 'vistas/vista_login.php';
        }       
    }else{
        $mensaje = "Bienvenido, introduzca nombre y contraseña";
        include 'vistas/vista_login.php';
    }
}
?>