<?php

function showMenu() {
	global $items;
	$currentSection = 'Sneakers';
	if (isset($_GET['s'])) {
		$currentSection = $_GET['s'];
	}

	$pageKeys = array_keys($items);
	foreach ($pageKeys as $key) {
		if ($key == $currentSection) {
			echo '<li class="active"><a href="/?s=', $key, '">', $key ,'</a></li>';
		}
		else {
			echo '<li><a href="/?s=', $key, '">', $key ,'</a></li>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TestShop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 30px;
      border-radius: 0;
      min-height:80px !important;
    }

    .navbar-nav>li>a {
      line-height:44px;
    }

    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }

    .total {
      font-weight:bold;
      text-align:right;
    }

    .table>tbody>tr>td,
    .table>tfoot>tr>td {
      vertical-align:middle !important;
    }

     .navbar-brand img {
      height:44px;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<!--<div class="jumbotron">
  <div class="container text-center">
    <h1>Congo</h1>      
    <p>Mission, Vission & Values</p>
  </div>
</div>-->

<nav class="navbar navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/"><img src="/logo.png" alt="PayMore" /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
<?php showMenu(); ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/account/"><span class="glyphicon glyphicon-user"></span>Your Account</a></li>
        <li><a href="/cart/"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
      </ul>
    </div>
  </div>
</nav>