<?php
    require "inc.dbconnect.php";
    session_start();

    if(isset($_POST["btnSubmitCN"])){
        $CNName = mysqli_real_escape_string($conn,$_POST["txtCNName"]);
        $CNEmail = mysqli_real_escape_string($conn,$_POST["txtCNEmail"]);
        $CNContactNumber = mysqli_real_escape_string($conn,$_POST["txtCNContactNumber"]);
        $CNMessage = mysqli_real_escape_string($conn,$_POST["txtCNMessage"]);
        if(isset($_POST["chkboxNotify"])){
            $CNIsNotify = 1;
            echo "will be notified";
        }else{
            $CNIsNotify = 0;
            echo "will not be notified";
            echo $CNIsNotify;
        }
        $sqlSendMessage = "insert into messagesbox (mbox_name,mbox_email,mbox_contact,mbox_message,mbox_datesent,mbox_timesent,mbox_type,mbox_isNotified) values ('$CNName','$CNEmail','$CNContactNumber','$CNMessage','$dateNow','$timeNow','contactform','$CNIsNotify')";
        $sendResult = mysqli_query($conn,$sqlSendMessage);
        $sqlNotify = "insert into notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','1','Administrator received a non-client message','messagesbox')";
        $notifyResult  = mysqli_query($conn,$sqlNotify);
        if($sendResult){
            header("location:../preview.php?contactsent");
        }else{
            header("location:../preview.php?contactnotsent");
        }
    }

    if(isset($_POST["btnSubmitReason"])){
        if(isset($_POST["txtReason"]) && isset($_POST["txtCancelName"])){

            $id = $_POST["hidOrderID"];
            $name = $_POST["txtCancelName"];
            $orderID = $_POST["hidOrderID"];
            $message = $_POST["txtReason"]."<br>Order No: ".$orderID;
            $sqlChangeStatus = "update payments set paylog_status = 'Cancelled' where paylog_id = '$id'";
            $queryChangeStatus = mysqli_query($conn,$sqlChangeStatus);
            if($queryChangeStatus){
                $sendCancelMessage = mysqli_query($conn,"insert into messagesbox (mbox_name,mbox_email,mbox_contact,mbox_message,mbox_type,mbox_datesent,mbox_timesent) values ('$name','null','null','$message','ordercounter','$dateNow','$timeNow')");
                if($sendCancelMessage){
                    echo "worls!";
                    echo "<br>";
                    header("location: ../preview.php");
                }else{
                    var_dump($conn);
                }
            }
            
            
        }
    }

    
?>