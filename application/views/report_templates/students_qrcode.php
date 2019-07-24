<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
        }

        .qrcode-details {
            border: 1px solid black;
        }
        /* Clear floats after the columns */
        .row:after {
            flex-flow: row wrap;
            justify-content: center;
            margin: 5px 0;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        .scan-me {
            text-align:center;
            font-family: cursive;
        }
        .qrcode-img {
            border: 3px solid black;
        }
    </style>
    <title><?php echo $title; ?></title>
</head>
<body>
    <br />
        <?php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 3;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            $currentRow = 0;
        ?>
        <div class="row">
        <?php
            foreach ($qrcode_details as $row){
            ?>  
                    <div class="column">
                        <div class="qrcode-details">
                        <h3 class="scan-me">Scan Me!</h3>

                            <p style="text-align:center;"><img class="qrcode-img" src="<?php echo $row['qrcode_path']; ?>"></p>

                            <h5 style="text-align:center;"><small>My Name is</small><br><?php echo $row['name']; ?><br></h5>
                        </div>
                    </div>
            <?php
                $rowCount++;

                if($rowCount % $numOfCols == 0)  { 
                    $currentRow++;

                    echo "</div>";

                    if ($currentRow == 4) {
                        echo '<pagebreak>';
                        $currentRow = 0;
                    }

                    echo "<div class='row'>"; 

                }

                
            }

            ?>
        </div>

    </body>
</html>