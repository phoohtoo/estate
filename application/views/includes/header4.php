<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title; ?></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen" charset="utf-8" />
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen" charset="utf-8" />
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/docs.css" type="text/css" media="screen" charset="utf-8" />
 <style type="text/css">
::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		
		background-color: #fff;
		margin: 1px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 9px 9px 10px 9px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		width:1000px;
		margin: 40px 0 40px 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	

		
/* Footer
-------------------------------------------------- */

.footer {
  text-align: center;
  padding: 30px 0;
  margin-top: 70px;
  border-top: 1px solid #e5e5e5;
  background-color: #f5f5f5;
}
.footer p {
  margin-bottom: 0;
  color: #777;
}
.footer-links {
  margin: 10px 0;
}
.footer-links li {
  display: inline;
  padding: 0 2px;
}
.footer-links li:first-child {
  padding-left: 0;
}

table  {
		margin: 10px;
		/* border: 1px solid #D0D0D0; */
		-webkit-box-shadow: 0 0 8px #D0D0D0;
    white-space: normal;
    word-wrap: break-word;
    word-break: break-all;
	  border:1px  #000;
	background:#fff;
	width:80%;
  }
  

	
	</style>
 
</head>
<body>
 <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
 


<div class="container-fluid">

 <header>
	<img  width="100%" src="<?php echo base_url(); ?>assets/images/1000x70.gif"/> 
</header>

<div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" placeholder="Email" type="text">
              <input class="span2" placeholder="Password" type="password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="row">
<div class="span3 bs-docs-sidebar">

        <ul class="nav nav-list bs-docs-sidenav affix-top">
          <li><?php echo anchor('overview/listing','<i class="icon-chevron-right"></i> Overview'); ?></li>
          <li><?php echo anchor('account/listing','<i class="icon-chevron-right"></i> User Account'); ?></li>
          <li><?php echo anchor('type/listing',' <i class="icon-chevron-right"></i>Property Type'); ?></li>
          <li><?php  echo anchor('item/listing','<i class="icon-chevron-right"></i>Property Item'); ?></li>
          <li><?php  echo anchor('setting/listing','<i class="icon-chevron-right"></i>Setting'); ?></li>
        </ul>
		</div>

<div class="span9">
<h1><?php echo $headline; ?></h1> 

