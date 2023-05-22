<?php
    require_once "../inc.dbconnect.php";
    include "../functions.php";
    session_start();
?>
<html>
    <html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Edit Schedule | QWERTY CATERING</title>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" type="text/css" href="../../vendors/css/mdb-4.11.css">
        <link rel="stylesheet" href="../../vendors/css/style.css">
        <link rel="stylesheet" href="../../vendors/css/fa-svg-with-js.css">
        
        
        <script src="../../vendors/js/fontawesome-all.js"></script>
		<script src="../../vendors/js/jquery-3.3.1.min.js"></script> 

	</head>
        <body id="editScheduleBody">
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" class="customForm">
            <div class="container">
                <div class="col-sm-12 text-center">
                    <img id="mainLogo" style="width: 100px;height: 150px;" src="../../assets/logo/qwerty%20catering-01.png">
                    
                </div>
                
                <section id="section1">
                    <?php
                        $viewPR = getPaymentRecord($conn,$_REQUEST["schedid"]);
                        if($viewPR){
                    ?>
                        <p class="text-center">Transaction ID: <?php echo $viewPR["paylog_id"]?></p>
                        <table class="table">
                            <h3 class="text-center">
                                <?php echo $viewPR["paylog_eventname"]?>
                            </h3>
                            <p class="text-center">
                                <?php echo $viewPR["paylog_additionalinfo"]?>
                            </p>
                            
                            <tr>
                                <th>Orders:</th>
                                <td>click to see? just list orders here</td>
                            </tr>
                            <tr>
                                <th>Date and time Requested</th>
                                <td><?php echo strftime($viewPR["paylog_date_req"])." ".strftime($viewPR["paylog_time_req"])?></td>
                            </tr>
                            <tr>
                                <th>Payment Type:</th>
                                <td><?php echo $viewPR["paylog_paytype"]?></td>
                            </tr>
                            <tr>
                                <th>Price: </th>
                                <td><?php echo number_format($viewPR["paylog_price"])?> PHP</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><?php echo $viewPR["paylog_status"]?></td>
                            </tr>
                        </table>

                    <?php        
                        }else{
                    ?>
                    
                    <?php
                            echo "unset request variable";
                        }
                    ?>
                </section>
                <section id="section2">
                <input type="hidden" name="paymentId" value="<?php echo $viewPR["paylog_id"] ?>">
                    <h3 class="p-2 text-center">Event Information:</h3>
                    <div class="form-group">
                        <label for="txtBoxEventName">Event Name:</label>
                        <input id="txtBoxEventName" name="txtEventName" type="text" class="form-control" value="<?php echo $viewPR["paylog_eventname"]?>">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxAddInfo">Additional Info:</label>
                        <textarea id="txtBoxAddInfo" name="txtAdditionalInfo" class="form-control" rows="4"><?php echo $viewPR["paylog_additionalinfo"]?></textarea>
                    </div>  
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="txtBoxDateReq">Date Requested:</label>
                                <input id="txtBoxDateReq" name="txtDateReq" type="date" class="form-control" value="<?php echo $viewPR["paylog_date_req"]?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="txtBoxTimeReq">Time Requested:</label>
                                <input id="txtBoxTimeReq" name="txtTimeReq" type="time" class="form-control" value="<?php echo $viewPR["paylog_time_req"]?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="txtBoxPayType">Payment Type:</label>
                        <select id="txtBoxPayType" name="txtPayType" type="text" class="form-control" value="<?php echo $viewPR["paylog_paytype"]?>">
                            <option>Paypal</option>
                            <option>On Hand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtBoxPayStatus">Payment Status:</label>
                        <input id="txtBoxPayStatus" name="txtPaymentStatus" type="text" class="form-control" value="<?php echo $viewPR["paylog_status"]?>">
                    </div>

                    <!-- add something that will change the orders and stuff -->
                    <!-- users -->
                    <h3 class="p-2 text-center">Customer Info:</h3>
                    <div class="form-group">
                        <label for="txtBoxFname">First Name:</label>
                        <input id="txtBoxFname" name="txtFName" type="text" class="form-control" value="<?php echo $viewPR["paylog_fname"]?>">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxLname">Last Name:</label>
                        <input id="txtBoxLname" name="txtLName" type="text" class="form-control" value="<?php echo $viewPR["paylog_lname"]?>">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxAddress">Address:</label>
                        <textarea id="txtBoxAddress"  name="txtAddress"type="text" class="form-control" rows="4"><?php echo $viewPR["paylog_address"]?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtBoxEmail">Email address:</label>
                        <input id="txtBoxEmail" name="txtEmail" type="text" class="form-control" value="<?php echo $viewPR["paylog_email"]?>">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxContact">Contact Number:</label>
                        <input id="txtBoxContact" name="txtContact" type="text" class="form-control" value="<?php echo $viewPR["paylog_contact"]?>">
                    </div>
                </section>
                <button type="button" id="btnClose" class="btn btn-sm secondaryButton text-center">Close</button>
                <button type="button" id="btnEdit" class="btn btn-sm primaryButton text-center">Edit</button>
                <button type="button" id="btnBack" class="btn btn-sm secondaryButton text-center">Back</button>
                <button type="submit" name="btnEditForm" id="btnSave" class="btn btn-sm successButton active text-center">Save</button>
                
                <script>
                    document.getElementById("btnBack").style.display="none";
                    document.getElementById("btnSave").style.display="none";
                    document.getElementById("section2").style.display="none";
                    
                    
                    document.getElementById("btnEdit").addEventListener("click",function(){
                        document.getElementById("btnClose").style.display="none";
                        document.getElementById("btnEdit").style.display="none";
                        document.getElementById("section1").style.display="none";
                        document.getElementById("section2").style.display="inline";
                        document.getElementById("btnBack").style.display="inline";
                        document.getElementById("btnSave").style.display="inline";
                        window.scroll(0,0);
                    });

                    document.getElementById("btnBack").addEventListener("click",function(){
                        document.getElementById("btnClose").style.display="inline";
                        document.getElementById("btnEdit").style.display="inline";
                        document.getElementById("section1").style.display="inline";
                        document.getElementById("section2").style.display="none";
                        document.getElementById("btnBack").style.display="none";
                        document.getElementById("btnSave").style.display="none";
                        window.scroll(0,0);
                    });

                    document.getElementById("btnClose").addEventListener("click",function(){
                        window.close();
                    });
                </script>
            </div>
        </form>
        <?php
            if(isset($_POST["btnEditForm"])){
                $id = mysqli_real_escape_string($conn,$_POST["paymentId"]);
                $eventName = mysqli_real_escape_string($conn,$_POST["txtEventName"]);
                $addInfo = mysqli_real_escape_string($conn,$_POST["txtAdditionalInfo"]);
                $dateReq = mysqli_real_escape_string($conn,$_POST["txtDateReq"]);
                $timeReq = mysqli_real_escape_string($conn,$_POST["txtTimeReq"]);
                $payType = mysqli_real_escape_string($conn,$_POST["txtPayType"]);
                $payStatus = mysqli_real_escape_string($conn,$_POST["txtPaymentStatus"]);
                $fname = mysqli_real_escape_string($conn,$_POST["txtFName"]);
                $lname = mysqli_real_escape_string($conn,$_POST["txtLName"]);
                $address = mysqli_real_escape_string($conn,$_POST["txtAddress"]);
                $email = mysqli_real_escape_string($conn,$_POST["txtEmail"]);
                $contact = mysqli_real_escape_string($conn,$_POST["txtContact"]);

                $sqlUpdateInfo = "update payments set paylog_eventname = '$eventName',paylog_additionalinfo = '$addInfo',paylog_date_req = '$dateReq', paylog_time_req = '$timeReq',paylog_paytype='$payType', paylog_status = '$payStatus',paylog_fname = '$fname',paylog_lname = '$lname',paylog_email = '$email',paylog_address = '$address',paylog_contact = '$contact' where paylog_id = '$id'";
                mysqli_query($conn,$sqlUpdateInfo);
                echo "<script>window.alert('Record successfully updated!');window.close();</script>";
            }
        
        ?>
        </body>
</html>