<?php 
// Include configuration file  
require_once 'config.php';  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Link Generator - Sketch Iconic</title>
	   <link rel="apple-touch-icon" sizes="76x76" href="../apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../fav">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
        <link rel="icon" href="../favicon.ico" type="image/x-icon" />
        <link rel="manifest" href="../site.webmanifest">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="dist/css/wysiwyg.css" rel="stylesheet">
        <link href="dist/css/highlight.min.css" rel="stylesheet">

<style type="text/css">
	
	body, *{
		font-family: 'Poppins', sans-serif;
	}
	.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #02fdc4;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(2 253 196 / 27%);
}
textarea#desc {
    display: none;
}
div#toolbarGroup-mode, div#toolbarGroup-styles, div#toolbarGroup-fonts, div#toolbarGroup-components, div#toolbarGroup-intervals, div#toolbarGroup-insert, div#toolbarGroup-special {
    display: none;
}
</style>
<?php include '../global.php'?>
</head>
<body>
<div class="container py-5 col-md-6">
	
	<img src="../assets/images/logo.png" class="mb-4" style="width: 300px;">
<h1>Link Generator</h1>
<div class="panel">
    
    <div class="panel-body">
        <!-- Display errors returned by createToken -->
        <div id="paymentResponse"></div>
        
        <!-- Payment form -->
        <form action="link_generator.php" method="POST" class="row" id="paymentFrm">
        	<div class="mt-3 col-md-6">
                <label>Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required="" autofocus="">
            </div><div class="mt-3 col-md-6">
                <label>Currency</label>
                <select name="currency" id="currency" required="" class="form-control">
                	<option value="USD">USD</option>
                	<option value="GBP">GBP</option>
                	<option value="EUR">EUR</option>
                	<option value="CAD">CAD</option>
                </select>
            </div>
            <div class="mt-3 col-md-12">
                <label>Client's Name</label>
                <input type="text" name="p_name" id="p_name" class="form-control" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="mt-3 col-md-12">
                <label>Description</label>
                <textarea name="desc" class="form-control" style="height: 100px;" id="desc" placeholder="Enter description"></textarea>
            </div>
			<div class="mt-3 col-md-12">
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Logo Design">Logo Design
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Stationary Design">Stationary Design
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Website Design">Website Design
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Website Development">Website Development
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Broucher Design">Broucher Design
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Project Status">Project Status
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Digital Marketing">Digital Marketing
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Mobile Application">Mobile Application
                </label>
                <label class="mr-3">
                <input type="checkbox" name="package[]" id="package" class="mr-2" value="Other">Other
                </label>
            </div>
            <div class="mt-3 col-md-6">
                <label>Agents Email</label>
                <input type="email" name="sales_mail" class="form-control">
            </div>            
            <div class="mt-3 col-md-6">
                <label>Client's email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required="">
            </div>

            <div class="mt-3 col-md-12">
            <button type="submit" class="btn-block mt-3 btn btn-primary" id="payBtn">Generate Link</button>
	        </div>
        </form>
    </div>
</div>
</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
           
<script src="dist/js/wysiwyg.js"></script>
        <script src="dist/js/highlight.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#desc').wysiwyg({
                    highlight: true,
                    debug: true
                });
            });
            </script>
</body>
</html>