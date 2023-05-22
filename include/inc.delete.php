<?php
    session_start();
    require_once "inc.dbconnect.php";

    if(isset($_POST["msgrecords"])){
        foreach($selectedMessages as $id){
            if(isset($_POST["btnDeleteMessages"])){
                $sqlDeleteMessages = "delete from messagesbox where mbox_id = '$id'";
                $result = mysqli_query($conn,$sqlDeleteMessages);
                if($result){
                    header("location:../adminportal.php?success");
                }else{
                    print_r($conn);
                    echo "error deleting multiple messages";
                }
            }        
        }        
    }

    /*delete record from schedule via */
    if(isset($_REQUEST["cancelPayment"])){
        $id = $_REQUEST["cancelPayment"];
        $sqlDelete = "update payments set paylog_status = 'Cancelled' where paylog_id = '$id'";
        mysqli_query($conn,$sqlDelete);
    }

    header("location: ../index.php");
?>

