<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 02</title>
    <style>
        table {
            width: 50%;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: black;
            color: whitesmoke;
        }

        td, th {
            padding: 10px;
        }

        td {
            text-align: center;
        }

        #t1 tr:nth-child(even) {
            background-color: #999;
        }

        #t1 tr:nth-child(odd){
            background-color: #eee;
        }
    </style>
</head>
<body>
    <table id="t1" align="center">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
        </tr>
    <?php
        $i = 1;
        while ($i <=10) {
    ?>        
        <tr>
            <td>181511036</td>
            <td>Agung Tri A</td>
            <td>20</td>
        </tr>
    <?php
            $i++;
        }
    ?>
    </table>
</body>
</html>