<?php

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

	
	
}