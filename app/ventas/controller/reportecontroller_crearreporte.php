<?php

require_once '../../../config/loader.php';
require_once '../../../vendor/reportes/fpdf/fpdf.php';

//echo "<pre>";
//print_r($_POST);
//echo "<pre/>";

use app\ventas\controller\reportecontroller;

//capturar información 
$tipoReporte = filter_input(INPUT_POST, "reports");
$rango = filter_input(INPUT_POST, "rad");

//instaciar controller
$reporteController = new reportecontroller();

//crear PDF
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont("Courier", "B", "16");
//Validar información que irá en formulario
switch ($tipoReporte) {
    case 1: //producto más vendido
        if ($rango == 1) {
            $result = $reporteController->getProdMasVendDia();
            $pdf->Cell(190, 5, utf8_decode("Productos más vendidos - Día"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(45, 5, utf8_decode("Nombre"), 1, 0, "C");
            $pdf->Cell(33, 5, utf8_decode("Cantidad ventas"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio Bruto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Impuesto"), 1, 0, "C");
            $pdf->Cell(43, 5, utf8_decode("Precio Total Unitario"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idProd']), 1, 0, "C");
                $pdf->Cell(45, 5, utf8_decode($filas['prodname']), 1, 0, "C");
                $pdf->Cell(33, 5, utf8_decode($filas['cantidad']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['precioBruto']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['imp']), 1, 0, "C");
                $pdf->Cell(43, 5, utf8_decode($filas['precioTot']), 1, 1, "C");
            }
            $pdf->Output();
        } else if ($rango == 2) {
            $mes = filter_input(INPUT_POST, "month");
            $result = $reporteController->getProdMasVendMes($mes);
            $dateObj = DateTime::createFromFormat('!m', $mes);
            $monthName = $dateObj->format('F');
            $pdf->Cell(190, 5, utf8_decode("Productos más vendidos - Mes {$monthName}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(45, 5, utf8_decode("Nombre"), 1, 0, "C");
            $pdf->Cell(33, 5, utf8_decode("Cantidad ventas"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio Bruto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Impuesto"), 1, 0, "C");
            $pdf->Cell(43, 5, utf8_decode("Precio Total Unitario"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idProd']), 1, 0, "C");
                $pdf->Cell(45, 5, utf8_decode($filas['prodname']), 1, 0, "C");
                $pdf->Cell(33, 5, utf8_decode($filas['cantidad']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['precioBruto']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['imp']), 1, 0, "C");
                $pdf->Cell(43, 5, utf8_decode($filas['precioTot']), 1, 1, "C");
            }
            $pdf->Output();
        } else if ($rango == 3) {
            $anio = filter_input(INPUT_POST, "cajaAnio");
            $result = $reporteController->getProdMasVendAnual($anio);
            $pdf->Cell(190, 5, utf8_decode("Productos más vendidos - Año {$anio}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(45, 5, utf8_decode("Nombre"), 1, 0, "C");
            $pdf->Cell(33, 5, utf8_decode("Cantidad ventas"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio Bruto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Impuesto"), 1, 0, "C");
            $pdf->Cell(43, 5, utf8_decode("Precio Total Unitario"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idProd']), 1, 0, "C");
                $pdf->Cell(45, 5, utf8_decode($filas['prodname']), 1, 0, "C");
                $pdf->Cell(33, 5, utf8_decode($filas['cantidad']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['precioBruto']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['imp']), 1, 0, "C");
                $pdf->Cell(43, 5, utf8_decode($filas['precioTot']), 1, 1, "C");
            }
            $pdf->Output();
        } else if ($rango == 4) {
            $inicio = filter_input(INPUT_POST, "cajaFecIni");
            $fin = filter_input(INPUT_POST, "cajaFecFin");
            $result = $reporteController->getProdMasVendRango($inicio, $fin);
            $pdf->Cell(190, 5, utf8_decode("Productos más vendidos - Entre {$inicio} y {$fin}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(45, 5, utf8_decode("Nombre"), 1, 0, "C");
            $pdf->Cell(33, 5, utf8_decode("Cantidad ventas"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio Bruto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Impuesto"), 1, 0, "C");
            $pdf->Cell(43, 5, utf8_decode("Precio Total Unitario"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idProd']), 1, 0, "C");
                $pdf->Cell(45, 5, utf8_decode($filas['prodname']), 1, 0, "C");
                $pdf->Cell(33, 5, utf8_decode($filas['cantidad']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['precioBruto']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['imp']), 1, 0, "C");
                $pdf->Cell(43, 5, utf8_decode($filas['precioTot']), 1, 1, "C");
            }
            $pdf->Output();
        } break;
    case 2: //total de ventas
        if ($rango == 1) {
            
        } else if ($rango == 2) {
            $mes = filter_input(INPUT_POST, "month");
        } else if ($rango == 3) {
            $anio = filter_input(INPUT_POST, "cajaAnio");
        } else if ($rango == 4) {
            $inicio = filter_input(INPUT_POST, "cajaFecIni");
            $fin = filter_input(INPUT_POST, "cajaFecFin");
        } break;
    case 3: //devoluciones
        if ($rango == 1) {
            $result = $reporteController->getReporteDevolucionesDia();
            $pdf->Cell(190, 5, utf8_decode("Reporte de devoluciones - Hoy"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(20, 5, utf8_decode("¿Aprobado?"), 1, 0, "C");
            $pdf->Cell(15, 5, utf8_decode("Id Tick"), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode("Cliente"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha Tick"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha dev"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Producto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idDevolution']), 1, 0, "C");
                if ($filas['approved'] == 1) {
                    $apro = "Si";
                } else if ($filas['approved'] == 2) {
                    $apro = "No";
                } else {
                    $apro = "Pendiente";
                }
                $pdf->Cell(20, 5, utf8_decode($apro), 1, 0, "C");
                $pdf->Cell(15, 5, utf8_decode($filas['tickId']), 1, 0, "C");
                $pdf->Cell(35, 5, utf8_decode($filas['nameClient']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['tickDate']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['dateDevolution']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['nomProd']), 1, 0, "C");
                $precioFormateado = number_format($filas['precio']);
                $pdf->Cell(28, 5, utf8_decode("$ {$precioFormateado}"), 1, 1, "C");
            }
            $pdf->Output();
        } else if ($rango == 2) {
            $mes = filter_input(INPUT_POST, "month");
            $result = $reporteController->getReporteDevolucionesMes($mes);
            $dateObj = DateTime::createFromFormat('!m', $mes);
            $monthName = $dateObj->format('F');
            $pdf->Cell(190, 5, utf8_decode("Reporte de devoluciones - Mes {$monthName}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(20, 5, utf8_decode("¿Aprobado?"), 1, 0, "C");
            $pdf->Cell(15, 5, utf8_decode("Id Tick"), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode("Cliente"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha Tick"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha dev"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Producto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idDevolution']), 1, 0, "C");
                if ($filas['approved'] == 1) {
                    $apro = "Si";
                } else if ($filas['approved'] == 2) {
                    $apro = "No";
                } else {
                    $apro = "Pendiente";
                }
                $pdf->Cell(20, 5, utf8_decode($apro), 1, 0, "C");
                $pdf->Cell(15, 5, utf8_decode($filas['tickId']), 1, 0, "C");
                $pdf->Cell(35, 5, utf8_decode($filas['nameClient']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['tickDate']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['dateDevolution']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['nomProd']), 1, 0, "C");
                $precioFormateado = number_format($filas['precio']);
                $pdf->Cell(28, 5, utf8_decode("$ {$precioFormateado}"), 1, 1, "C");
            }
            $pdf->Output();
        } else if ($rango == 3) {
            $anio = filter_input(INPUT_POST, "cajaAnio");
            $result = $reporteController->getReporteDevolucionesAnio($anio);
            $pdf->Cell(190, 5, utf8_decode("Reporte de devoluciones - Año {$anio}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(20, 5, utf8_decode("¿Aprobado?"), 1, 0, "C");
            $pdf->Cell(15, 5, utf8_decode("Id Tick"), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode("Cliente"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha Tick"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha dev"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Producto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idDevolution']), 1, 0, "C");
                if ($filas['approved'] == 1) {
                    $apro = "Si";
                } else if ($filas['approved'] == 2) {
                    $apro = "No";
                } else {
                    $apro = "Pendiente";
                }
                $pdf->Cell(20, 5, utf8_decode($apro), 1, 0, "C");
                $pdf->Cell(15, 5, utf8_decode($filas['tickId']), 1, 0, "C");
                $pdf->Cell(35, 5, utf8_decode($filas['nameClient']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['tickDate']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['dateDevolution']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['nomProd']), 1, 0, "C");
                $precioFormateado = number_format($filas['precio']);
                $pdf->Cell(28, 5, utf8_decode("$ {$precioFormateado}"), 1, 1, "C");
            }
            $pdf->Output();
            
        } else if ($rango == 4) {
            $inicio = filter_input(INPUT_POST, "cajaFecIni");
            $fin = filter_input(INPUT_POST, "cajaFecFin");
            $result = $reporteController->getReporteDevolucionesRango($inicio,$fin);
            $pdf->Cell(190, 5, utf8_decode("Reporte devoluciones - Entre {$inicio} y {$fin}"), 0, 1, "C");
            $pdf->Ln(2);
            $pdf->Ln(2);
            $pdf->SetFont("Courier", "B", "9");
            $pdf->Cell(15, 5, utf8_decode("Id"), 1, 0, "C");
            $pdf->Cell(20, 5, utf8_decode("¿Aprobado?"), 1, 0, "C");
            $pdf->Cell(15, 5, utf8_decode("Id Tick"), 1, 0, "C");
            $pdf->Cell(35, 5, utf8_decode("Cliente"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha Tick"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Fecha dev"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Producto"), 1, 0, "C");
            $pdf->Cell(28, 5, utf8_decode("Precio"), 1, 1, "C");
            $pdf->SetFont("Courier", "", "8");
            foreach ($result as $indice => $filas) {
                $pdf->Cell(15, 5, utf8_decode($filas['idDevolution']), 1, 0, "C");
                if ($filas['approved'] == 1) {
                    $apro = "Si";
                } else if ($filas['approved'] == 2) {
                    $apro = "No";
                } else {
                    $apro = "Pendiente";
                }
                $pdf->Cell(20, 5, utf8_decode($apro), 1, 0, "C");
                $pdf->Cell(15, 5, utf8_decode($filas['tickId']), 1, 0, "C");
                $pdf->Cell(35, 5, utf8_decode($filas['nameClient']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['tickDate']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['dateDevolution']), 1, 0, "C");
                $pdf->Cell(28, 5, utf8_decode($filas['nomProd']), 1, 0, "C");
                $precioFormateado = number_format($filas['precio']);
                $pdf->Cell(28, 5, utf8_decode("$ {$precioFormateado}"), 1, 1, "C");
            }
            $pdf->Output();
        } break;
    case 4: //agotados
        break;
    case 5: //en existencia
        break;
}
?>