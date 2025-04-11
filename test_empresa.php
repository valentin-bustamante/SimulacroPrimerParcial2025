<?php

include_once 'moto.php';
include_once 'cliente.php';
include_once 'venta.php';
include_once 'empresa.php';

$objCliente1 = new Cliente("juan", "perez", "alta", "dni", 45678234);
$objCliente2 = new Cliente("valentin", "bustamante", "alta", "dni", 47638400);

$moto1 = new Moto(11, 223000, 2022 ,"Benelli Imperiale 400", 85, true);

$moto2 = new Moto(12, 584000, 2021 ,"Zanella Zr 150 Ohc", 70, true);

$moto3 = new Moto(13, 999900, 2023 ,"Zanella Patagonian Eagle 250", 55, false);

$empresa = new Empresa("alta gama" , "av argentina 123" , $colenccion_de_clientes = [$objCliente1, $objCliente2] ,$colenccion_de_motos = [$moto1, $moto2, $moto3], $colenccion_de_ventas = []);

$empresa -> registrarVenta([11, 12, 13], $objCliente2);

$empresa -> registrarVenta([0], $objCliente2);

$empresa -> registrarVenta([2], $objCliente2);


echo $empresa;

echo "══════════════════════════════════════════════════════════\n";
echo "🧾 VENTAS POR CLIENTE\n";
echo "══════════════════════════════════════════════════════════\n\n";

$ventasJuan = $empresa->retornarVentasXCliente("dni", 45678234);
echo "🧑‍💼 Ventas de Juan Perez:\n";
foreach ($ventasJuan as $venta) {
    echo "──────────────────────────────────────────────────────────\n";
    echo $venta;
}
echo "\n";

$ventasValen = $empresa->retornarVentasXCliente("dni", 47638400);
echo "🧑‍💼 Ventas de Valentin Bustamante:\n";
foreach ($ventasValen as $venta) {
    echo "──────────────────────────────────────────────────────────\n";
    echo $venta;
}



