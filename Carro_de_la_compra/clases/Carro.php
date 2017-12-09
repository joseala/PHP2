<?php


class Carro {
    private $id;
    private $idUsuario;
    private $fecha;
    private $lineas;
    
    function __construct($idUsuario = null, $fecha = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->lineas = new Collection;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getLineas() {
        return $this->lineas;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setLineas($lineas) {
        $this->lineas = $lineas;
    }

    public function persist($dbh) {
        
        $query = "INSERT INTO carro (idUsuario,fecha) VALUES (:idUsuario,:fecha)";
        $persistir = $dbh->prepare($query);
        $persistido = $persistir->execute(array(":idUsuario" => $this->idUsuario, ":fecha" => $this->fecha));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }
        return $persistido;
    }
    public function setLineasCarro($dbh, $compras) {    
        foreach ($compras as $y => $linea) {
            if($linea['cantidad'] != 0){ 
                $query = "SELECT * FROM linea WHERE idProducto = :idProducto AND idCarro = :idCarro";
                $consulta = $dbh->prepare($query);
                $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Linea");
                $consulta->execute(array(":idProducto" => $compras[$y]['id'], ":idCarro" => $this->id));
                $existe = $consulta->fetch();
                if($existe){                  
                    $query = "UPDATE linea SET  cantidad = :cantidad WHERE idProducto = :idProducto AND idCarro = :idCarro";
                    $persist = $dbh->prepare($query);
                    $persist->execute(array("cantidad" => $compras[$y]['cantidad'], ":idProducto" => $compras[$y]['id'],":idCarro" => $this->id ));
                    $this->lineas->add($existe->getId());
                    
                }else{                   
                    $lineaNueva = new Linea($compras[$y]['id'], $compras[$y]['cantidad'], $this->id);
                    $lineaNueva->persist($dbh);
                    $this->lineas->add($lineaNueva->getId());
                }                           
            }
        }   
    }
    public function crearXML($dbh) {
        $miCompra = [];
        $pruebaXml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<Carro></Carro>
XML;
        $miCarro = new SimpleXMLElement($pruebaXml);
        $miCarro->addAttribute('id', $this->id);
        while($idLinea = $this->lineas->iterate()){
            $miLinea=Linea::getLinea($dbh,$idLinea);
            $linea = $miCarro->addChild("Linea");
            $linea->addAttribute('id',$idLinea);
            $producto = Producto::getProductoById($dbh,$miLinea->getIdProducto());
            $linea->addChild("Producto", $producto->getDenominacion());
            $linea->addChild("Precio", $producto->getPrecio());
            $linea->addChild("cantidad", $miLinea->getCantidad());
            $miCompra[] = ["denominacion" => $producto->getDenominacion(), "precio" => $producto->getPrecio(), "cantidad" => $miLinea->getCantidad()];
        }
        $miFichero = $miCarro->asXML();
        $miArchivo = fopen("xml/miCarro.xml", "w+");
        fwrite($miArchivo, $miFichero);
        return $miCompra;
    }
    public function deleteLineas($dbh) {
        $query = "DELETE FROM linea WHERE idCarro = :idCarro";
        $delete = $dbh->prepare($query);
        $delete->execute(array(":idCarro" => $this->id));
    }
}
