<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <h3 align="center">Weather Summary</h3><br>
        <table  class="table" style="width:100%">
            <tr>
                <th>Time</th>
                <th>Temperature</th>
                <th>Pressure</th> 
                <th>Humidity</th>
            </tr>

            <?php
                $objCSV = fopen("data.csv", "r");
                $max_row = 10;
                $avg_temperture = 0;
                $avg_pressure = 0;
                $avg_humidity = 0;
                $row_count = 0;
                while (! feof($objCSV)) {
                    $objArr = fgetcsv($objCSV);
                    $avg_temperture += $objArr[1];
                    $avg_pressure += $objArr[2];
                    $avg_humidity += $objArr[3];
                    $row_count++;
            ?>
                    <tr>
                        <td><?php echo $objArr[0]; ?></td>
                        <td><?php echo $objArr[1]; ?> °C</td>
                        <td><?php echo $objArr[2]; ?> hPa</td>
                        <td><?php echo $objArr[3]; ?>%</td>
                    </tr>

            <?php
            }

            $avg_temperture = $avg_temperture / $row_count;
            $avg_pressure = $avg_pressure / $row_count;
            $avg_humidity = $avg_humidity / $row_count;
            fclose($objCSV);
            ?>
        </table>

        <div class="container text-center">    
            <div class="row">
                <div class="col-sm-4" style="background-color: #ccf2ff;">
                    <h4><?php echo number_format($avg_temperture, 2); ?> °C</h4>
                    <p>Avg. of Temperature</p>
                </div>
                <div class="col-sm-4" style="background-color: #b3d9ff;">
                    <h4><?php echo number_format($avg_pressure, 2); ?> hPa</h4>
                    <p>Avg. of Pressure</p>
                </div>
                <div class="col-sm-4" style="background-color: #c2d1f0;">
                    <h4><?php echo number_format($avg_humidity, 2); ?>%</h4>
                    <p>Avg. of Humidity</p>
                </div>
            </div>
        </div>
    </body>
</html>
