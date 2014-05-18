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
              <li><a href="/ADASTdashboard">Dashboard</a></li>
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
      				  <li><a href="/ADASTdashboard"><i class="icon-home"></i> Dashboard</a></li>
      		      <li><a href="/ADASTsub"><i class="icon-envelope"></i> Subscribe</a></li>
      		      <li><a href="/ADASTlist"><i class="icon-align-justify"></i> List</a></li>
      		      <li class="divider"></li>
      				  <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
      				  <li><a href="#"><i class="icon-share"></i> Logout</a></li>
      				</ul>
      			</div> <!-- END .well -->
      		</div> <!-- END .sidebar-nav span2 -->

      		<div class="span9 offset2" style="padding-top: 5px">
      			<div class="well" style="width:100%;">
              <table class="table" style="width:100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Alert Type</th>
                    <th>Publisher</th>
                    <th>Applied rule</th>
                    <th>Description</th>
                    <th style="width: 36px;"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Debris Alert</td>
          			    <td>http://vrtestbed.iis.sinica.<br>edu.tw:3000/data/debris<br>_alerts.xml</td>
          			    <td>rule.srl</td>
          			    <td>2012-11-15 07:53:38 UTC</td>
                    <td>
                        <a href="ADAST.php"><i class="icon-search"></i></a>
                        <a href="#"><i class="icon-pencil"></i></a>
                        <a href="#"><i class="icon-remove"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Rain Info</td>
          			    <td>testbbb.com</td>
          			    <td>rain_alert_rules.srl</td>
          			    <td>2012-11-13 02:03:13 UTC</td>
                    <td>
                        <a href="/ADASTdashboard"><i class="icon-search"></i></a>
                        <a href="#"><i class="icon-pencil"></i></a>
                        <a href="#"><i class="icon-remove"></i></a>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Flood Alert</td>
          			    <td>flood.testcccccc.com</td>
          			    <td>Flood_alert.srl</td>
          			    <td>2012-11-13 01:50:09 UTC</td>
                    <td>
                        <a href="/ADASTdashboard"><i class="icon-search"></i></a>
                        <a href="#"><i class="icon-pencil"></i></a>
                        <a href="#"><i class="icon-remove"></i></a>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Earthquake</td>
          			    <td>test.not.monitoring.com</td>
          			    <td>Earthquake_alert_rules.srl</td>
          			    <td>2012-11-13 01:48:39 UTC</td>
                    <td>
                        <a href="/ADASTdashboard"><i class="icon-search"></i></a>
                        <a href="#"><i class="icon-pencil"></i></a>
                        <a href="#"><i class="icon-remove"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="pagination">
              <ul>
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>
            </div>
            <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Delete Confirmation</h3>
              </div>
              <div class="modal-body">
                  <p class="error-text">Are you sure you want to delete the user?</p>
              </div>
              <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  <button class="btn btn-danger" data-dismiss="modal">Delete</button>
              </div>
            </div>
      		</div>

      	</div>
      </div>
    </div> <!-- END .wrapper  -->

    <footer class="footer">
        <div class="container">
            <div class="pull-right">&copy OpenISDM 2012. </div> 
        </div>
    </footer>
  </body>
</html>
