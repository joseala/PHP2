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
        if(filter_input(INPUT_POST,'id')){//Se comprueba si hay un id en POST, sino se vuelve e la vista categorias.
            
            $idCategoria = $_POST['id'];           
            $categorias = $_SESSION['categorias'];          
            foreach ($categorias as $categoria) {
                if($idCategoria == $categoria->getId()){//Se seleciona la categoria elegida.
                    $_SESSION['categoria'] = $categoria; 
                }
            }           
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';        
   
        }else{
            $categorias = $_SESSION['categorias'];
            include 'vistas/vista_categorias.php';
        }
    }elseif (isset ($_POST['crear'])) {       
        include 'vistas/vista_crear_producto.php';
    }elseif (isset ($_POST['guardar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        if($nombre != "" && $precio != ""){//Compruebo que vienen datos.
            $producto = new Producto($nombre, $precio,$_SESSION['categoria']->getId() );
            $producto->persist($dbh);//Guardo en bbdd el nuevo producto y en la coleccion de productos de la categoria.
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
            $producto = $_SESSION['producto'];
            include 'vistas/vista_modificar_producto.php';
        }else{
            $categoriaActual = $_SESSION['categoria'];
            include 'vistas/vista_productos_categoria.php';
        }      
    }elseif (isset ($_POST['cambiar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $idCategoria = $_POST['categoria'];
        $producto = $_SESSION['producto'];
        $producto->setNombre($nombre);
        $producto->setPrecio($precio);
        if($idCategoria == $producto->getIdCategoria()){//Si la categoria no ha cambiado se modifica en bbdd.         
            $producto->updateProducto($dbh); //Se modifica en bbdd el producto.
        }else{// Si la categoria ha cambiado, se borra el producto de la coleccion de la categoria anterior.
            $_SESSION['categoria']->getProductos()->removeByProperty('id', $producto->getId());
            $producto->setIdCategoria($idCategoria);//Se modifica al id de la nueva categoria.
            $categorias = $_SESSION['categorias'];
            foreach ($categorias as $categoria) {
                if($idCategoria == $categoria->getId()){//Se busca en la coleccion de categorias la nueva categoria.
                    $categoria->getProductos()->add($producto);//Se añade a su coleccion.
                    $producto->updateProducto($dbh);//Se modifica en bbdd el producto..
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
        $pass = $_POST['pass'];//Recupero el objeto Admin si está en bbdd.
        $admin = Admin::getByCredenciales($dbh,$nombre,$pass);
        if($admin){//Recupero las Categorias que hay en bbdd.
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
    
