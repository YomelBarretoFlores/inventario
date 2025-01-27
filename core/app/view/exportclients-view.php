<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

if (isset($_GET["export-format"])) {
    // Obtener todos los clientes
    $clients = array_filter(PersonData::getAll(), function ($client) {
        return $client->kind == 1;
    });

    if ($_GET["export-format"] == "pdf") {
        // Crear el contenido HTML para el PDF
        $html = '
        <h2 style="text-align: center;">Directorio de Clientes</h2>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
            <thead>
                <tr>
                    <th style="background-color: #f2f2f2;">Nombre Completo</th>
                    <th style="background-color: #f2f2f2;">Dirección</th>
                    <th style="background-color: #f2f2f2;">Email</th>
                    <th style="background-color: #f2f2f2;">Teléfono</th>
                    <th style="background-color: #f2f2f2;">Fecha de Creación</th>
                </tr>
            </thead>
            <tbody>';

        // Llenar el reporte con los datos obtenidos
        foreach ($clients as $client) {
            $nombreCompleto = htmlspecialchars($client->name . ' ' . $client->lastname);
            $html .= "
            <tr>
                <td>{$nombreCompleto}</td>
                <td>" . htmlspecialchars($client->address1) . "</td>
                <td>" . htmlspecialchars($client->email1) . "</td>
                <td>" . htmlspecialchars($client->phone1) . "</td>
                <td>" . htmlspecialchars($client->created_at) . "</td>
            </tr>";
        }

        $html .= '</tbody></table>';

        // Limpiar cualquier salida previa
        ob_end_clean();

        // Crear instancia de Dompdf y configurar opciones
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream('directorio_clientes.pdf', ['Attachment' => false]);
        exit;
    } elseif ($_GET["export-format"] == "excel") {
        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados
        $sheet->setCellValue('A1', 'Nombre Completo');
        $sheet->setCellValue('B1', 'Dirección');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Teléfono');
        $sheet->setCellValue('E1', 'Fecha de Creación');

        // Estilizar encabezados
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Rellenar datos
        $row = 2;
        foreach ($clients as $client) {
            $nombreCompleto = $client->name . ' ' . $client->lastname;
            $sheet->setCellValue("A$row", $nombreCompleto);
            $sheet->setCellValue("B$row", $client->address1);
            $sheet->setCellValue("C$row", $client->email1);
            $sheet->setCellValue("D$row", $client->phone1);
            $sheet->setCellValue("E$row", $client->created_at);
            $row++;
        }

        // Establecer ancho automático en columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Guardar el archivo como Excel
        $filename = 'directorio_clientes.xlsx';

        // Limpiar cualquier salida previa antes de enviar encabezados
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
