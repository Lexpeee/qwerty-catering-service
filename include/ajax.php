<?php
    session_start();
    require_once "inc.dbconnect.php";
    include "functions.php";

    if(isset($_REQUEST["link"])){
        $link = $_REQUEST["link"];
        /*read all payments*/
        if($link == "payments"){
            $sqlClear = "update notifications set notif_isRead = '1' where notif_type = 'payments' and notif_received_user = '".$_SESSION["ses_uid"]."' ";
            mysqli_query($conn,$sqlClear);
        }

        /*Read all messages*/
        if($link == "messagesbox"){
            $sqlClear = "update notifications set notif_isRead = '1' where notif_type = 'messagesbox' and notif_received_user = '".$_SESSION["ses_uid"]."'";
            mysqli_query($conn,$sqlClear);

        }

        if($link == "notifbutton"){
            $sqlClear = "update notifications set notif_isRead = '1' where notif_received_user = '".$_SESSION["ses_uid"]."'";
            mysqli_query($conn,$sqlClear);
        }
    }

    if(isset($_REQUEST["deletemessage"])){
        $delete = $_REQUEST["deletemessage"];
        if($delete = "value"){
            $sqlDelMessage = "delete from messagesbox where mbox_id = '$delete";
            mysqli_query($conn,$sqlDelMessage);
        }
    }

    /*wtf*/
    if(isset($_REQUEST["halp"])){
        $halp = $_REQUEST["halp"];
        if($halp == 1){
            echo "halp1";
        }
        if($halp == 2){
            echo $_POST["hidval"];
        }
    }
    
    if(isset($_REQUEST["packageid"])){
        $pid = $_REQUEST["packageid"];  
        setcookie($cookieman,$pid,time() + (86400*3),"/");
    }

    
    /* ORDER FORM */
    if(isset($_REQUEST["orderFormAction"]) && isset($_REQUEST["date"])){
        $unixdate = strtotime($_REQUEST["date"]);
        //echo $_REQUEST["date"];
        $date =  $_REQUEST["date"];

        if($date == null){
            echo "<div class='alert alert-danger'>Please select a date</div>";
        }else{
            
            if(date("m", strtotime($date)) <= date("m",strtotime($dateNow)) && date("d", strtotime($date)) <= date("d",strtotime($dateNow))){
                echo "<div class='alert alert-danger'>Sorry! That date already passed.</div>";
            }else{
                $dayLimit = date("d",strtotime($dateNow)) + 3;
                if(date("d",strtotime($date)) < $dayLimit || date("d",strtotime($date)) == date("d",strtotime($dateNow))){
                    echo "<div class='alert alert-warning'>Date shoud be 3 days ahead for us to prepare. </div>";
                }else{
                    $sqlDateCheck = "select * from payments where paylog_date_req = '$date'";
                    $queryDateCheck = mysqli_query($conn,$sqlDateCheck);
                    $rows = mysqli_num_rows($queryDateCheck);
            
                    if($rows != 0){
                        $sqlPaidDates = $sqlDateCheck." and paylog_status = 'Paid'";
                        $queryPaidDates = mysqli_query($conn,$sqlPaidDates);
                        $rowsPaidDates = mysqli_num_rows($queryPaidDates);
                        if($rowsPaidDates != 0){
                            //if bayad
                            echo "<div class='alert alert-danger'>Sorry! This date is already taken. Please choose another.</div>";
                        }else{
                            $sqlReservedDates = $sqlDateCheck." and paylog_status = 'Reserved'";
                            $queryReservedDates = mysqli_query($conn,$sqlReservedDates);
                            $rowsReservedDates = mysqli_num_rows($queryReservedDates);
                            if($rowsReservedDates != 0){
                                echo "<div class='alert alert-info'>This date is available. However there are <strong>$rowsReservedDates</strong> reserved schedules at this date.</div>";
                            }
                        }
                    }else{
                            echo "<div class='alert alert-success'>This date is available</div>";
                    }
                }
            }
        }


    }
?>