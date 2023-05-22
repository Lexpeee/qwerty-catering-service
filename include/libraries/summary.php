<?php
    require "../inc.dbconnect.php";
    include "../functions.php";
    session_start();

?>
<html>
    <html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Order Summary | QWERTY CATERING</title>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" type="text/css" href="../../vendors/css/mdb-4.11.css">
        <link rel="stylesheet" href="../../vendors/css/style.css">
        <link rel="stylesheet" href="../../vendors/css/fa-svg-with-js.css">
        
        
        <script src="../../vendors/js/fontawesome-all.js"></script>
		<script src="../../vendors/js/jquery-3.3.1.min.js"></script> 

	</head>
        <body>
            <div class="container">
            <?php
                $view = getPaymentRecord($conn,$_REQUEST["sumid"]);
            ?>
                <div class="col-sm-12 text-center">
                    <img id="mainLogo" style="width: 100px;height: 150px;" src="../../assets/logo/qwerty catering WHITE-01.png">
                    

                    <h2>Order Summary</h2>
                    <div id="yellow-bar"></div>
                    <p><em>Transaction ID: <?php echo $view["paylog_id"]?></em></p>
                    <h4>
                        <?php 
                            if(strtotime($view["paylog_date_req"]) <= strtotime($dateNow)){
                                ?>
                                    <span class="dot dot-disabled"></span>
                                <?php
                            }else{
                                switch($view["paylog_status"]){
                                    case "Cancelled":
                                    ?>
                                        <span class="dot dot-danger"></span>
                                    <?php
                                        break;
                                    case "Pending":
                                    ?>
                                        <span class="dot dot-warning"></span>
                                    <?php
                                        break;
                                    case "Reserved":
                                    ?>
                                        <span class="dot dot-secondary"></span>
                                    <?php
                                        break;
                                    case "Paid":
                                    ?>
                                        <span class="dot dot-success"></span>
                                    <?php
                                        break;
                                    default:
                                    ?>
                                        <span class="status-plate status-plate-secondary">Undefined</span>
                                    <?php
                                        break;
                                }
                            }
                            echo $view["paylog_eventname"] 
                        ?>
                    </h4>
                    <p><?php echo $view["paylog_additionalinfo"]?></p>
                    <p><i><strong>Date and Time: </strong><?php echo $view["paylog_date_req"]." ". $view["paylog_time_req"]?></i></p>
                    <p><strong>PAX: </strong><?php echo $view["paylog_pax"]?></p>
                    <p><strong>Items:</strong></p>
                    <ul class="text-center">
                        <?php
                        $fetchPaymentOrders = mysqli_query($conn,"select * from inventory_log where inv_payment_id = '".$view["paylog_id"]."'");
                        while($viewPaymentOrders = mysqli_fetch_array($fetchPaymentOrders)){
                        ?>
                            <li><?php echo getItemInfoById($conn,$viewPaymentOrders["inv_pcont_id"])["pcont_name"]?></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <p><strong>Payment Type:</strong> <?php echo $view["paylog_paytype"] ?></p>
                    <p><strong>Price</strong> <?php echo number_format($view["paylog_price"])?> PHP</p>
                    <p><strong>Status: </strong><?php echo $view["paylog_status"]?></p>
                
                    <p>Date and time paid: <?php echo $view["paylog_date_paid"]." ".$view["paylog_time_paid"]?></p>
                    <p>asdqwe</p>
                </div>
                <div id="buttonsSection">
                    <button type="button" id="btnClose" class="btn secondaryButton text-center">Close</button>
                    <button type="button" id="btnPrint" class="btn primaryButton text-center" onclick="printPage()">Print</button>
                </div>
                <script>
                    document.getElementById("btnClose").addEventListener("click",function(){
                        document.getElementById("buttonsSection").style.display = "none";
                        window.close();
                    });

                    function printPage(){
                        window.print();
                    }
                </script>
            </div>
        </body>
</html>