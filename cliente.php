<?php

class Cliente{
    private $nombre;
    private $apellido;
    private $estado;
    private $tipo_doc;
    private $numero_doc;

    //contructor

    public function __construct( $nombre,  $apellido,  $estado,  $tipo_doc,  $numero_doc){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->estado = $estado;
        $this->tipo_doc = $tipo_doc;
        $this->numero_doc = $numero_doc;
    }
	
    // GETTERS

    public function getNombre(){return $this->nombre;}

	public function getApellido(){return $this->apellido;}

	public function getEstado(){return $this->estado;}

	public function getTipoDoc(){return $this->tipo_doc;}

	public function getNumeroDoc(){return $this->numero_doc;}

    //SETTERS
    public function setNombre( $nombre): void {$this->nombre = $nombre;}

	public function setApellido( $apellido): void {$this->apellido = $apellido;}

	public function setEstado( $estado): void {$this->estado = $estado;}

	public function setTipoDoc( $tipo_doc): void {$this->tipo_doc = $tipo_doc;}

	public function setNumeroDoc( $numero_doc): void {$this->numero_doc = $numero_doc;}

    //otros metodos

    public function __toString() {
        $estado = match ($this->getEstado()) {
            "baja" => "🟥 Dado de baja",
            "alta" => "🟩 Activo",
            default => "⚠️ Estado desconocido"
        };
    
        return "─────────────── Cliente ───────────────\n" .
               "👤 Nombre:     " . $this->getNombre() . " " . $this->getApellido() . "\n" .
               "🆔 Documento:  " . $this->getTipoDoc() . " " . $this->getNumeroDoc() . "\n" .
               "📌 Estado:     " . $estado . "\n" .
               "──────────────────────────────────────\n";
    }
    
    


	

}