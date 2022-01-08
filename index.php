<?php

  require_once('include/D_ENGINE.php');
  $conn = new mysqli(GWS_DB_SERVER, GWS_DB_USER, GWS_DB_PASSWORD, GWS_DB_DATABASE);
  $alert = '';
  $fullname  = '';
	$email  = '';
	$employ_date  = '';
	$stateoforigin  = '';
	$lgaoforigin  = '';
	$staff_img = '';
	$trans = '';



  if(isset($_POST['email']) && isset($_POST['fullname']))
  {

  		$fullname  = test_input($_POST['fullname']);
  		$email  = test_input($_POST['email']);
  		$employ_date  = test_input($_POST['employ_date']);
  		//$employ_date = strtotime($employ_date);
  		$stateoforigin  = test_input($_POST['stateoforigin']);
  		$lgaoforigin  = test_input($_POST['lgaoforigin']);

  		if(!empty($_GET['trans']))
  		{
  			$staffid = test_input($_GET['trans']);
  			if(!empty($staffid))
	    	{
	    		if(!empty($_FILES["cover_img_file"]["name"]))
	            {
	                $target_dir = "staff-images/";
	                $imf = basename($_FILES["cover_img_file"]["name"]);
	                $target_file = $target_dir .$tst."_" . $imf;

	                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	                $check = getimagesize($_FILES["cover_img_file"]["tmp_name"]);
	            
	                if($check == false) {
	                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>The file you selected is not an image!</strong></div>";
	                }

	                if (file_exists($target_file)) {
	                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Sorry, file already exists, please select another image.!</strong></div>";
	                
	                }
	                
	                if ($_FILES["cover_img_file"]["size"] > 2000000) {
	                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Sorry, your file is too large.!</strong> select a file lower than 2mb</div>";
	                //500kb 
	                }


	            }

	            if(($alert == ''))
	            {
	            	$rrq = $conn->query("UPDATE stafflist SET staff_name='$fullname', staff_employment_date='$employ_date',staff_state_of_origin='$stateoforigin',staff_lga='$lgaoforigin' WHERE id='$staffid'");
	            	
	            }
	            if(!empty($imf))
	            {
	            	$imf = $tst."_" . $imf;
	               move_uploaded_file($_FILES["cover_img_file"]["tmp_name"], $target_file);
	               $rrq = $conn->query("UPDATE stafflist SET staff_image='$imf' WHERE id='$staffid'");	
	            }
	            header('Location: stafflist');
	    	}
  		}
  		else
  		{
  			$rq = $conn->query("SELECT staff_email FROM stafflist WHERE staff_email = '$email' ");
		    $rr = mysqli_fetch_array($rq);

		    if(empty($rr))
		    {
		    	$rq = $conn->query("INSERT INTO stafflist (staff_name, staff_email, staff_employment_date, staff_state_of_origin, staff_lga) VALUES ('$fullname','$email','$employ_date', '$stateoforigin','$lgaoforigin') ");
		    	$staffid = mysqli_insert_id($conn);
		    	//var_dump($staffid);
		    	//var_dump($conn->error);
		    	//var_dump($employ_date);
		    	if(!empty($staffid))
		    	{
		    		if(!empty($_FILES["cover_img_file"]["name"]))
		            {
		                $target_dir = "staff-images/";
		                $tst = time();
		                $imf = basename($_FILES["cover_img_file"]["name"]);
		                $target_file = $target_dir .$tst."_" . $imf;

		                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		                $check = getimagesize($_FILES["cover_img_file"]["tmp_name"]);
		            
		                if($check == false) {
		                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>The file you selected is not an image!</strong></div>";
		                }

		                if (file_exists($target_file)) {
		                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Sorry, file already exists, please select another image.!</strong></div>";
		                
		                }
		                
		                if ($_FILES["cover_img_file"]["size"] > 2000000) {
		                    $alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Sorry, your file is too large.!</strong> select a file lower than 2mb</div>";
		                //500kb 
		                }


		            }
		           
		            if(($alert == '')&&(!empty($imf)))
		            {
		               
		               $imf = $tst."_" . $imf;
		               move_uploaded_file($_FILES["cover_img_file"]["tmp_name"], $target_file);
		               $rrq = $conn->query("UPDATE stafflist SET staff_image='$imf' WHERE id='$staffid'");	
		               
		                
		            }
		            header('Location: stafflist');
		    	}
		    	else
		    	{
		    		$alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		    	<strong>Something went wrong, data could'nt save - ".$conn->error."</strong></div>";
		    	}
		    }
		    else
		    {
		    	$alert = "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		    	<strong>The Staff with this email already exist</strong></div>";
		    } 

  		} 		   

  }
  
  if(!empty($_GET['trans']))
  {
  		$staffid = test_input($_GET['trans']);
  		$trans = $staffid;
  		$sresultmy = $conn->query("SELECT * FROM stafflist where id='$staffid' ");
    	$rr = mysqli_fetch_array($sresultmy);
    	if(!empty($rr))
    	{
    		$fullname = $rr['staff_name'];
    		$email  = $rr['staff_email'];
			$employ_date  = $rr['staff_employment_date'];
			//$employ_date = strtotime($employ_date);
			$stateoforigin  = $rr['staff_state_of_origin'];
			$lgaoforigin  = $rr['staff_lga'];
			$staff_img  = $rr['staff_image'];
    	}
  }



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

.close
{
	margin-top: -16px;
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
				  <li><a href="stafflist.php">Staff List</a></li>
				  <li><a href="#">Staff Enrollment</a></li>
				</ul>
				<div id="row-content">
                    <div id="content-wrapper">

                        <div class="row">
                            

							<!-- <div class="col-md-5 col-sm-5 col-xs-12 vertical-aligned-element center animate translate-z-in animation-time-1s delay-2s" style="margin: 0 25%;"> -->
							<div class="col-md-5 col-sm-5 col-xs-12 vertical-aligned-element center" style="margin: 0 25%;">
								<!--Content-->
								<h3>Staff Enrollment Form</h3>

								
								
								<!--Mail Form-->
								<p>Data Entry</p>
								<?php
									if(!empty($alert))
									{
										echo $alert;
									}
								?>
								<div class="contactFormf animate__animated animate__bounce">
									<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?trans='.$trans; ?>" method="post" class="mailform row">
										<fieldset>
										<div class="cf_response"></div>
										
										<div class="col-md-12 col-sm-12"> 
											<label> 
												<input class="ordtext " type="text" name="fullname" id="cf_name" placeholder="Staff Fullname" value="<?php echo $fullname;  ?>" tabindex="1"  required /> 
											</label> 
										</div>										
										
										<div class="col-md-12 col-sm-12">
											<label> 
												<input type="email" name="email" placeholder="Staff E-mail" value="<?php echo $email;  ?>" tabindex="3" required /> 
											</label>
										</div> 

										<div class="col-md-12">
											<label> 
												<input type="date" value="<?php echo $employ_date;  ?>"  name="employ_date" id="cf_message" placeholder="Staff Employment Date" tabindex="5" required id="datepicker-multi-dob" /> 
											</label> 
										</div>	


										<?php

											/*LOAD NIGERIA STATE WITH LOCAL GOVERNMENT FILE*/
											$statelga = file_get_contents('assets/Nigeria_state_with_lga.json');
                      						$statelga = json_decode($statelga);

											$state_option = "<option value=''>- Select State of Origin -</option>";
                      						$lga_option = "<option value=''>- Select L.G.A -</option>";


                      						/*POPULATE THE STATE DROPDOWN BUTTON*/

                      						if(!empty($statelga) && is_array($statelga))
						                    {
						                        foreach ($statelga as $key => $allstates) 
						                        {
						                          $kvv = $allstates->states->name;
						                          if(!empty($stateoforigin) && ($stateoforigin == $kvv))
						                          {
						                            $state_option .= "<option value='".$kvv."' selected>".$kvv."</option>";
						                          }
						                          else
						                            $state_option .= "<option value='".$kvv."' >".$kvv."</option>";
						                        }
						                    }



						                    /*POPULATE THE STATE LOCAL GOVERNMENT BUTTON*/

						                    if(!empty($stateoforigin) && !empty($statelga) && is_array($statelga))
						                    {                        
						                        foreach ($statelga as $key => $allstates) 
						                        {
						                          $kvv = $allstates->states->name;                            
						                          if($kvv == $stateoforigin)
						                          {
						                            $lgga = $allstates->states->locals;
						                            foreach ($lgga as $key2 => $all_state_lga) 
						                            {
						                              $mlga = $all_state_lga->name;
						                              if(!empty($lgaoforigin) && ($lgaoforigin == $mlga))
						                              {
						                                $lga_option .= "<option value='".$mlga."' selected>".$mlga."</option>";
						                              }
						                              else
						                                $lga_option .= "<option value='".$mlga."' >".$mlga."</option>";

						                            }
						                            
						                          }
						                          
						                        }
						                        
						                    }

										?>	


										<div class="col-md-12 form">
											<label>
												<select data-live-search="true" name="stateoforigin" class="form-control selectpicker" id=stateoforigin required>
			                                      <?php echo $state_option; ?>
			                                    </select> 
											</label> 
										</div>

										<div class="col-md-12 form">
											<label> 
												<select data-live-search="true" name="lgaoforigin" class="form-control selectpicker" id="lgaoforigin" required>
			                                      <?php echo $lga_option; ?>
			                                    </select> 
											</label> 
										</div>

										<div class="col-md-12" style="margin-bottom: 20px;">
											<label class="control-label col-lg-4 file_upload_label"> 
												<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Format JPG, GIF, PNG. Filesize 8.00 MB max."> Add Staff Image (Recommended Dimension: 600x600px) </span> 
											</label>
				                            <div class="col-lg-3"> 
				                            	<span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i> 
				                            		<span>Attach Staff image</span> 
				                                
				                            		<input type="file" name="cover_img_file" id="fileupload-1" class="picture">
				                              	</span>
				                                <span class="img-cover-1">
				                                  <?php 
				                                      if(!empty($staff_img))
				                                      {
				                                      	 $f_capcover_img = 'staff-images/'.$staff_img;
				                                      	if(file_exists($f_capcover_img))
				                                        	echo '<img src="'.$f_capcover_img.'" width="60" height="60">';
				                                      }
				                                   ?>                                    
				                                </span> <!-- <br> -->
				                                
				                              </div>
										</div>

										

										
										
										<div class="col-md-6 col-sm-6 " style="margin: 0 25%;">
											<button class="button rounded " type="submit">Save Data</button>
											<br>
											<!-- <div class="btn btn-primary" id="testbtn">gg</div> -->
										</div>
										</fieldset>
									</form>
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

  $(".picture").change(function(){
    var eleid = $(this).attr('id');
    var idnum = eleid.split('-');
    idnum = idnum[1];

    if (this.files && this.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('.img-cover-'+idnum).html('<img style="float: right; margin: -45px -165px 0 0px;" src="'+e.target.result+'" width="60" height="60">')
      }

      reader.readAsDataURL(this.files[0]);
    }

   //readURL(this);
 });


  var statelga = '';

  

  $.getJSON('assets/Nigeria_state_with_lga.json', function(data){
      statelga = data;
    }).fail(function(){
      console.log("An error has occurred while loading states.");
  });

    
  

  $("#stateoforigin").change(function()
  {
    var selectedState = $("#stateoforigin").val();
    //alert(statelga[0].states.name);
    var lga_option = '';
    $("#lgaoforigin").html('');
    
    if(statelga != undefined)
    {
    	lga_option += '<option value="">-Select Local Government</option>';
      $.each(statelga, function (index, allstates) 
      {
          var kvv = allstates.states.name;
          if(kvv == selectedState)
          {
            var lgga = allstates.states.locals;
            $.each(lgga, function (index, all_state_lga) 
            {
               var mlga = all_state_lga.name;
               lga_option += '<option value="'+mlga+'">'+mlga+'</option>';
               //console.log(mlga);
            });

          }
      });
      $("#lgaoforigin").append(lga_option);
      $("#lgaoforigin").selectpicker('refresh');


    }
    
 });


  $( "#datepicker-multi-dob" ).datepicker({
    numberOfMonths: 3,
    showButtonPanel: true,
    dateFormat: 'dd M yy'
    });
    $( "#datepicker-multi-yoa" ).datepicker({
    numberOfMonths: 3,
    showButtonPanel: true,
    dateFormat: 'dd M yy'
    }); 


});
	/*$("#testbtn").click(function ()
	{
			alert("hey");

			$.post("index.php",
			{
				getToEva: "legoo",
			},
			function(data, status){
				
				//window.location.assign('assessment_result.php?trans='+tr+'&braker='+braker+gws_mobile_app);
				alert("great");
				
			});
	});*/

	/*$(".ordtext").change(function ()
	{
			alert("hello");
	});*/



</script>

	
</body>
