

<!--USER MESSAGES TAB-->
<div id="writeMessageModal" class="modal fade" onsubmit="submitMessage(event)">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="messageTable" method="post">
                <div class="modal-header">
                    <h5>Write a message</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtBoxName">Name of Recepient</label>
                        <input id="txtBoxName" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxMessage" onkeypress="onkey()">Message:</label>
                        <textarea id="txtBoxMessage" name="txtMessage" class="form-control" rows="4"></textarea>
                    </div>
                    <script>
                        function onkey(){
                            window.alert("asd");
                        }
                    </script>
                    <input type="submit" name="btnSendMessageUC" class="btn btn-success form-control" value="Send Message">
                </div>
            </form>
           
        </div>
    </div>
</div>


<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
    <input type="hidden" name="hidval" value="Here is a hidden value!">
        <button type="button" class="btn secondaryButton" data-toggle="modal" data-target="#writeMessageModal">+ Write a Message</button>
        <input type="submit" id="btnDeleteMessages" name="btnDeleteMessagesUC" class="btn btn-danger" value="Delete Messages">
        <script>
            document.getElementById("btnDeleteMessages").addEventListener(function(){
                window.alert("hey");
            });
        </script>
        <input type="button" name="btnSentMessages" class="btn btn-warning" value="View Sent Messages">
            <?php
            
                $sqlGetMessages = "select * from users_chatbox where ucb_receiver_id = '".$_SESSION["ses_uid"]."'";
                $resultGetMessages = mysqli_query($conn,$sqlGetMessages);
                $rowsGetMessages = mysqli_num_rows($resultGetMessages);
                if($rowsGetMessages == 0){
            ?>
    <div class="alert alert-info">
        There are no records to show.
    </div>
            <?php
                }else{
            ?>
        <table class="table">
            <tr>
                <th> </th>
                <th onclick="sortTable(0)">Username</th>
                <th onclick="sortTable(1)">Received</th>
            </tr>
            <?php
                    while($viewGM = mysqli_fetch_array($resultGetMessages)){
            ?>
            <tr>
                <td><input type="checkbox" name="ucmsgrecords[]" value="<?php echo $viewGM["ucb_id"];?>"></td>
                <td><?php echo $viewGM["ucb_sender_id"]; ?></td>

                <td>
                    <?php echo $viewGM["ucb_date_sent"]." ".$viewGM["ucb_time_sent"];?>
                </td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#messageModal<?php echo $viewGM["ucb_id"]?>">View</a>
                </td>
            </tr>
            <div id="messageModal<?php echo $viewGM["ucb_id"];?>" class="modal fade" tab-index="-1" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p><b>From: </b><?php echo $viewGM["ucb_id"];?></p>
                            <p><b>Message: </b><?php echo $viewGM["ucb_message"];?></p>
                            <p><b>Date and Time Received: </b><?php echo $viewGM["ucb_date_sent"]." ".$viewGM["ucb_time_sent"]?></p>
                            <p><b>Message:<br></b><?php echo $viewGM["ucb_message"]?></p>
                            <a href="#" onclick="deleteMessage('<?php echo $viewGM["ucb_id"];?>')">Delete Message</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                    }
            ?>
            
    </table>
</form>

<?php
    if(isset($_POST["btnSendMessageUC"])){
        $message = $_POST["txtMessage"];
        mysqli_query($conn,"insert into users_chatbox (ucb_sender_id,ucb_receiver_id,ucb_message,ucb_date_sent,ucb_time_sent) values ('".$_SESSION["ses_uid"]."','0','$message','$dateNow','$timeNow')");
        if(isset($sendMessage)){
            header("location: http://". $_SERVER["PHP_SELF"]);
        }
    }

    if(isset($_POST["btnDeleteMessagesUC"])){
        if($_POST["ucmsgrecords"]){
            foreach($_POST["ucmsgrecords"] as $value){
                mysqli_query($conn,"delete from users_chatbox where ucb_id = '$value'");
            }
        }else{
            echo "not checked";
        }
    }
?>