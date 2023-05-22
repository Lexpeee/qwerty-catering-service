<?php
    session_start();
    require "include/inc.dbconnect.php";
    include "include/functions.php";
    //include "include/inc.scart.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Success | QWERTY Catering</title>

        <?php topLinks(); include "include/components/templates/lib.navbar.comp.php"?>

	</head>
	<body>
   
    <?php include "include/components/templates/lib.navbar.comp.php"?>
        

		<div class="wrapper">
			<div class="container">
                <div class="alert alert-success text-center">

                <?php
                if(isset($_REQUEST["action"]) || isset($_REQUEST["uid"]) || $_REQUEST["tid"]){
                    $action = $_REQUEST["action"]; //status
                    $uid = $_REQUEST["uid"]; //user id
                    $tid = $_REQUEST["tid"]; //transaction number
                    if($action == "paypal"){
                        ?>
                            You have placed an order! Be sure to save your tracking number for you to keep track of your order. 
                            <br><br>Transaction Number: <br> <?php echo $tid;?>
                        </div>
                        <button type="button" class="btn secondaryButton">Go Back</button>
                        <button type="button" class="btn primaryButton" onclick="getPaymentSummary(<?php echo $_REQUEST["tid"]?>)">View Summary</button>
                        
                        <?php
                    }else if($action == "reserve"){
                        ?>
                            You have placed a reservation! Be sure to save your tracking number for you to keep track of your order. 
                            <br><br>Transaction Number: <br> <?php echo $_REQUEST["tid"];?>
                        </div>
                        <button type="button" class="btn secondaryButton">Go Back</button>
                        <button type="button" class="btn primaryButton" onclick="getPaymentSummary(<?php echo $_REQUEST["tid"]?>)">View Summary</button>
                        <?php
                    }else if($action == "onhand"){
                        ?>
                            You have placed an order! Be sure to save your tracking number for you to keep track of your order. Payments should be done 24 hours before the event. 
                            <br><br>Transaction Number: <br> <?php echo $_REQUEST["tid"];?>
                        </div>
                        <button type="button" class="btn secondaryButton">Go Back</button>
                        <button type="button" class="btn primaryButton" onclick="getPaymentSummary(<?php echo $_REQUEST["tid"]?>)">View Summary</button>
                        <?php
                    }else{
                        ?>
                            You have placed an order! Be sure to save your tracking number for you to keep track of your order. 
                            <br><br>Transaction Number: <br> <?php echo $_REQUEST["tid"];?>
                        </div>
                        <button type="button" class="btn secondaryButton">Go Back</button>
                        <button type="button" class="btn primaryButton" onclick="getPaymentSummary(<?php echo $_REQUEST["tid"]?>)">View Summary</button>
                        <?php
                    }?>
                </div>
                <?php
                }else{
                ?>
                    <p>not asdqwe</p>
                
                <?php
                }
                ?>    
                
                <script>
                    function getPaymentSummary(payid){
                        window.open("include/libraries/summary.php?sumid="+payid,"","width=500,height=700,resizable=no");
                    }
                </script>

			</div>

		</div>
        <script src="vendors/js/snackbar.min.js"></script>
		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>