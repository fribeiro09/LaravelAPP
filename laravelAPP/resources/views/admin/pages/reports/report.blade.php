<?php ob_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Relatório de Consumo de Horas</title>
        <style>

html {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

tr:nth-child(even) {background: #CCC}
tr:nth-child(odd) {background: #FFF}

h1 {
    border:1px solid black;
    text-align: center;
}

table thead th {
    background-color: rgb(80, 80, 80);
    color: white;
}

table tfoot th {
    background-color: rgb(110, 110, 110);
    color: white;
}

td {
    margin:5px;
    padding:5px;
    font-size: 12px;
}

.col1 {
    width: 300px;
}

.col2 {
    width: 500px;
}

.col3 {
    width: 90px;
    text-align: center;
}

.col4 {
    width: 90px;
    text-align: center;
}

        </style>
    </head>
    <body>
        <h1>Relatório de Consumo de Horas</h1>
        <table>
            <thead>
                <tr>
                    <th class="col1">Nome</th>
                    <th class="col2">Descrição</th>
                    <th class="col3">Data</th>
                    <th class="col4">Hora</th>
                </tr>
            </thead>
            <tbody>
@php
    $emp = $worklogs[0]->employee_name;
    $total_hours_employee = 0;
    $total_hours = 0;
@endphp
@foreach ($worklogs as $worklog)
    @if ($emp != $worklog->employee_name)
            </tbody>
            <tfoot>
                <tr>
                    <th class="col1" colspan="3"> {{ "Total " . $emp }}</th>
                    <th class="col4">{{ secondsToHours($total_hours_employee) }}</th>
                </tr>
            </tfoot>
        </table>
        <table style="padding-top: 10px;">
            <tbody>
        @php
            $total_hours_employee = 0;
        @endphp
    @endif
                <tr>
                    <td class="col1">{{ $worklog->employee_name }}</td>
                    <td class="col2">{{ $worklog->description }}</td>
                    <td class="col3">{{ formatDate($worklog->date, 'Y-m-d', 'd/m/Y') }}</td>
                    <td class="col4">{{ $worklog->time }}</td>
                </tr>
    @php
        $total_hours_employee = $total_hours_employee + hoursToSeconds($worklog->time);

        $total_hours = $total_hours + hoursToSeconds($worklog->time);
        $emp = $worklog->employee_name;
    @endphp
@endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th class="col1" colspan="3"> {{ "Total " . $emp }}</th>
                    <th class="col4">{{ secondsToHours($total_hours_employee) }}</th>
                </tr>
            </tfoot>

            <tfoot style="padding-top: 10px">
                <tr>
                    <th class="col1" colspan="3">Total Geral</th>
                    <th class="col4">{{ secondsToHours($total_hours) }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>


<?php
$html = ob_get_clean();

// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("Relatório de Consumo de Horas.pdf", array("Attachment" => false));
?>
