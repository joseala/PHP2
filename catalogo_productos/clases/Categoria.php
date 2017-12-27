<?php


class Categoria {
    private $id;
    private $nombre;
    private $productos;
    
    function __construct($id = null, $nombre = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->productos = new Collection();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getProductos() {
        return $this->productos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setProductos($productos) {
        $this->productos = $productos;
    }

    public function getCategoriasBD($dbh) {
        $query = "SELECT * FROM categoria";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Categoria");
        $consulta->execute();
        $categorias = $consulta->fetchAll();
        foreach ($categorias as $categoria) {
            $query = "SELECT * FROM producto WHERE idCategoria = :idCategoria";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Producto");
            $consulta->execute(array(":idCategoria" => $categoria->getId()));
            $productos = $consulta->fetchAll();
            foreach ($productos as $producto) {
                $categoria->getProductos()->add($producto);
            }
        }
        return $categorias;                     
    }
    
   

}
