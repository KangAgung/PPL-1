<?php
    $nim = $_GET['nim'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 04</title>
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
<table id="t1" align="center">
        <tr>
            <th>NIM</th>
            <td><?php echo $nim; ?></td>
        </tr>
</table>

</body>
</html>