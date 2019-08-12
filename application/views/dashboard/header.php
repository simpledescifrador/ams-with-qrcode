<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ;?>assets/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">

        <?php echo link_tag('assets/vendor/DataTables-1.10.18/css/dataTables.bootstrap.min.css'); ?>
        <!--Custom CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/dashboard.css">
        <!-- Bootstrap DateTimepciker CSS -->
        <?php echo link_tag("vendor/components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"); ?>

        <!-- Chart JS Defult css -->
        <?php echo link_tag("assets/vendor/chartjs/css/default.css"); ?>

        <!-- Daterangepicker Defult css -->
        <?php echo link_tag("assets/css/daterangepicker.css"); ?>
        <title><?php echo $title; ?></title>
        <?php echo link_tag('favicon.png', 'shortcut icon', 'image/png'); ?>

        <style>
            .profile-pic {
                position: relative;
                display: inline-block;
            }

            .profile-pic:hover .edit {
                display: block;
            }
            .edit {
                background-color: rgba(0,0,0,0.7);
                padding: 5px;
                border-radius: 8px;
                margin-top: 10px;	
                margin-right: 10px;
                position: absolute;
                right: 0;
                top: 0;
                display: none;
            }

            .edit a {
                color: #fff;
            }
        </style>
    </head>

    <body>