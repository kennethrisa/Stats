<?php
include("mconfig.php");
?>

<!-- Navigation -->
<nav class="navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand nav2020" href="/"><img src="https://images.discordapp.net/avatars/580514378328309770/9b7f841f67468729167484ee0213cfbb.png?size=64" alt="logo" class="img-rounded"></a> 
            <!-- change top left logo on the line above-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a class="page-scroll" href="#page-top"></a>
                </li>
		        <li><a href="<?php echo $siteURL; ?>">Home</a></li>
                <li><a href="?id=1">Server 1</a></li>
<!--            <li><a href="?id=2">Server 2</a></li>
		        <li><a href="?id=3">Server 3</a></li>
                <li><a href="?id=4">Server 4</a></li>
                <li><a href="?id=5">Server 5</a></li>
                <li><a href="?id=6">Server 6</a></li> -->
                <!-- Uncomment above if you are gonna have multiple servers -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>