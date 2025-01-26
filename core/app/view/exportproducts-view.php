<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

if (isset($_GET["export-format"])) {
    if ($_GET["export-format"] == "pdf") {
    // Obtener los datos (en este caso, simulamos con datos estáticos).
$products = ProductData::getAll();

// Crear el contenido HTML del reporte.
$html = '
    <h2 style="text-align: center;">Reporte de Productos</h2>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
        <thead>
            <tr>
                <th style="background-color: #f2f2f2;">Nombre</th>
                <th style="background-color: #f2f2f2;">Precio Entrada</th>
                <th style="background-color: #f2f2f2;">Precio Salida</th>
                <th style="background-color: #f2f2f2;">Unidad</th>
                <th style="background-color: #f2f2f2;">Presentación</th>
                <th style="background-color: #f2f2f2;">Inventario Inicial</th>
                <th style="background-color: #f2f2f2;">Fecha Creación</th>
            </tr>
        </thead>
        <tbody>';

// Llenar el reporte con los datos obtenidos.
foreach ($products as $product) {
    $html .= '
        <tr>
            <td>' . htmlspecialchars($product->name) . '</td>
            <td>$' . number_format($product->price_in, 2) . '</td>
            <td>$' . number_format($product->price_out, 2) . '</td>
            <td>' . htmlspecialchars($product->unit) . '</td>
            <td>' . htmlspecialchars($product->presentation) . '</td>
            <td>' . $product->inventary_in . '</td>
            <td>' . $product->created_at . '</td>
        </tr>';
}

$html .= '
        </tbody>
    </table>';
    ob_end_clean();

// Crear instancia de Dompdf y configurar opciones.
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape'); // Configurar tamaño y orientación del papel.

// Renderizar el PDF.
$dompdf->render();

// Enviar el PDF al navegador.
$dompdf->stream('reporte_productos.pdf', ['Attachment' => false]);
exit;

    } else if ($_GET["export-format"] == "excel") {
        // Obtener todos los productos
        $products = ProductData::getAll();

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados
        $sheet->setCellValue('A1', 'Código');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Precio Entrada');
        $sheet->setCellValue('D1', 'Precio Salida');
        $sheet->setCellValue('E1', 'Unidad');
        $sheet->setCellValue('F1', 'Presentación');
        $sheet->setCellValue('G1', 'Inventario Inicial');
        $sheet->setCellValue('H1', 'Fecha Creación');

        // Estilizar encabezados
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        // Rellenar datos
        $row = 2;
        foreach ($products as $product) {
            $sheet->setCellValue("A$row", $product->barcode);
            $sheet->setCellValue("B$row", $product->name);
            $sheet->setCellValue("C$row", $product->price_in);
            $sheet->setCellValue("D$row", $product->price_out);
            $sheet->setCellValue("E$row", $product->unit);
            $sheet->setCellValue("F$row", $product->presentation);
            $sheet->setCellValue("G$row", $product->inventary_in);
            $sheet->setCellValue("H$row", $product->created_at);
            $row++;
        }

        // Establecer ancho automático en columnas
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Guardar el archivo como Excel
        $filename = 'productos.xlsx';

        // Limpia cualquier salida previa antes de enviar encabezados
        ob_end_clean();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
?>
