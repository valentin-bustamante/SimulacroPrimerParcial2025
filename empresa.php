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
        $info = "════════════════ EMPRESA ════════════════\n";
        $info .= "🏢 Denominación: " . $this->getDenominacion() . "\n";
        $info .= "📍 Dirección:    " . $this->getDireccion() . "\n";
        $info .= "════════════════════════════════════════\n\n";
    
        $info .= "📋 CLIENTES:\n";
        foreach ($this->getColeccionClientes() as $cliente) {
            $info .= $cliente . "\n";
        }
    
        $info .= "\n🏍️ MOTOS:\n";
        foreach ($this->getColeccionMotos() as $moto) {
            $info .= $moto . "\n";
        }
    
        $info .= "\n🧾 VENTAS:\n";
        foreach ($this->getColeccionVentas() as $venta) {
            $info .= $venta . "\n";
        }
    
        return $info;
    }
    

	// RETORNAR MOTO

    public function retornarMoto($codigoMoto){
        $elementos = count($this->getColeccionMotos());
        $i = 0;
        $encontrado = false;
        $moto = null;
        while (!$encontrado && $i < $elementos) {
            if ($codigoMoto == $this->getColeccionMotos()[$i]->getCodigo()) {
                $moto = $this->getColeccionMotos()[$i];
                $encontrado = true;
            }
            $i++;
        }
        return $moto;
    }
    
   
    // REGISTRAR VENTA

    public function registrarVenta($colCodigosMoto, $objCliente) {
        if ($objCliente->getEstado() == "baja") {
            return 0;
        }
    
        $objVenta = new Venta(random_int(0, 1000), date("Y-m-d"), $objCliente, [], 0);
        $seAgregoAlMenosUna = false;
    
        for ($i = 0; $i < count($colCodigosMoto); $i++) {
            $codigo = $colCodigosMoto[$i];
            $moto = $this->retornarMoto($codigo);
    
            if ($moto !== null && $moto->getActiva()) {
                $exito = $objVenta->incorporarMoto($moto);
                if ($exito) {
                    $seAgregoAlMenosUna = true;
                }
            }
        }
    
        if ($seAgregoAlMenosUna) {
            $ventas = $this->getColeccionVentas();
            $ventas[] = $objVenta;
            $this->setColeccionVentas($ventas);
        }
    
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