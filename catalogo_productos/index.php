<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Admin.php';
include_once 'clases/Categoria.php';
include_once 'clases/Producto.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['admin'])){
    if(isset($_POST['ver'])){
        if(filter_input(INPUT_POST,'id')){
            $idCategoria = $_POST['id'];
            if($idCategoria){
                $categorias = $_SESSION['categorias'];
                foreach ($categorias as $categoria) {
                    if($idCategoria == $categoria->getId()){
                        $_SESSION['categoria'] = $categoria; 
                    }
                }
                $categoriaActual = $_SESSION['categoria'];
                include 'vistas/vista_productos_categoria.php';
            }else{
                $categorias = $_SESSION['categorias'];
                include 'vistas/vista_categorias.php';          
            }
        }else{
            $categorias = $_SESSION['categorias'];
            include 'vistas/vista_categorias.php';
        }
    }elseif (isset ($_POST['crear'])) {       
        include 'vistas/vista_crear_producto.php';
    }elseif (isset ($_POST['guardar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        if($nombre != "" && $precio != ""){
            $producto = new Producto($nombre, $precio,$_SESSION['categoria']->getId() );
            $producto->persist($dbh);
            $_SESSION['categoria']->getProductos()->add($producto);
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';
        }else{
            include 'vistas/vista_crear_producto.php';
        }
    }elseif (isset ($_POST['modificar'])) {
        if(filter_input(INPUT_POST,'id')){
            $id = $_POST['id'];
            $_SESSION['producto'] = $_SESSION['categoria']->getProductos()->getByProperty("id", $id);
            include 'vistas/vista_modificar_producto.php';
        }else{
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';
        }      
    }elseif (isset ($_POST['cambiar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $idCategoria = $_POST['categoria'];
        $_SESSION['producto']->setNombre($nombre);
        $_SESSION['producto']->setPrecio($precio);
        if($idCategoria == $_SESSION['producto']->getIdCategoria()){            
            $_SESSION['producto']->updateProducto($dbh); 
        }else{
            $_SESSION['categoria']->getProductos()->removeByProperty('id', $_SESSION['producto']->getId());
            $_SESSION['producto']->setIdCategoria($idCategoria);
            $categorias = $_SESSION['categorias'];
            foreach ($categorias as $categoria) {
                if($idCategoria == $categoria->getId()){
                    $categoria->getProductos()->add($_SESSION['producto']);
                    $_SESSION['producto']->updateProducto($dbh);
                }
            }
        }
        unset($_SESSION['producto']); 
        $categoriaActual = $_SESSION['categoria'];
        include 'vistas/vista_productos_categoria.php';        
    }elseif (isset ($_POST['borrar'])) {
        if(filter_input(INPUT_POST,'id')){
            $id = $_POST['id'];
            $_SESSION['categoria']->getProductos()->removeByProperty('id', $id);
            Producto::deleteProducto($dbh,(int)$id);
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';
        }else{
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';
        }
         
    }elseif (isset ($_POST['salir'])) {
        unset($_SESSION['admin']);
        unset($_SESSION['categorias']);
        unset($_SESSION['categoria']);
        include 'vistas/vista_login.php';
    }elseif (isset ($_POST['volver'])) {
        $categoriaActual = $_SESSION['categoria'];
        include 'vistas/vista_productos_categoria.php'; 
    }elseif (isset ($_POST['volverCategorias'])) {
        unset($_SESSION['categoria']);
        $categorias = $_SESSION['categorias'];
        include 'vistas/vista_categorias.php'; 
    } else {
        include 'vistas/vista_login.php';
    }    
}else{
    if(isset($_POST['login'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $admin = new Admin($nombre,$pass);
        $logueado = $admin->getByCredenciales($dbh);
        if($logueado){
            $_SESSION['categorias']= Categoria::getCategoriasBD($dbh);
            $_SESSION['admin'] = $admin;
            $categorias = $_SESSION['categorias'];
            include 'vistas/vista_categorias.php';    
        } else {
            include 'vistas/vista_login.php';
        }       
    }else{
        include 'vistas/vista_login.php';
    }
}     
?>
    
