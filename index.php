<!DOCTYPE html>
<html lang="en">

<?php include("mconfig.php"); ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" 
      type="image/png" 
      href="<?php echo $siteFavicon; ?>">

    <title><?php echo $siteName; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/mycustom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<?php include("navbar.php"); ?>

<!-- Page Content -->
<section id="intro" class="intro-section background">
  <div class="container">

<!-- Intro Section -->
<?php include("content.php"); ?>
<!-- Footer -->
<footer>
  <div class="row">
    <div class="col-lg-12">
      <hr><br>
        <p class="pull-right"><a href="#page-top"><i class="fa fa-angle-double-up fa-2x" title="Back to top"></i></a></p>
        <p class="text-center">2020 &middot; <a href="<?php echo $siteURL; ?>"><?php echo $siteName; ?></a> &middot;</p>
    </div>
  </div>
    <!-- /.row -->
</footer>
</div>
<!-- Container -->
</section>

    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Scrolling Nav JavaScript -->
    <script src="js/scrolling-nav.js"></script>
</body>
</html>
