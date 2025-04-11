<?php

include_once 'moto.php';
include_once 'cliente.php';
include_once 'venta.php';
class Empresa{
    private $denominacion;
    private $direccion;
    private $coleccion_clientes;
    private $coleccion_motos;
    private $coleccion_ventas;

    //constructor

    public function __construct( $denominacion,  $direccion,  $coleccion_clientes = [],  $coleccion_motos = [],  $coleccion_ventas = []){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->coleccion_clientes = $coleccion_clientes;
        $this->coleccion_motos = $coleccion_motos;
        $this->coleccion_ventas = $coleccion_ventas;
    }

    // GETTERS

    public function getDenominacion() {return $this->denominacion;}

	public function getDireccion() {return $this->direccion;}

	public function getColeccionClientes() {return $this->coleccion_clientes;}

	public function getColeccionMotos() {return $this->coleccion_motos;}

	public function getColeccionVentas() {return $this->coleccion_ventas;}

	// SETTERS

    public function setDenominacion( $denominacion): void {$this->denominacion = $denominacion;}

	public function setDireccion( $direccion): void {$this->direccion = $direccion;}

	public function setColeccionClientes( $coleccion_clientes): void {$this->coleccion_clientes = $coleccion_clientes;}

	public function setColeccionMotos( $coleccion_motos): void {$this->coleccion_motos = $coleccion_motos;}

	public function setColeccionVentas( $coleccion_ventas): void {$this->coleccion_ventas = $coleccion_ventas;}

    // __toString

    public function __toString() {
        $infoClientes = "";
        $clientes = $this->getColeccionClientes();
        for ($i = 0; $i < count($clientes); $i++) {
            $infoClientes .= $clientes[$i] . "\n";
        }
        if ($infoClientes == "") {
            $infoClientes = "No hay clientes registrados.\n";
        }
    
        $infoMotos = "";
        $motos = $this->getColeccionMotos();
        for ($i = 0; $i < count($motos); $i++) {
            $infoMotos .= $motos[$i] . "\n";
        }
        if ($infoMotos == "") {
            $infoMotos = "No hay motos registradas.\n";
        }
    
        $infoVentas = "";
        $ventas = $this->getColeccionVentas();
        for ($i = 0; $i < count($ventas); $i++) {
            $infoVentas .= $ventas[$i] . "\n";
        }
        if ($infoVentas == "") {
            $infoVentas = "No hay ventas realizadas.\n";
        }
    
        return "🏢 Empresa\n" .
               "Denominación: " . $this->getDenominacion() . "\n" .
               "Dirección: " . $this->getDireccion() . "\n\n" .
               "📋 Clientes:\n" . $infoClientes . "\n" .
               "🏍️ Motos:\n" . $infoMotos . "\n" .
               "🧾 Ventas:\n" . $infoVentas;
    }
    

	// RETORNAR MOTO

    public function retornarMoto($codigoMoto){
        $elementos = count($this-> getColeccionMotos());
        $i = 0;
        $encontrado = false;
        while ($encontrado != true && $i < $elementos) {
            if ($codigoMoto == $this-> getColeccionMotos()[$i]->getCodigo()) {
                $moto = $this -> getColeccionMotos()[$i];
            }
            else {
                $moto = null;
            }
            $i++;
        }
        return $moto;
    }
   
    // REGISTRAR VENTA

    public function registrarVenta($colCodigosMoto, $objCliente) {
        // Verificar si el cliente está dado de baja (asumiendo método getEstado())
        if ($objCliente->getEstado() == "baja") {
            return 0; // Cliente no puede comprar
        }
    
        $objVenta = new Venta(random_int(0, 1000), date("Y-m-d"), $objCliente, [], 0);
    
        $elementos = count($colCodigosMoto);
    
        for ($i = 0; $i < $elementos; $i++) {
            $codigo = $colCodigosMoto[$i];
            $moto = $this->retornarMoto($codigo); // Método que busca una moto por su código
    
            if ($moto !== null && $moto->getActiva()) {
                $objVenta->incorporarMoto($moto);
                $ventas = $this->getColeccionVentas();
                $ventas[] = $objVenta;
                $this->setColeccionVentas($ventas);
            }
        }
    
        // Retornamos el importe final de la venta
        return $objVenta->getPrecioFinal();
    }

    // REOTNAR VENTAS POR CLIENTE

    public function retornarVentasXCliente($tipo, $numDoc) {
        $ventasCliente = [];
        $ventas = $this->getColeccionVentas(); // Obtener todas las ventas
    
        for ($i = 0; $i < count($ventas); $i++) {
            $venta = $ventas[$i];
            $cliente = $venta->getRefCliente();
            
            if ($cliente->getTipoDoc() == $tipo && $cliente->getNumeroDoc() == $numDoc) {
                $ventasCliente[] = $venta;
            }
        }
    
        return $ventasCliente;
    }
       
}