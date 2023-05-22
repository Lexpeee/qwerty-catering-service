<?php
    require "inc.dbconnect.php";
    include "functions.php";
    session_start();

    if(isset($_POST["btnSendForm"]) || isset($_POST["btnReserveForm"])){
        $lastName = mysqli_real_escape_string($conn,$_POST["txtLName"]);
        $firstName = mysqli_real_escape_string($conn,$_POST["txtFName"]);
        $emailAddress = mysqli_real_escape_string($conn,$_POST["txtEmail"]);
        $contactNumber = mysqli_real_escape_string($conn,$_POST["txtContact"]);
        $address = mysqli_real_escape_string($conn,$_POST["txtAddress"]);
        $proposedDate = mysqli_real_escape_string($conn,$_POST["txtDate"]);
        $proposedTime = mysqli_real_escape_string($conn,$_POST["txtTime"]);
        $eventName = mysqli_real_escape_string($conn,$_POST["txtEventName"]);
        $additionalInfo = mysqli_real_escape_string($conn,$_POST["txtAdditionalInfo"]);
        $paymentType = mysqli_real_escape_string($conn,$_POST["txtPayType"]);
        $pax = mysqli_real_escape_string($conn,$_POST["txtPax"]);
        $totalPrice = mysqli_real_escape_string($conn,$_GET["totalprice"]);
        $packageID = 0;
        

        
        //$findRecord = mysqli_query($conn,"select * from payments where paylog_last")
        $getSameDate = mysqli_query($conn,"select * from payments where paylog_date_req = '$proposedDate'");
        $numRowsSameDate = mysqli_num_rows($getSameDate);
        if(isset($_SESSION["ses_uid"])){
            $sessionUID = $_SESSION["ses_uid"];
            echo $sessionUID;
        }else{
            $sessionUID = 0;
            echo $sessionUID;
        }
        
        if($numRowsSameDate = 0){  /* CHANGE IT TO NOT EQUAL IF ONE WITH TESTING */
            var_dump($getSameDate);
            echo "<br>";
            var_dump($conn);
            echo "Date is existing";
            //header("location: ../order.php?order=existingdate");
        }else{
            
            /*========================*/
            /*         PAYPAL         */
            /*========================*/

            $cartTypes = array();
            foreach($_SESSION["ses_cart"] as $keys => $cartdata){
                array_push($cartTypes, $cartdata["type"]);
            }

            if($paymentType == "Paypal"){
                if(isset($_SESSION["ses_user"]) && isset($_SESSION["ses_uid"]) && isset($_SESSION["ses_lname"]) && isset($_SESSION["ses_fname"]) && isset($_SESSION["ses_accttype"])){
                    
                    /* ===   USER TYPE - PAYPAL   ===*/
                    if($_SESSION["ses_accttype"] == "user"){
                        
                        if(isset($_POST["btnSendForm"])){
                            $sqlSendForm = "INSERT INTO payments (paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent) VALUES ('$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow');";
                            $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                            $action = "paypal";
                        }else if(isset($_POST["btnReserveForm"])){
                            $sqlSendForm = "INSERT INTO payments (paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent) VALUES ('$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow');";
                            $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                            $action = "reserve";
                        }
                        
                        if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                            if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','package');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "package only success! <br>";
                            }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "item only success! <br>";
                            }else{
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','mixed');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "mix success! <br>";
                            }
                        }
                        
                        /*notification*/
                        if($resultSendFormPP){
                            
                            /*inventory logging*/
                            if(!isset($packageID) || $packageID == 0){
                                $packageID = 0;
                            }                        
                            foreach($_SESSION["ses_cart"] as $data){
                                if($data["type"] == "Item"){
                                    echo $data["id"];
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    
                                    $sqlInv = "insert into inventory_log (inv_payment_id,inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_    ) 
                                    values ('$paylogID',$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."','$paylogID',0)";
                                    mysqli_query($conn,$sqlInv);

                                    /* increment item */
                                    
                                }else if($data["type"] == "Package"){     
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    $packageID = $data["id"];
                                    $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                    
                                    $packageResults = mysqli_num_rows($fetchPackageItems);
                                    if($packageResults == 0){
                                        echo "There are no contents in this package.";
                                        break;
                                        }else{
                                            while($view = mysqli_fetch_array($fetchPackageItems)){
                                                echo $view["pcont_name"];
                                                echo "<br>";
                                                $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                                //fix the spam
                                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                                mysqli_query($conn,$sqlInv);
                                                //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                            }
                                            //var_dump($fetchPackageItems);
                                    }
                                }else{
                                    echo "wtfmeyn";
                                    //print_r($conn);
                                }
                            }
                            
                            $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','Administrator has placed a new order paid via Paypal','payments')";
                            $resultNotif = mysqli_query($conn,$sqlNotif);
                            if($resultNotif){
                                var_dump($conn);
                                //header("location:../order.php?order=success");
                            }else{
                                var_dump($conn);
                                //header("location:../order.php?order=failednotif");
                            }
                            
                            var_dump($conn);
                            //header("location:../order.php?order=success");

                            
                            //header("location: ../success.php?action=&uid=&tid=");

                        }else{
                            var_dump($conn);
                        }     
                    }
                    /* ===   ADMIN TYPE - PAYPAL   ===*/
                    else if($_SESSION["ses_accttype"] == "admin"){
                        $cartTypes = array();
                        foreach($_SESSION["ses_cart"] as $keys => $cartdata){
                            array_push($cartTypes, $cartdata["type"]);
                        }

                        if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                            if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                                //package not exist
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','package');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "package only success! <br>";
                            }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "item only success! <br>";
                            }else{
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','mixed');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                    $resultSendFormPP = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                
                                echo "mix success! <br>";
                            }
                        }

                        /*notification*/
                        if($resultSendFormPP){
                            /*inventory logging*/
                            if(!isset($packageID) || $packageID == 0){
                                $packageID = 0;
                            }                        

                            foreach($_SESSION["ses_cart"] as $data){
                                if($data["type"] == "Item"){
                                    echo $data["id"];
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    
                                    $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id) 
                                    values ('$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."','$paylogID')";
                                    mysqli_query($conn,$sqlInv);
                                    
                                }else if($data["type"] == "Package"){     
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    $packageID = $data["id"];
                                    $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                    
                                    $packageResults = mysqli_num_rows($fetchPackageItems);
                                    if($packageResults == 0){
                                        echo "There are no contents in this package.";
                                        break;
                                    }else{
                                            while($view = mysqli_fetch_array($fetchPackageItems)){
                                                echo $view["pcont_name"];
                                                echo "<br>";
                                                $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                                //fix the spam
                                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) 
                                                values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                                //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                                mysqli_query($conn,$sqlInv);
                                            }
                                            //var_dump($fetchPackageItems);
                                    }
                                    
                                }else{
                                    echo "wtfmeyn";
                                    //print_r($conn);
                                }
                                
                            }

                            $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','Administrator has placed a new order paid via Paypal','payments')";
                            $resultNotif = mysqli_query($conn,$sqlNotif);
                            if($resultNotif){
                                var_dump($conn);
                                //header("location:../order.php?order=success");
                            }else{
                                var_dump($conn);
                                header("location:../order.php?order=failednotif");
                            }

                        }else{
                            var_dump($conn);
                            //header("location:../order.php?order=unidentified");
                        }     
                    }
                }else{
                    /* ===   NON-USER TYPE - PAYPAL   ===*/
                    $resultSendFormOH = null;
                    $cartTypes = array();
                    foreach($_SESSION["ses_cart"] as $keys => $cartdata){
                        array_push($cartTypes, $cartdata["type"]);   
                    }

                    if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                        if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                            //package not exist
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','package');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "package only success! <br>";
                        }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','itemsonly');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "item only success! <br>";
                        }else{
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Paid','$dateNow','$timeNow','mixed');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "mix success! <br>";
                        }
                    }
                        
                    /*notification*/
                    if($resultSendFormOH){
                        /*inventory logging*/
                        if(!isset($packageID) || $packageID == 0){
                            $packageID = 0;
                        }                        

                        foreach($_SESSION["ses_cart"] as $data){
                            if($data["type"] == "Item"){
                                echo $data["id"];
                                $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                
                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id) 
                                values ('$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."','$paylogID')";
                                mysqli_query($conn,$sqlInv);
                                
                            }else if($data["type"] == "Package"){     
                                $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                $packageID = $data["id"];
                                $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                
                                $packageResults = mysqli_num_rows($fetchPackageItems);
                                if($packageResults == 0){
                                    echo "There are no contents in this package.";
                                    break;
                                }else{
                                        while($view = mysqli_fetch_array($fetchPackageItems)){
                                            echo $view["pcont_name"];
                                            echo "<br>";
                                            $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                            //fix the spam
                                            $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) 
                                            values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                            //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                            mysqli_query($conn,$sqlInv);
                                        }
                                        //var_dump($fetchPackageItems);
                                }
                                
                            }else{
                                echo "wtfmeyn";
                                //print_r($conn);
                            }
                            
                        }

                        $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','An outsider has requested a new order paid via Paypal','payments')";
                        $resultNotif = mysqli_query($conn,$sqlNotif);
                        if($resultNotif){
                            var_dump($conn);
                            //header("location:../order.php?order=success");
                        }else{
                            var_dump($conn);
                            header("location:../order.php?order=failednotif");
                        }

                    }else{
                        var_dump($conn);
                        echo "hey";
                        //header("location:../order.php?order=faileddetectingtype");
                    }            
                }

            }
            
            /*========================*/
            /*  ON HAND PAYMENT TYPE  */
            /*========================*/
            
            else if($paymentType == "On Hand"){
                    /* ===   USER TYPE - ON HAND   ===*/
                if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_uid"]) || isset($_SESSION["ses_lname"]) || isset($_SESSION["ses_fname"])  && isset($_SESSION["ses_accttype"])){
                    
                    if($_SESSION["ses_accttype"] == "user"){

                        if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                            if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','package');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "package only success! <br>";
                            }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "item only success! <br>";
                            }else{
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','mixed');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "mix success! <br>";
                            }
                        }

                        if($resultSendFormOH = mysqli_query($conn,$sqlSendForm)){
                        
                            /*inventory logging*/
                            if(!isset($packageID) || $packageID == 0){
                                $packageID = 0;
                            }                        

                            foreach($_SESSION["ses_cart"] as $data){
                                if($data["type"] == "Item"){
                                    echo $data["id"];
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    
                                    $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id) 
                                    values ('$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."','$paylogID')";
                                    mysqli_query($conn,$sqlInv);
                                    
                                }else if($data["type"] == "Package"){     
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    $packageID = $data["id"];
                                    $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                    
                                    $packageResults = mysqli_num_rows($fetchPackageItems);
                                    if($packageResults == 0){
                                        echo "There are no contents in this package.";
                                        break;
                                    }else{
                                            while($view = mysqli_fetch_array($fetchPackageItems)){
                                                echo $view["pcont_name"];
                                                echo "<br>";
                                                $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                                //fix the spam
                                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) 
                                                values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                                //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                                mysqli_query($conn,$sqlInv);
                                            }
                                            //var_dump($fetchPackageItems);
                                    }
                                    
                                }else{
                                    echo "wtfmeyn";
                                    //print_r($conn);
                                }
                                
                            }

                            /*notification*/
                            $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','".$_SESSION["ses_user"]." has requested a new order  via On Hand.','payments');";
                            $resultNotif = mysqli_query($conn,$sqlNotif);
                            if($resultNotif){
                                var_dump($conn);
                                //header("location:../order.php?order=success");
                            }else{
                                var_dump($conn);
                                header("location:../order.php?order=failednotif");
                            }
                        }else{
                            var_dump($conn);
                            exit();
                            header("location:../order.php?order=failed");
                        }
                    }
                    /* ===   ADMIN TYPE - ON HAND   ===*/
                    else if($_SESSION["ses_accttype"] == "admin"){
                        
                        if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                            if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','package');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "package only success! <br>";
                            }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "item only success! <br>";
                            }else{
                                if(isset($_POST["btnSendForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','mixed');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "paypal";
                                }else if(isset($_POST["btnReserveForm"])){
                                    $sqlSendForm = "INSERT INTO payments (paylog_account_id,paylog_price,paylog_package_id,paylog_account_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('$sessionUID','".$_GET['totalprice']."','$packageID','$sessionUID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                    $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                    $action = "reserve";
                                }
                                echo "mix success! <br>";
                            }
                        }
                    
                        if($resultSendFormOH){
                            /*inventory logging*/
                            if(!isset($packageID) || $packageID == 0){
                                $packageID = 0;
                            }             
                            foreach($_SESSION["ses_cart"] as $data){
                                if($data["type"] == "Item"){
                                    echo $data["id"];
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id) 
                                    values ('$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."' , '$paylogID')";                                
                                }else if($data["type"] == "Package"){     
                                    $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                    $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                    $packageID = $data["id"];
                                    $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                    
                                    $packageResults = mysqli_num_rows($fetchPackageItems);
                                    if($packageResults == 0){
                                        echo "There are no contents in this package.";
                                        break;
                                    }else{
                                            while($view = mysqli_fetch_array($fetchPackageItems)){
                                                echo $view["pcont_name"];
                                                echo "<br>";
                                                $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                                //fix the spam
                                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) 
                                                values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                                //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                                mysqli_query($conn,$sqlInv);
                                            }
                                            //var_dump($fetchPackageItems);
                                    }
                                    
                                }else{
                                    echo "wtfmeyn";
                                    //print_r($conn);
                                }
                                
                            }

                            /*notification*/    
                            $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','Administrator has placed a new order via On Hand.','payments');";
                            $resultNotif = mysqli_query($conn,$sqlNotif);
                            if($resultNotif){
                                //var_dump($conn);
                                //minute ko yung var dump at header dito
                                //header("location:../order.php?order=success");
                            }else{
                                var_dump($conn);
                                //header("location:../order.php?order=failednotif");
                            }
                        }else{
                            var_dump($conn);
                            exit();
                            header("location:../order.php?order=failed");
                        }
                            
                    }else{ 
                        var_dump($conn);
                        header("location:../order.php?order=faileddetectingtype");
                    }
                }
                /* ===   NON-USER TYPE - ON HAND   ===*/
                else{
                    if(in_array("Item", $cartTypes) || in_array("Package", $cartTypes)){
                        if(!in_array("Item", $cartTypes) && in_array("Package", $cartTypes)){
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','package');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','package');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "package only success! <br>";
                        }else if(in_array("Item", $cartTypes) && !in_array("Package", $cartTypes)){
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','itemsonly');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','itemsonly');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "item only success! <br>";
                        }else{
                            if(isset($_POST["btnSendForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_date_paid,paylog_time_paid,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$dateNow','$timeNow','$eventName','$additionalInfo','$paymentType','$pax','Pending','$dateNow','$timeNow','mixed');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "paypal";
                            }else if(isset($_POST["btnReserveForm"])){
                                $sqlSendForm = "INSERT INTO payments (paylog_price,paylog_package_id,paylog_lname,paylog_fname,paylog_email,paylog_contact,paylog_address,paylog_date_req,paylog_time_req,paylog_eventname,paylog_additionalinfo,paylog_paytype,paylog_pax,paylog_status,paylog_date_sent,paylog_time_sent, paylog_ordertype) VALUES ('".$_GET['totalprice']."','$packageID','$lastName','$firstName','$emailAddress','$contactNumber','$address','$proposedDate','$proposedTime','$eventName','$additionalInfo','$paymentType','$pax','Reserved','$dateNow','$timeNow','mixed');";
                                $resultSendFormOH = mysqli_query($conn,$sqlSendForm);
                                $action = "reserve";
                            }
                            echo "mix success! <br>";
                        }
                    }

                    if($resultSendFormOH){
                            
                        /*inventory logging*/
                        if(!isset($packageID) || $packageID == 0){
                            $packageID = 0;
                        }     
                        
                        foreach($_SESSION["ses_cart"] as $data){
                            if($data["type"] == "Item"){
                                echo $data["id"];
                                $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                
                                $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id) 
                                values ('$sessionUID', '".$data["id"]."', '".$data["quantity"]."', '".$data['price']."', '$dateNow', '$timeNow', '".$data["category"]."','$paylogID')";
                                mysqli_query($conn,$sqlInv);
                                
                            }else if($data["type"] == "Package"){     
                                $getRecentPaymentID = mysqli_query($conn,"select paylog_id from payments where paylog_account_id = '$sessionUID' order by paylog_id desc");
                                $paylogID = mysqli_fetch_assoc($getRecentPaymentID)["paylog_id"];
                                $packageID = $data["id"];
                                $fetchPackageItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '$packageID'");
                                
                                $packageResults = mysqli_num_rows($fetchPackageItems);
                                if($packageResults == 0){
                                    echo "There are no contents in this package.";
                                    break;
                                }else{
                                        while($view = mysqli_fetch_array($fetchPackageItems)){
                                            echo $view["pcont_name"];
                                            echo "<br>";
                                            $data["category"] = getCategoryDetails($conn,$view["pcont_category_id"])["cat_name"];
                                            //fix the spam
                                            $sqlInv = "insert into inventory_log (inv_user_id,inv_pcont_id,inv_quantity,inv_price,inv_date,inv_time,inv_category,inv_payment_id,inv_isPackaged) 
                                            values ('$sessionUID', '".$view["pcont_id"]."', '1', '".$view["pcont_price"]."', '$dateNow', '$timeNow','".$data["category"]."', '$paylogID',1)";                                
                                            //echo "<pre>". var_dump(mysqli_query($conn,$sqlInv)) ."</pre>";
                                            mysqli_query($conn,$sqlInv);
                                        }
                                        //var_dump($fetchPackageItems);
                                }
                                
                            }else{
                                echo "wtfmeyn";
                                //print_r($conn);
                            }
                            
                        }
                        
                        
                        /*notification*/
                        $sqlNotif = "INSERT INTO notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','An outsider has requested a new order via On Hand.','payments');";
                        $resultNotif = mysqli_query($conn,$sqlNotif);
                        if($resultNotif){
                            var_dump($conn);
                            //header("location:../order.php?order=success");
                        }else{
                            var_dump($conn);
                            header("location:../order.php?order=failednotif");
                        }
                        
                    }else{
                        var_dump($conn);
                        exit();
                        header("location:../order.php?order=failed");
                    }
                }
            }
            //Latest Transaction ID registered
            //$getLatestRecord = mysqli_query($conn,"select paylog_id,max(paylog_date_sent),max(paylog_time_sent) as most_recent_record from payments group by paylog_id");
            $getLatestRecord = mysqli_query($conn,"select * from payments where paylog_account_id = '$sessionUID' and paylog_date_sent >= '$dateNow' and paylog_time_sent >= '$timeNow' order by paylog_time_sent desc limit 1");
            $latestRecord = mysqli_fetch_assoc($getLatestRecord);
                echo "<br>";
                $tid = $latestRecord["paylog_id"];
                unset($_SESSION["ses_cart"]);
                header("location: ../success.php?action=$action&uid=$sessionUID&tid=$tid");
        }
    }else{
        $cartTypes = null;
        var_dump($conn);
        echo "<br>";
        echo "There are no results here";
        //header("location:./order.php?order=errorsendingform");
    }
    //session_unset($_SESSION["ses_cart"]);


?>