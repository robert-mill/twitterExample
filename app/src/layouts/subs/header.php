<?php
    include_once ("./conf/conf.php");
    $page = $_SERVER['REQUEST_URI' ];
    $page = str_replace("/twitterExample/index.php/","",$page)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Twitter example</title>

    <!-- Bootstrap -->
    <link href="/twitterExample/app/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/twitterExample/app/assets/css/bootstrap.css.map" rel="stylesheet">
    <link href="/twitterExample/app/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/twitterExample/app/assets/css/bootstrap.min.css.map" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
           Nav head

        </div>
        <div id="navbar" class="navbar-collapse collapse">
           links go here

        </div><!--/.navbar-collapse -->
    </div>
</nav>
