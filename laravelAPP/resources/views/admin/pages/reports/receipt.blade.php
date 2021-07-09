<?php ob_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Intervenções da Empresa</title>
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

table thead th{
    background-color: gray;
    color: white;
}

td {
    margin:5px;
    padding:5px;
    font-size: 12px;
}

@media print {
  h1 {page-break-before: always;}
}


        </style>
    </head>
    <body>
        @foreach ($worklogs as $worklog)
            <div style="height: 500px">
                <h1>Recibo do Funcionário</h1>
                <table>
                    <thead>
                        <tr>
                            <th width="300px">Nome</th>
                            <th width="100px">Inicio</th>
                            <th width="100px">Fim</th>
                            <th width="100px">Horas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $worklog->employee_name}}</td>
                            <td>{{ isset($date['start']) ? $date['start'] : formatDate($worklog->date_start,'Y-m-d','d/m/Y') }}</td>
                            <td>{{ isset($date['end']) ? $date['end'] : formatDate($worklog->date_end,'Y-m-d','d/m/Y') }}</td>
                            <td>{{ secondsToHours($worklog->time) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </body>
</html>

<?php
    $html = ob_get_clean();

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("Recibo do Funcionário.pdf", array("Attachment" => false));
    //$dompdf->stream("Intervenções da Empresa.pdf");
?>
