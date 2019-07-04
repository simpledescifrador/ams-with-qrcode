<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    
    <title>Generate PDF</title>
</head>
<body>
    <br />
        <?php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 4;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
        ?>
        <div class="row">
        <?php
            foreach ($qrcode_details as $row){
            ?>  
                    <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                        <div class="qrcode_details">
                            <img src="<?php echo $row['qrcode_path']; ?>">
                            <h3><?php echo $row['name']; ?></h3>
                        </div>
                    </div>
            <?php
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
            }
        ?>
</div>
</body>
</html>