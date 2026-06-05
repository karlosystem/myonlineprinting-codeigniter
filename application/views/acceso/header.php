<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - MyOnlineprinting</title>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/acceso/js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/acceso/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/acceso/js/general.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/acceso/js/ankit.js"></script>
  <!-- estilos -->
  <link href="<?php echo base_url(); ?>assets/acceso/css/styles.css" rel="stylesheet" />

  <style>
    .error_box {
      width: 517px !important;
    }
  </style>
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {

      jQuery('#login_form').validate({
        rules: {
          username: {

            required: true
          },
          password: {
            required: true,

          },

        }

      });
    });
  </script>

  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>

<body>