<?php

/**
 *
 * DESCRIPTION:
 *     Subscribe Interested Topics (existing data sources).
 *
 * @author     Sheng-Han Tsai (Jim)
 * @copyright  Open Source
 * @project    OpenISDM (http://openisdm.iis.sinica.edu.tw/)
 *
 */

?>

<html>
  <head>
    <title>OpenISDM ADAST</title>

    <!--css-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">

    <!--js-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div class="navbar">
		  <div class="navbar-inner"> 
		    <div class="container-fluid">

		      <a href="/" class="brand">OpenISDM</a>

		      <!-- collapse navbar for responsive design 
		      ==================================================== -->
		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>

		      <!-- user button 
		      ==================================================== -->
		        <div class="btn-group pull-right">                           
		          <button class="btn dropdown-toggle" data-toggle="dropdown" href="#">
		              <i class="icon-user"></i>
		              <span class="caret"></span>
		          </button>

		          <ul class="dropdown-menu">
		            <li><i class="icon-user"></i> Profile</li>
		            <li><i class="icon-cog"></i> Settings</li>
		            <li class="divider"></li>
		            <li>
		              <i class="icon-eject"></i> Sign out
		            </li>
		          </ul>
		        </div>
		        <!-- END .btn-group .pull-right-->
		 
		      <div class="nav-collapse pull-right">
		        <ul class="nav">
		          <li><a href="/" class="navtab">Home</a></li>
		          <li><a href="list.php">Dashboard</a></li>
		          <li><a href="/maps/googlemap">Map</a></li>
		        </ul>
		      </div>
		      <!-- END .nav-collapse -->
		    </div>
		    <!-- END .container-fluid -->
		  </div>
		  <!-- END .navbar-inner -->
		</div>


		<div class="wrapper">
			<div class="content">
				<div class="row">

					<!-- Sidebar Menu -->
					<div class="span2">
						<div class="well" style="width:200px; padding: 8px 0;">
							<ul class="nav nav-list"> 
							  <li class="nav-header">Admin Menu</li>        
							  <li><a href="list.php"><i class="icon-home"></i> Dashboard</a></li>
					      <li><a href="/ADASTsub"><i class="icon-envelope"></i> Subscribe</a></li>
					      <li><a href="/ADASTlist"><i class="icon-align-justify"></i> List</a></li>
					      <li class="divider"></li>
							  <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
							  <li><a href="#"><i class="icon-share"></i> Logout</a></li>
							</ul>
						</div> <!-- END .well -->
					</div> <!-- END .sidebar-nav span2 -->

					<!-- Sub Page -->
					<div class="span6 offset2" style="padding-top: 15px">

						<div class="input-append" style="width:100%;">
							Subscribe URL:
							<input type="text" id="sub-input" name="" style= "width:90%;"><span class="add-on btn" id="click-validate"><i class="icon-download"></i></span>
						</div> <!-- END .input-append -->

			  		<div class="controls">
			        <label class="radio">
			          <input type="radio" value="option1" name="inlineCheckbox"> Debris Alert
			          
			          <div class="btn-group pull-right">
						  		<a class="btn dropdown-toggle" id="btn-change" data-toggle="dropdown" href="#">
						    		Select rules
						    	<span class="caret"></span>
						  		</a>
						  		<ul class="dropdown-menu">
						    		<li><a href="#" id="btn-change-trigger">rule.srl</a></li>
						    		<li><a href="#"> Debris_alert_rule2.srl </a></li>
						    		<li><a href="#"> Flood_alert.srl </a></li>
						    		<li><a href="#"> Rain_alert_rules.srl </a></li>
						    		<li><a href="#"> Earthquake_alert_rules.srl </a></li>
						  		</ul>
					  		</div> <!-- END .btn-group pull-right -->
			  		
			        </label>
			        <label class="radio">
			          <input type="radio" value="option2" name="inlineCheckbox"> Rain Info
			        </label>
			        <label class="radio">
			          <input type="radio" value="option3" name="inlineCheckbox"> Flood Alert
			        </label>
			        <label class="radio">
			          <input type="radio" value="option3" name="inlineCheckbox"> Earthquake Alert	
			        </label>
			  		
			  		</div> <!-- END .controls -->

			  		<h3 style="color:#777; padding-top:20px;">Rule engine messages<br></h3>

			  		<pre class="well" style="min-height:1px; line-height:15px; border-style:solid; border-width:5px; height:250px;">
			  			<p id="show-validation" style="line-height:15px; width:100%; padding:0px 0px 0px 0px; margin: 0px 0px 0px 0px; white-space:pre-line;" ></p>
			  			<p id="show-validation-text" style="line-height:15px; color:green; width:100%; padding:0px 0px 0px 0px; margin: 0px 0px 0px 0px; white-space:pre-line;"></p>
			  			<p id="show-text" style="line-height:15px; width:100%; padding:0px 0px 0px 0px; margin: 0px 0px 0px 0px; white-space:pre-line;"></p>
						</pre>

						<a href="list.php" class="btn btn-danger pull-right">Submit</a>
			

					</div>	<!-- END .span6 offset2 -->


				</div> <!-- END .row -->
			</div> <!-- END .content -->
		</div> <!-- END .wrapper  -->

		<footer class="footer">
		    <div class="container">
		        <div class="pull-right">&copy OpenISDM 2012. </div> 
		    </div>
		</footer>
	</body>
</html>

<!-- Javascript
======================================== -->
<script type="text/javascript">

	var SUB = {    
    // Variables     
    value:"",
    radio:"",
  };

	$("#btn-change-trigger").click(function(){
		$("#btn-change").html('rule.srl');
		$("#show-text").html('Type: Debris Alert \nRule: rule.srl');
	});

	$("#click-validate").click(function(){
		
		$("#sub-input").keyup(function () {
      //check the url code here
      SUB.value = $(this).val();
    }).keyup();
		$("#show-validation").html("validating...");
    setTimeout(function(){$("#show-validation-text").html("URL '"+SUB.value+"'validated successfully!");}, 1200);
	});

	
</script>
