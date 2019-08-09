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
    </head>

    <body>