<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Maps</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">

	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fonts/font-awesome.css" />


</head>
<body>

<!-- Settings Div -->
<div id="skin-toolbox" class="col-lg-4 col-md-6 col-sm-12">
    <div class="panel">
        <div class="panel-heading">
        <span class="panel-icon">
          <i class="fa fa-cogs"></i>
        </span>
            <span class="panel-title"> Settings</span>
        </div>
        <div class="panel-body">

          <div class="form-group">
          <label>Radius <small>(Default is 50km)</small></label>
          <input type="number" class="form-control" value="50" min="1" placeholder="Radius" id="radius">
          </div>   

          <div class="form-group">
          <label>Tweets Number <small>(Default is 15)</small></label>
          <input type="number" class="form-control" value="15" min="10" max="100" placeholder="Tweets Number" id="tweets_num">
          </div>   

        </div>
    </div>
</div>
<!-- End Settings Div -->
    
    <!-- Search box -->
    <div class="col-lg-4 col-md-5 col-sm-11" id="search">
    <h1 style="color:#1da1f2"><i class="fa fa-twitter"></i> Maps</h1>
    <div class="input-group input-group-lg">
    <span class="input-group-addon" id="basic-addon3"><i class="fa fa-map-marker"></i></span>
      <input type="text" class="form-control" placeholder="City Name" id="city_name">
      <span class="input-group-btn">
        <button class="btn btn-info" type="button" id="search_btn">Search</button>
      </span>
    </div>
    <div id="oper"></div>
    </div>
    <!-- End Search box -->

    <!-- Display Map Div -->
    <div class="search col-md-12" id="results"></div>

  <script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
</script>

<script type='text/javascript' src='<?php echo base_url(); ?>js/GetMaps.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.locationpicker.js'></script>
<script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUzyEaszncy5tactSdYzJDkcd-fYJSris"></script>
<script type="text/javascript">
  $('#skin-toolbox .panel-heading').on('click', function() {
        $('#skin-toolbox').toggleClass('toolbox-open');
      });
</script>
</body>
</html>