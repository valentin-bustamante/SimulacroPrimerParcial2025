<?php

class Moto{
    private int $codigo;
    private float $costo;
    private int $anio_fabricacion;
    private string $descripcion;
    private float $incremento;
    private bool $activa;

    //contructor


    /**
     * @param bool $activa
     * 
     */
    public function __construct( $codigo,  $costo,  $anio_fabricacion,  $descripcion,  $incremento,  $activa){
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anio_fabricacion = $anio_fabricacion;
        $this->descripcion = $descripcion;
        $this->incremento = $incremento;
        $this->activa = $activa;
    }

    //GETTERS

    public function getCodigo() {return $this->codigo;}

	public function getCosto() {return $this->costo;}

	public function getAnioFabricacion() {return $this->anio_fabricacion;}

	public function getDescripcion() {return $this->descripcion;}

	public function getIncremento() {return $this->incremento;}

	public function getActiva() {return $this->activa;}

	//SETTERS

    public function setCodigo( $codigo): void {$this->codigo = $codigo;}

	public function setCosto( $costo): void {$this->costo = $costo;}

	public function setAnioFabricacion( $anio_fabricacion): void {$this->anio_fabricacion = $anio_fabricacion;}

	public function setDescripcion( $descripcion): void {$this->descripcion = $descripcion;}

	public function setIncremento( $incremento): void {$this->incremento = $incremento;}

	public function setActiva( $activa): void {$this->activa = $activa;}

	// toString

    public function __toString() {
        $estado = $this->getActiva() ? "Disponible para la venta" : "No disponible para la venta";
    
        return "📌 Moto:\n" .
               "Código: " . $this->getCodigo() . "\n" .
               "Descripción: " . $this->getDescripcion() . "\n" .
               "Año de fabricación: " . $this->getAnioFabricacion() . "\n" .
               "Costo: $" . $this->getCosto() . "\n" .
               "Incremento anual: " . ($this->getIncremento() * 100) . "%\n" .
               "Estado: " . $estado . "\n";
    }
    

    // DAR PRECIO VENTA

    public function darPrecioVenta(){
        $venta = -1;
        if ($this->getActiva() == true) {
            $venta = $this-> getCosto() + ($this-> getCosto() * ((date("Y") - $this-> getAnioFabricacion())* $this-> getIncremento()));
        }
        return $venta;
    }
	
}

