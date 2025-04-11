<?php

include_once 'moto.php';

class Venta{
    private $numero;
    private $fecha;
    private $ref_Cliente;
    private $ref_Motos;
    private $precio_final;

    //constructor

    public function __construct($numero,  $fecha,  $ref_Cliente,  $ref_Motos = [],  $precio_final){
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->ref_Cliente = $ref_Cliente;
        $this->ref_Motos = $ref_Motos;
        $this->precio_final = $precio_final;
    }

    // GETTERS

    public function getNumero() {return $this->numero;}

	public function getFecha() {return $this->fecha;}

	public function getRefCliente() {return $this->ref_Cliente;}

	public function getRefMotos() {return $this->ref_Motos;}

	public function getPrecioFinal() {return $this->precio_final;}

	//SETTERS

    public function setNumero( $numero): void {$this->numero = $numero;}

	public function setFecha( $fecha): void {$this->fecha = $fecha;}

	public function setRefCliente( $ref_Cliente): void {$this->ref_Cliente = $ref_Cliente;}

	public function setRefMotos( $ref_Motos): void {$this->ref_Motos = $ref_Motos;}

	public function setPrecioFinal( $precio_final): void {$this->precio_final = $precio_final;}

	// __toString

    public function __toString() {
        $infoMotos = "";
        foreach ($this->getRefMotos() as $moto) {
            $infoMotos .= $moto . "\n";
        }
    
        if ($infoMotos === "") {
            $infoMotos = "❌ No hay motos asociadas a esta venta.\n";
        }
    
        return "═══════════════ VENTA N° " . $this->getNumero() . " ═══════════════\n" .
               "📅 Fecha: " . $this->getFecha() . "\n\n" .
               "🧍‍♂️ Cliente:\n" . $this->getRefCliente() . "\n" .
               "🏍️ Motos vendidas:\n" . $infoMotos .
               "💰 Precio final: $" . $this->getPrecioFinal() . "\n" .
               "══════════════════════════════════════════════════════\n";
    }
    

    //INCORPORAR MOTO

    public function incorporarMoto($objMoto) {
        // Verifica si la moto está disponible para la venta
        $agregada = false;
        $disponible = $objMoto -> getActiva();

        if ($disponible != false) {
            // Calcular el precio de venta de la moto
            $precioVenta = $objMoto->darPrecioVenta();
    
            // Agregar la moto a la colección actual
            $coleccionMotos = $this->getRefMotos();
            $coleccionMotos[] = $objMoto;
            $this->setRefMotos($coleccionMotos);
    
            // Sumar el precio de esta moto al precio final de la venta
            $nuevoPrecioFinal = $this->getPrecioFinal() + $precioVenta;
            $this->setPrecioFinal($nuevoPrecioFinal);
    
            $agregada = true; // Se incorporó con éxito
        }
    
        return $agregada;
    }
    
	
}