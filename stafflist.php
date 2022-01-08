<?php

	require_once('include/D_ENGINE.php');
  $conn = new mysqli(GWS_DB_SERVER, GWS_DB_USER, GWS_DB_PASSWORD, GWS_DB_DATABASE);

  $rq = $conn->query("SELECT * FROM stafflist");
	


?>
<!DOCTYPE html>

<!--[if gt IE 8]><!--> <html class="no-js" lang="zxx"> <!--<![endif]-->


<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Akinsola Samuel Sample">
	
	<!--Title-->
    <title>AKINSOLA SAMUEL</title>
	
	<!--Seo Tags-->
	<meta name="description" content="Your page description here" />
	<meta name="keywords" content="Your meta keywords, here"/>
	<meta name="robots" content="index, follow"> 

	<!--Favicon-->
	<!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon"> -->
	
	<!-- Apple Icon -->
    <!-- <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png"> -->
		
	<!--Fonts-->
	<!-- <link href="https://fonts.googleapis.com/css?family=Overpass:400,700,900" rel="stylesheet"> -->
	<link rel="stylesheet" href="assets/fonts/font-awesome.css" >
	
	<!--General Style-->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="assets/css/mailform.css" type="text/css">
	<!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
	
	
	<!--Color Style-->
	<link rel="stylesheet" href="assets/css/colors/red.css" type="text/css">
	<link rel="stylesheet" href="assets/animate.css">

	<link href="assets/dataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<link href="assets/dataTables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">  
  	<link href="assets/bootstrap/bootstrap-select/bootstrap-select.css" rel="stylesheet" type="text/css"> 
  	<link href="assets/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">


	<style type="text/css">
		input{
			border-radius: 10px !important;
		}
		.fileinput-button input {
	    position: absolute;
	    top: 0;
	    left: 0;
	    margin: 0;
	    opacity: 0;
	    -ms-filter: 'alpha(opacity=0)';
	    width: 180px;
	    cursor: pointer;
	}
	.bs-searchbox .form-control{
		color: #201f1f;
	}
	.breadcrumb { 
	  list-style: none; 
	  overflow: hidden; 
	  font: 18px Sans-Serif;
	}
	.breadcrumb li { 
	  float: left; 
	}
	

	.breadcrumb { 
  list-style: none; 
  overflow: hidden; 
  font: 18px Helvetica, Arial, Sans-Serif;
  margin: 40px;
  padding: 0;
  background: none;
}
.breadcrumb li { 
  float: left; 
}
.breadcrumb li a {
  color: white;
  text-decoration: none; 
  padding: 10px 0 10px 55px;
  background: darkgreen; /* fallback color */
  position: relative; 
  display: block;
  float: left;
}
.breadcrumb li a:after { 
  content: " "; 
  display: block; 
  width: 0; 
  height: 0;
  border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
  border-bottom: 50px solid transparent;
  border-left: 30px solid darkgreen;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  left: 100%;
  z-index: 2; 
} 
.breadcrumb li a:before { 
  content: " "; 
  display: block; 
  width: 0; 
  height: 0;
  border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
  border-bottom: 50px solid transparent;
  border-left: 30px solid lightgray;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  margin-left: 0px;
  left: 100%;
  z-index: 1; 
} 
.breadcrumb li:first-child a {
  padding-left: 10px;
}
.breadcrumb li:nth-child(2) a       { background:        hsla(34,85%,45%,1); }
.breadcrumb li:nth-child(2) a:after { border-left-color: hsla(34,85%,45%,1); }
.breadcrumb li:nth-child(3) a       { background:       darkgreen; }
.breadcrumb li:nth-child(3) a:after { border-left-color: hsla(34,85%,55%,1); }
.breadcrumb li:nth-child(4) a       { background:        darkgreen }
.breadcrumb li:nth-child(4) a:after { border-left-color: hsla(34,85%,65%,1); }
.breadcrumb li:nth-child(5) a       { background:        hsla(34,85%,75%,1); }
.breadcrumb li:nth-child(5) a:after { border-left-color: hsla(34,85%,75%,1); }
.breadcrumb li:last-child a {
  background: lightgray;
  color: black;
  pointer-events: none;
  cursor: default;
}
.breadcrumb li:last-child a:after { border: 0; }
.breadcrumb li a:hover { background: #34b034; }
.breadcrumb li a:hover:after { border-left-color: #34b034; !important; }


.steps {
  margin: 40px;
  padding: 0;
  overflow: hidden;
}
.steps a {
  color: white;
  text-decoration: none;
}
.steps em {
  display: block;
  font-size: 1.1em;
  font-weight: bold;
}
.steps li {
  float: left;
  margin-left: 0;
  width: 150px; /* 100 / number of steps */
  height: 70px; /* total height */
  list-style-type: none;
  padding: 5px 5px 5px 30px; /* padding around text, last should include arrow width */
  border-right: 3px solid white; /* width: gap between arrows, color: background of document */
  position: relative;
}
/* remove extra padding on the first object since it doesn't have an arrow to the left */
.steps li:first-child {
  padding-left: 5px;
}
/* white arrow to the left to "erase" background (starting from the 2nd object) */
.steps li:nth-child(n+2)::before {
  position: absolute;
  top:0;
  left:0;
  display: block;
  border-left: 25px solid white; /* width: arrow width, color: background of document */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width: 0;
  height: 0;
  content: " ";
}
/* colored arrow to the right */
.steps li::after {
  z-index: 1; /* need to bring this above the next item */
  position: absolute;
  top: 0;
  right: -25px; /* arrow width (negated) */
  display: block;
  border-left: 25px solid #7c8437; /* width: arrow width */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width:0;
  height:0;
  content: " ";
}

/* Setup colors (both the background and the arrow) */

/* Completed */
.steps li { background-color: #7C8437; }
.steps li::after { border-left-color: #7c8437; }

/* Current */
.steps li.current { background-color: #C36615; }
.steps li.current::after { border-left-color: #C36615; }

/* Following */
.steps li.current ~ li { background-color: #EBEBEB; }
.steps li.current ~ li::after { border-left-color: #EBEBEB; }

/* Hover for completed and current */
.steps li:hover {background-color: #696}
.steps li:hover::after {border-left-color: #696}



.arrows { white-space: nowrap; }
.arrows li {
    display: inline-block;
    line-height: 26px;
    margin: 0 9px 0 -10px;
    padding: 0 20px;
    position: relative;
}
.arrows li::before,
.arrows li::after {
    border-right: 1px solid #666666;
    content: '';
    display: block;
    height: 50%;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    z-index: -1;
    transform: skewX(45deg);   
}
.arrows li::after {
    bottom: 0;
    top: auto;
    transform: skewX(-45deg);
}

.arrows li:last-of-type::before, 
.arrows li:last-of-type::after { 
    display: none; 
}

.arrows li a { 
   font: bold 24px Sans-Serif;  
   letter-spacing: -1px; 
   text-decoration: none;
}

.arrows li:nth-of-type(1) a { color: hsl(0, 0%, 70%); } 
.arrows li:nth-of-type(2) a { color: hsl(0, 0%, 65%); } 
.arrows li:nth-of-type(3) a { color: hsl(0, 0%, 50%); } 
.arrows li:nth-of-type(4) a { color: hsl(0, 0%, 45%); } 


#product-table thead .heading th, #product-table thead .filter th{border-bottom:none; }
#product-table thead .heading th {font-size: 14px; text-transform:uppercase; color:#FFF;} 
#product-table thead .filter th{
  background :#FFF;
  border-top:none;
  padding-top: 10px;
  padding-bottom:10px;
 
}
#data-tables thead .heading th, #data-tables thead .filter th{border-bottom:none; }
#data-tables thead .heading th {font-size: 14px; text-transform:uppercase; color:#FFF;} 
#data-tables thead .filter th{
  background :#FFF;
  border-top:none;
  padding-top: 10px;
  padding-bottom:10px;
 
}
div.dataTables_length label{margin-bottom:0;}
.dataTables_wrapper .dataTables_length{display:inline; margin-right:10px; float:none;}
.dataTables_wrapper .dataTables_info{display: inline-block; padding-top: 2px; float:none;}  

#data-tables_filter
{
	    position: absolute;
    right: 11px;
    color: white;
}
.dataTables_wrapper .dataTables_filter input
{
	margin-top: -4px !important;
}
.dataTables_length label
{
	color: white;
}
table#data-tables td {
    color: black;
}

	</style>
	
</head>

<body>

<!-- Loading -->
	<!-- <div id="preload">
		<div id="preload-content">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
		</div>
	</div> -->

<!-- Content -->
<div id="outer-wrapper">
	
    <div id="inner-wrapper" style="overflow-y: scroll;">

        <div id="table-wrapper">
            <div class="container">	
            	<ul class="breadcrumb">
				  <li><a href="index.php">Staff Enrollment</a></li>
				  <li><a href="#">Staff List</a></li>
				</ul>
				<div id="row-content">
                    <div id="content-wrapper">

                        <div class="row">
                            

							<!-- <div class="col-md-5 col-sm-5 col-xs-12 vertical-aligned-element center animate translate-z-in animation-time-1s delay-2s" style="margin: 0 25%;"> -->
							<div class="col-md-12 col-sm-12 col-xs-12 vertical-aligned-element center" >
								<!--Content-->
								<h3>Staff List</h3>
								
								
								<div class="contactFormf animate__animated animate__bounce">
										<table id="data-tables" class="table table-responsive table-bordered text-center">
                        <thead class="'.$dayscolor[0].' vd_white">
                        	<th>S/N</th>
                        	<th>Staff Name</th>
                        	<th>Staff Email</th>
                        	<th>Employment Date</th>
                        	<th>State of Origin</th>
                        	<th>LGA</th>
                        	<th>Image</th>
                        	<th>#</th>
                        </thead>
                        <tbody>
                        	<?php 

                        			$ct=1;
                        			$stafimg = '';

                        			
													    if(mysqli_num_rows($rq) >= 1)
															{
															
																while($value = mysqli_fetch_array($rq))
																{
													    		$staff_img = $value['staff_image'];
													    		if(!empty($staff_img))
                                  {
                                  	 $f_capcover_img = 'staff-images/'.$staff_img;
                                  	if(file_exists($f_capcover_img))
                                    	$stafimg = '<img src="'.$f_capcover_img.'" width="60" height="60">';
                                  }
													    		echo '<tr>
							                        		<td> '.$ct.' </td>
							                        		<td> '.$value['staff_name'].' </td>
							                        		<td> '.$value['staff_email'].' </td>
							                        		<td> '.$value['staff_employment_date'].' </td>
							                        		<td> '.$value['staff_state_of_origin'].' </td>
							                        		<td> '.$value['staff_lga'].' </td>
							                        		<td> '.$stafimg.' </td>
							                        		<td> <a href="index.php?trans='.$value['id'].'"><i class="fa fa-edit"></i></a></td>
							                        	</tr>';

							                    $ct++;

													    	}
													    }

                        	?>
                        	
                        </tbody>
                        <tfoot>
                        	<th>S/N</th>
                        	<th>Staff Name</th>
                        	<th>Staff Email</th>
                        	<th>Employment Date</th>
                        	<th>State of Origin</th>
                        	<th>LGA</th>
                        	<th>Image</th>
                        	<th>#</th>
                        </tfoot>
                    </table>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>

		<!-- Background -->
        <div class="background-wrapper overlay ">
            <div class="bg-transfer opacity-50"><img src="assets/img/bg2.jpg" alt=""></div>
			<div id="parallax" class="parallax">
				<div class="scene scene-one"><div class="layer" data-depth="0.20"><img src="assets/img/parallax/1.png" alt="image 2"></div></div>
				<div class="scene scene-two"><div class="layer" data-depth="0.40"><img src="assets/img/parallax/2.png" alt="image 2"></div></div>
			</div>
        </div>
    </div>
</div>

<div class="backdrop"></div>

<!--Java Scripts-->
<script type="text/javascript" src="assets/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.plugin.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>

<script type="text/javascript" src="assets/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/bootstrap/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src='assets/daterangepicker/moment.min.js'></script>
<script type="text/javascript" src='assets/daterangepicker/daterangepicker.js'></script>

<script type="text/javascript">

  
$(window).load(function() 
{
  //"use strict";
  $('#data-tables').dataTable({
                              "lengthMenu": [5, 10, 25, 40, 60, 80, 100],
                              "pageLength": 50
                            });

});



</script>

	
</body>

