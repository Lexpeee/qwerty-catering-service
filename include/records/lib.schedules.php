    <!-- legend box -->
    <div class="moreblack-bg-color p-3">
        <h4 class="text-center">Status Indicators:</h4>
        <div class="row">
            <div class="col-sm-12 col-md-3"><span class="dot dot-secondary"></span>Reserved</div>
            <div class="col-sm-12 col-md-3"><span class="dot dot-success"></span>Paid</div>
            <div class="col-sm-12 col-md-3"><span class="dot dot-warning"></span>Pending Payment</div>
            <div class="col-sm-12 col-md-3"><span class="dot dot-danger"></span>Cancelled</div>
        </div>
    </div>

    <!-- <button type="button" class="btn btn-success" onclick="window.open('menu.php','_self');">+ Add Order</button> -->
    
    <!-- <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul> -->

    <div id="scheduleTab" class="moreblack-bg-color p-3">
        <?php
        if($_SESSION["ses_accttype"] == "user"){
            $viewRows = getAllPaymentRecords($conn,$_SESSION["ses_accttype"],$_SESSION["ses_uid"]);
        }else if($_SESSION["ses_accttype"] == "admin"){
            $viewRows = getAllPaymentRecords($conn);
        }
            $rowsGetSchedule = $viewRows;
            if($rowsGetSchedule == 0){
        ?> 
                <div class="alert alert-primary">
                    There are no records as of now.
                </div>
        <?php
            }else{
        ?> 
                <form id="scheduleForm" action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                    <table id="scheduleTable" class="table table-hover"> 
                        <tr>
                                
                            <th><a href="#"  class="link white-color" onclick="sortTable(0,'scheduleTable')">ID</a></th>
                            <th><a href="#" class="link white-color" onclick="sortTable(1,'scheduleTable')">Event Name:</a></th>
                            <th><a href="#" class="link white-color" onclick="sortTable(2,'scheduleTable')">Schedule:</a></th>
                            <th><a href="#" class="link white-color" onclick="sortTable(3,'scheduleTable')">From:</a></th>
                            <th><a href="#" class="link white-color" onclick="sortTable(4,'scheduleTable')">Status:</a></th>
                        </tr>
                    <?php
                        if($_SESSION["ses_accttype"] == "user"){
                            $sqlGetSchedule = "select * from payments where paylog_account_id = '".$_SESSION["ses_uid"]."' order by 'paylog_date_req','paylog_time_req' desc";
                        }else if($_SESSION["ses_accttype"] == "admin"){
                            $sqlGetSchedule = "select * from payments order by 'paylog_date_req', 'paylog_time_req' desc";
                        }
                        $resultGetSchedule = mysqli_query($conn,$sqlGetSchedule); 
                        while($viewGS = mysqli_fetch_array($resultGetSchedule)){
                    ?>
                        <tr>
                            <td>
                                <?php echo $viewGS["paylog_id"]?>
                            </td>
                            <td>
                                <?php echo substr($viewGS["paylog_eventname"],0,10)."..";?>
                            </td>
                            <td>
                                <?php echo $viewGS["paylog_date_req"]."   |   ".$viewGS["paylog_time_req"]; ?>
                            </td>
                            <td>
                                <?php
                                    $user = getUserDetails($conn,$viewGS["paylog_account_id"]);
                                    if(empty($user["acct_username"])){
                                        echo "----";
                                    }else{
                                        echo $user["acct_username"];
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <?php 
                                            switch($viewGS["paylog_status"]){
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
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-right"><a href="#" class="btn btn-info active" data-toggle="modal" data-target="#eventInfoModal<?php echo $viewGS["paylog_id"]?>">View</a></div>
                            </td>
                        </tr>
                        
                        <div id="eventInfoModal<?php echo $viewGS["paylog_id"]?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="m-auto">Event Info: </p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-auto">
                                            <div class="col-sm-12">
                                                <img src="assets/featuredimg.jpg" class="package-containers" style="width: 100%;">
                                                <h3 class="text-center"><?php echo $viewGS["paylog_eventname"];?></h3>
                                                <?php
                                                    $viewPackage = getPackage($conn,$viewGS["paylog_package_id"]);
                                                    echo "<p>".$viewGS["paylog_additionalinfo"]."</p>"
                                                ?>
                                                <hr>
                                            </div>
                                            <div class="col-sm-12">
                                                <ul>
                                                <?php
                                                    $paylogid= $viewGS["paylog_id"];
                                                    $sqlInv = "select * from inventory_log where inv_payment_id = '$paylogid'";
                                                    $resultInv = mysqli_query($conn,$sqlInv);
                                                    while($viewInv = mysqli_fetch_array($resultInv)){
                                                ?>  
                                                    <li><?php echo getItemInfoById($conn,$viewInv["inv_pcont_id"])["pcont_name"]?></li>
                                                <?php
                                                    }
                                                ?>
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                
                                                <p>Date Received: <?php echo $viewGS["paylog_date_sent"]?></p>
                                                <p>Date Requested: <?php echo $viewGS["paylog_date_req"]?></p>
                                                <p>Payment Type: <?php echo $viewGS["paylog_paytype"]?></p>
                                                <p>Price: <?php echo number_format($viewGS["paylog_price"])?> PHP </p>
                                                <p>Status: <?php echo $viewGS["paylog_status"]?></p>
                                            </div>
                                            <div class="col-sm-12">
                                                        
                                                <?php
                                                if($viewGS["paylog_status"] != "Paid"){
                                                    ?>
                                                        <button onclick="changeSchedule(<?php echo $viewGS['paylog_id'];?>)" type="button" class="btn btn-info active">Change to paid user</button>
                                                    <?php
                                                }
                                                    if($_SESSION["ses_accttype"] == "admin"){
                                                        ?>
                                                            <button onclick="deleteSchedule(<?php echo $viewGS['paylog_id'];?>)" class="btn dangerButton btn-sm" data-dismiss="modal">+ Delete Schedule</button>
                                                            <button type="button" id="btnEditSchedule" class="btn secondaryButton btn-sm" onclick="editScheduleWindow(<?php echo $viewGS["paylog_id"]?>)">Edit Schedule</button>
                                                        <?php
                                                    }

                                                    if($viewGS["paylog_paytype"] == "Paypal" && $viewGS["paylog_status"] != "Paid" && $_SESSION["ses_accttype"] != "admin"){
                                                        ?>
                                                            <div id="paypal-button"></div>
                                                            <!-- PAYPAL API SCRIPT -->
                                                            <script>
                                                                paypal.Button.render({
                                                                env: 'sandbox', // Or 'sandbox',

                                                                    client: {
                                                                        sandbox: 'AZ6Kq-_WiphZbehKuUg71uiN4ty1AsXrhPkPsTcIoTCtUBPfcdLElZoWbJbw7IrTMUhbO0MPKnFMoQV5' 
                                                                    },

                                                                commit: true, // Show a 'Pay Now' button

                                                                style: {
                                                                    color: 'blue',
                                                                    size: 'small'
                                                                },

                                                                payment: function(data, actions) {
                                                                    return actions.payment.create({
                                                                        payment: {
                                                                            transactions: [
                                                                                {
                                                                                amount: { total: '1.00', currency: 'USD'}
                                                                                }
                                                                            ]
                                                                        }
                                                                    });
                                                                },

                                                                onAuthorize: function(data, actions) {
                                                                    return actions.payment.execute().then(function(){
                                                                        window.alert("Payment Complete!");
                                                                        document.getElementById("buttonSendForm").style.display = "inline";
                                                                    });
                                                                },

                                                                onCancel: function(data, actions) {
                                                                    return actions.payment.execute().then(function(){
                                                                        window.alert("You have cancelled the payment! Please wait.."); 
                                                                        });
                                                                },

                                                                onError: function(err) {
                                                                    return actions.payment.execute().then(function(){
                                                                        window.alert("Something's not right"); 
                                                                        });
                                                                }
                                                                }, '#paypal-button');
                                                            </script>
                                                        <?php
                                                    }
                                                ?>

                                                <button type="button" id="btnSummary" class="btn secondaryButton btn-sm" onclick="getPaymentSummary(<?php echo $viewGS['paylog_id']?>)">+ View Full Details</button>                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php        
                            } 
                    ?>
                    </table>

                </form>
            
            
        <script>
            
            function changeSchedule(id){
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200 ){
                        console.log(this.responseText);
                        window.location.reload();
                        document.getElementById("list-schedule").innerHTML = document.getElementById("list-schedule").innerHTML;
                    }
                }
                xhttp.open("GET","include/functions.php?pid="+id+"&action=changeschedtop",true);
                xhttp.send();
                
            }

            function deleteSchedule(id){
                //window.open('include/functions.php?pid='+id,'_self');window.alert("Record(s) successfully deleted");
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        //console.log(this.responseText);
                        //setTimeout("#scheduleTab",1000);
                        window.location.reload();
                        document.getElementById("list-schedule").innerHTML = document.getElementById("list-schedule").innerHTML;
                    }
                }
                xhttp.open("GET","include/functions.php?pid="+id+"&action=delete",true);
                xhttp.send();
            }

            function editScheduleWindow(payid){
                window.open("include/libraries/editschedule.php?schedid="+payid,"","width=500,height=700,location=no,resizable=no");    
            }
            
            function getPaymentSummary(payid){
                window.open("include/libraries/summary.php?sumid="+payid,"","width=500,height=700,resizable=no");
            }
        </script>
        <?php
            }
        ?>  
    </div>