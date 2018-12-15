<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Hotel OnLine</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL;?>lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL;?>stylesheets/theme.css">
    <link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/font-awesome/css/font-awesome.css">
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>/css/jquery.ui/smoothness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>/lib/alertify-0.3.11/css/alertify.core.css" rel="stylesheet">
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>/lib/alertify-0.3.11/css/alertify.default.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>js/data_table/datatables.css">
	  
    <script>var env_webroot_script = '<?php echo ENV_WEBROOT_FULL_URL; ?>';</script>

    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/user.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/persona.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/rol_persona.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/estado_habitacion.js" type="text/javascript"></script>
    
    
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/data_table/datatables.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/jquery_datepicker/jquery.ui.datepicker-es.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/alertify-0.3.11/alertify.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">Settings</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo $this->Session->read('Auth.User.username'); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">My Account</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                            <li class="divider visible-phone"></li>
                            <li><?php echo $this->Html->link(__('Log Out'),array('ajax'=>false,'controller' => 'users', 'action' => 'logout')); ?></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">Your</span> <span class="second">Company</span></a>
        </div>
    </div>
    

    <!-- Menu Lateral -->
    <?php echo $this->Element('menu_lateral');  ?>
    

    <?php echo $this->fetch('content'); ?>
 
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


