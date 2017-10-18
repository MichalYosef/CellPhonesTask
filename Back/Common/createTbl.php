<?php

function createHtmlTblByPdoResult( $result ) 
{
    echo `<html>
            <head>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
            </head>`;
    //$result = $dbconn->query('SELECT * from accounts');
    $colcount = $result->columnCount();

    // Get coluumn headers
    echo ('<table  class="table table-striped"><tr>');
    for ($i = 0; $i < $colcount; $i++){
        $meta = $result->getColumnMeta($i)["name"];
        echo('<th>' . $meta . '</th>');
    }
    echo('</tr>');

    // Get row data
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo('<tr>');
        for ($i = 0; $i < $colcount; $i++){
            $meta = $result->getColumnMeta($i)["name"];
            echo('<td>' . $row[$meta] . '</td>');
        }
        echo('</tr>');
    }

    echo ('</table>');
}


