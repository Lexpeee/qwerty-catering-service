

<div id="writeMessageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="messageTable" method="post" action="include/functions.php">
                <div class="modal-header">
                    <h5>Write a message</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtBoxName">Name of Receipient</label>
                        <input id="txtBoxName" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtBoxMessage">Message:</label>
                        <textarea id="txtBoxMessage" class="form-control" rows="4"></textarea>
                    </div>
                    <input type="btnSendMessage" name="btnSendMessage" class="btn btn-success form-control" value="Send Message">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="moreblack-bg-color p-3">
    <form action="include/functions.php" method="post">
        <input type="hidden" name="hidval" value="Here is a hidden value!">
            
            <!-- <input type="button" name="btnSentMessages" class="btn btn-warning" value="View Sent Messages"> -->
                <?php
                    if($_SESSION["ses_accttype"] == "admin"){
                        $sqlGetMessages = "select * from messagesbox order by mbox_datesent desc, mbox_timesent desc ";
                    }else if($_SESSION["ses_accttype"] == "user"){
                        $sqlGetMessages = "select * from messagesbox where mbox_receiver_id = '".$_SESSION["ses_uid"]."' order by mbox_datesent, mbox_timesent desc";
                    }
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
                <button type="button" class="btn btn-sm secondaryButton" data-toggle="modal" data-target="#writeMessageModal"><i class="fas fa-envelope fa-lg"></i>   Write a Message</button>
                <input type="submit" name="btnDeleteMessages" class="btn btn-sm dangerButton" value="Delete Messages">
                <tr>
                    <th> </th>
                    <th><a href="#" class="link white-color" onclick="sortTable(0)">Name</a></th>
                    <th><a href="#" class="link white-color" onclick="sortTable(1)">Received</a></th>
                    <th><a href="#" class="link white-color" onclick="sortTable(2)">Type</a></th>
                </tr>
                <?php
                        while($viewGM = mysqli_fetch_array($resultGetMessages)){
                ?>
                <tr>
                    <td><input type="checkbox" name="msgrecords[]" value="<?php echo $viewGM["mbox_id"];?>"></td>
                    <td><?php echo $viewGM["mbox_name"]; ?></td>
                    <td><?php echo $viewGM["mbox_datesent"]." ".$viewGM["mbox_timesent"]; ?></td>
                    <td><?php echo $viewGM["mbox_type"]?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#messageModal<?php echo $viewGM["mbox_id"]?>">View</a>     
                    </td>
                </tr>
                <div id="messageModal<?php echo $viewGM["mbox_id"];?>" class="modal fade" tab-index="-1" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p><b>From: </b><?php echo $viewGM["mbox_name"];?></p>
                                <p><b>Message: </b><?php echo $viewGM["mbox_message"];?></p>
                                <p><b>Date and Time Received: </b><?php echo $viewGM["mbox_datesent"]." ".$viewGM["mbox_timesent"]?></p>
                                <p><b>Type: </b><?php echo $viewGM["mbox_type"]?></p>
                                <p><b>Message:<br></b><?php echo $viewGM["mbox_message"]?></p>
                                <a href="#" onclick="deleteMessage('<?php echo $viewGM["mbox_id"];?>')">Delete Message</a>
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
</div>