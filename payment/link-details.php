<?php 


// Include configuration file  
require_once 'config.php'; 

if(isset($_GET['token']) && !empty($_GET['token'])){
    

 ?>
 
 <!DOCTYPE html>
<html>
<head>
	<title>Link Generator - Sketch Iconic</title>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../assets/images/fav.png" type="image/x-icon" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style type="text/css">
			
			body, *{
				font-family: 'Poppins', sans-serif;
			}
		</style>
		 <?php include '../global.php'?>
</head>
<body>
	<div class="container container pb-5 pt-3 col-md-6">
<?php 
    include_once 'db-connect.php';
$sql = "SELECT * FROM orders WHERE link_token = '" . $_GET['token'] . "'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row['project_name'];
    $email = $row['email'];
    $description = $row['description'];
    $item_price = $row['item_price'];
    $item_price_currency = $row['item_price_currency'];
    $payment_s = $row['payment_status'];
    $packages = $row['packages'];
    $link_token = $row['link_token'];
    $sale_mail = $row['sales_email'];
} ?>

		<input type="text" value="https://sketchiconic.com/payment/paynow.php?token=<?= $link_token ?>" id="myInput" style="opacity: 0;"><br>
		<img src="../assets/images/logo.png" class="mb-4" style="width: 300px;">
		<h1>Link Generator</h1>
		<h3 class="mt-3 mb-4">Project Detail</h3>
		<p><strong>Project Name:</strong> <?= $name ?></p>
		<p><strong>Client Email:</strong> <?= $email ?></p>
		<p><strong>Amount:</strong> <?= $item_price . $item_price_currency ?></p>
		<p><strong>Packages:</strong> <?= $packages ?></p>
		<p><strong>Desc:</strong> <?= $description ?></p>
		<a class="btn btn-primary mb-3"  href="https://sketchiconic.com/payment/paynow.php?token=<?= $link_token ?>">Complete This Invoice</a>
		<button class="btn btn-info  mb-3" id="replaceit" onclick="copyIt()"  href="https://sketchiconic.com/payment/paynow.php?token=<?= $link_token ?>">Copy to clipboard</button>
		<script>
		    function copyIt() {
              /* Get the text field */
              var copyText = document.getElementById("myInput");
            
              /* Select the text field */
              copyText.select();
              copyText.setSelectionRange(0, 99999); /* For mobile devices */
            
              /* Copy the text inside the text field */
              document.execCommand("copy");
              $("#replaceit").html('Link Copied');
            
            
            }
		</script>
		<br>
		<?php if (!empty($sale_mail)) { ?>
			This email is send to <a href="mailto:<?= $sale_mail ?>"><?= $sale_mail ?></a>
		<?php } ?>
		
		<?php }
		else{ ?>
		    <p class="alert alert-danger">No Record Found Matching Your Token!</p>
		 <?php }
		?>
	</div>        	
</body>

</html>
<?php } else{
 header('Location: https://sketchiconic.com/payment');
} ?>