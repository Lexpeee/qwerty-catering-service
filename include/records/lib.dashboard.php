

    <div id="errorMessageHere">
    </div>
    <div class="row">
        <?php   
            if($_SESSION["ses_accttype"] == "admin"){
            ?>
                <div class="col-sm-12 col-md-7 p-3 moreblack-bg-color ">
                    <p class="text-center p-2">Package Item Orders:</p>
                    <canvas id="itemOrdersChart" width="100%" height="30"></canvas>
                    <p class="text-center p-2">Package Orders:</p>
                    <canvas id="packageOrdersChart" width="100%" height="30"></canvas>
                </div>
            <?php
            }
        ?>

        <?php
            if($_SESSION["ses_accttype"] == "admin"){
                ?>
                    <div class="col-sm-12 col-md-5 p-3 moreblack-bg-color " style="min-height: 100px">
                    <p class="text-center p-2">Recently added orders:</p>

                    <table class="table table-hover table-bordered recent-orders-table">

                    <?php
                        $getRecentOrders = mysqli_query($conn,"select * from payments order by paylog_date_sent, paylog_time_sent desc limit 10");
                        $rows = mysqli_num_rows($getRecentOrders);
                        if($rows == 0){
                            ?>
                                <div class="alert alert-danger text-center">
                                    There are no recent orders
                                </div>
                            <?php
                        }else{
                            while($viewRO = mysqli_fetch_array($getRecentOrders)){
                                ?>
                                <tr>
                                    <td> 
                                        <?php
                                            if(strtotime($viewRO["paylog_date_req"]) <= strtotime($dateNow)){
                                                ?>
                                                    <span class="dot dot-disabled"></span>
                                                <?php
                                            }else{
                                                switch($viewRO["paylog_status"]){
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

                                                if(strlen($viewRO["paylog_eventname"]) > 25){
                                                    echo substr($viewRO["paylog_eventname"],0,25)."..";
                                                }else{
                                                    echo $viewRO["paylog_eventname"];
                                                }
                                        ?>
                                    </td>   
                                    <td class="text-right"><?php echo date("F d Y", strtotime($viewRO["paylog_date_req"]))?> | <?php echo date("h:ia", strtotime($viewRO["paylog_time_req"]))?> </td>
                                    
                                </tr>
                                <?php
                            }
                    }
                    ?>
                    </table>        
                </div>
                <?php
            }
        ?>
    
        <?php
            if($_SESSION["ses_accttype"] == "admin"){
                ?>
                    <div class="col-12 moreblack-bg-color my-1 p-3">
                        <h3 class="text-center">Sales Report</h3>
                        <canvas id="salesReportChart" width="100%" height="30"></canvas>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <button id="btnMonthlyReport" class="btn infoButton" style="width: 100%">Check this month's report (<?php echo date("F Y");?>)  </button>
                        <script>
                            document.getElementById("btnMonthlyReport").addEventListener("click",function(){
                                window.open("include/libraries/report.php");
                            });
                        </script>

                    </div>
                <?php
            }
        ?>
       
        <?php
            if($_SESSION["ses_accttype"] == "admin"){
                ?>
                    <div class="col-sm-12 col-md-5 moreblack-bg-color my-1">
                <?php
            }else if($_SESSION["ses_accttype"] == "user"){
                ?>
                    <div class="col-sm-12 moreblack-bg-color my-1">
                <?php
            }
        ?>
                
                <?php 
                    $upcomingSchedule = mysqli_query($conn,"select * from payments where paylog_date_req >= '$dateNow' and paylog_time_req >= '$timeNow' and paylog_status = 'Paid' order by paylog_date_req desc limit 1");
                    $results = mysqli_num_rows($upcomingSchedule);
                    if($results == 0){
                        ?>
                            <div class="card border border-secondary my-5">
                                <div class="card-content">  
                                    <div class="card-body">
                                        <div class="mxy-auto p-5 text-center">
                                            There are no upcoming orders.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }else{
                        while($view = mysqli_fetch_array($upcomingSchedule)){
                            ?>
                                    <button class="btn btn-sm primaryButton" onclick="window.open('menu.php','_self')" style="width: 100%;">Order now</button>
                                    <table class="table moreblack-bg-color">
                                        <tr>
                                            <td><?php echo $view["paylog_eventname"]?></td>
                                            <td class="text-right"><?php echo date("Y, F d", strtotime($view["paylog_date_req"]))?></td>
                                        </tr>
                                    </table>
                                <div class="featured-image-slot" style="max-height: 250px;">
                                    <img src="assets/db/up-sched-image.jpg">
                                </div>
                                <button class="btn secondaryButton" href="#upSched" data-toggle="collapse" data-target="#upSched" style="width: 100%;">Current schedule: (<?php echo $view["paylog_eventname"]?>)<br>Click to Expand</button>
                                <div class="black-bg-color">
                                    <div id="upSched" class="collapse moreblack-bg-color">
                                        <table class="table">
                                            <tr>
                                                <th>Category</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                            </tr>
                                            <?php
                                                $getOrderItems = mysqli_query($conn,"select * from inventory_log where inv_payment_id = '".$view["paylog_id"]."'");
                                                while($view2 = mysqli_fetch_array($getOrderItems)){
                                                    ?>
                                                        <tr>
                                                            <td><h5><?php echo $view2["inv_category"]?></h5></td>
                                                            <td><?php echo getItemInfoById($conn,$view2["inv_pcont_id"])["pcont_name"]?></td>
                                                            <td class="text-center"><?php echo $view2["inv_quantity"]?></td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                        </table>      
                                </div>
                            </div>
                        <?php
                        }
                    }
                ?>
        </div>

        <!--  status section -->
        <div class="moreblack-bg-color col-sm-12 col-md-7 p-4 my-1">
            <?php
                $ordersThisMonth = mysqli_query($conn,"select * from payments where MONTH(paylog_date_sent) = '$monthNow'");
                $successfulOrders = mysqli_query($conn,"select * from payments where MONTH(paylog_date_paid) = '$monthNow'");
                $cancelledOrders = mysqli_query($conn,"select * from payments where paylog_status = 'Cancelled'");
                $reservedOrders = mysqli_query($conn,"select * from payments where paylog_status = 'Reserved'");
                $totalOrders = mysqli_query($conn,"select * from payments");
                $paidBeforeDate = mysqli_query($conn,"select * from payments where paylog_date_paid > $dateNow and paylog_status = 'Paid'");
                $registeredUsers = mysqli_query($conn,"select * from useraccounts where acct_type = 'user'");
                $verifiedUsers = mysqli_query($conn,"select * from useraccounts where acct_status = 'verified' and acct_type = 'user'");
                $usersThisMonth = mysqli_query($conn,"select * from useraccounts where month(acct_datereg) = '$monthNow' and acct_type = 'user'");
                //invoices is money
                // make something na nacocount lahat ng bills
            ?>

            <?php
                if($_SESSION["ses_accttype"] == "admin"){
                   ?>
                    <h3 class="text-center">System Status</h3>
                    <hr>
                    <table class="table">

                        <tr>
                            <td>Orders this month: </td><td><?php echo mysqli_num_rows($ordersThisMonth)?></td>
                        </tr>
                        <tr>
                            <td>Successful orders: </td><td><?php echo mysqli_num_rows($successfulOrders)?></td>
                        </tr>
                        <tr>
                            <td>Cancelled orders: </td><td><?php echo mysqli_num_rows($cancelledOrders)?></td>
                        </tr>
                        <tr>
                            <td>Total Orders made: </td><td><?php echo mysqli_num_rows($totalOrders)?></td>
                        </tr>
                        <tr>
                            <td>Reserved Orders: </td><td><?php echo mysqli_num_rows($reservedOrders)?></td>
                        </tr>
                        <tr>
                            <td>Paid Orders before date: </td><td><?php echo mysqli_num_rows($paidBeforeDate)?></td>
                        </tr>
                        
                        <tr>
                            <td>Total Users: </td><td><?php echo mysqli_num_rows($registeredUsers)?></td>
                        </tr>
                        <tr>
                            <td>Total Verified users: </td><td><?php echo mysqli_num_rows($verifiedUsers)?></td>
                        </tr>
                        <tr>
                            <td>Users signed up this month: </td><td><?php echo mysqli_num_rows($usersThisMonth)?></td>
                        </tr>
                    </table>
                   <?php 
                }
            ?>
            
            
            <?php
                if($_SESSION["ses_accttype"] == "admin"){
                    ?>
                        <a href="#" class="btn secondaryButton"> + Add order</a>
                        <a href="#" class="btn secondaryButton"> + Add package</a>
                        <a href="#" class="btn secondaryButton"> + Add menu</a>
                    <?php
                }
            ?>
            
        </div>
        <!-- end of row -->
    </div>
    
    <script>
        var ctx = document.getElementById("packageOrdersChart").getContext('2d');
        var ctx2 = document.getElementById("itemOrdersChart").getContext('2d');
        var salesReport = document.getElementById("salesReportChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                        $getAllPackage = mysqli_query($conn,"select * from packages");
                        
                        while($viewpackageName = mysqli_fetch_array($getAllPackage)){
                            $last = end($viewpackageName);
                            if($viewpackageName == $last){
                                ?>
                                    "<?php echo $viewpackageName["package_name"]; ?>"
                                <?php
                            }else{
                                ?>
                                    "<?php echo $viewpackageName["package_name"]; ?>",
                                <?php
                            }
                        }
                    ?>
                ],
                datasets: [{
                    label: '# of Orders',
                    data: [
                        <?php
                            $getAllPackage = mysqli_query($conn,"select * from packages");
                            while($viewpackageOrders = mysqli_fetch_array($getAllPackage)){
                                $last = end($viewpackageOrders);
                                if($viewpackageOrders == $last){
                                    echo $viewpackageOrders["package_order_counter"];
                                }else{
                                    echo $viewpackageOrders["package_order_counter"].",";
                                }
                            }
                        ?>
                    ],
                    
                    backgroundColor: [
                        
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                legend:{
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                        $getAllPackageItems = mysqli_query($conn,"select * from package_contents order by pcont_ordercounter desc limit 5");
                        
                        while($viewpackageItemName = mysqli_fetch_array($getAllPackageItems)){
                            $last = end($viewpackageItemName);
                            if($viewpackageItemName == $last){
                                ?>
                                    "<?php echo $viewpackageItemName["pcont_name"]; ?>"
                                <?php
                            }else{
                                ?>
                                    "<?php echo $viewpackageItemName["pcont_name"]; ?>",
                                <?php
                            }
                        }
                    ?>
                ],
                datasets: [{
                    label: 'Package Item Orders',
                    data: [
                        <?php
                            $getAllPackageItems = mysqli_query($conn,"select * from package_contents order by pcont_ordercounter desc limit 5");
                            while($viewpackageItemOrders = mysqli_fetch_array($getAllPackageItems)){
                                $last = end($viewpackageItemOrders);
                                if($viewpackageItemOrders == $last){
                                    echo $viewpackageItemOrders["pcont_ordercounter"];
                                }else{
                                    echo $viewpackageItemOrders["pcont_ordercounter"].",";
                                }
                            }
                        ?>
                    ],
                    
                    backgroundColor: [
                        
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                        'rgba(255, 162, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)',
                        'rgba(255, 162, 0, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false,
                    fontSize: 0
                },
                title: {
                    display: false
                },
                scales: {
                    xAxes:[{
                        display: false,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        var myChart3 = new Chart(salesReport, {
            type: 'line',
            data: {
                <?php
                    $monthNow = date("m");
                    $monthInterval = 12 - $monthNow;
                    $yearlyReport = mysqli_query($conn,"select * from payments");
                    
                ?>
                labels: [
                    <?php 
                        for($i = 1; $i <= $monthInterval; $i++){
                            if($i == $monthInterval){
                                ?>
                                    "<?php echo date("F",mktime(0, 0, 0, $i, 10));?>"
                                <?php
                                
                            }else{
                                ?>
                                    "<?php echo date("F",mktime(0, 0, 0, $i, 10));?>",
                                <?php
                                
                            }
                        }
                    ?>
                    ],
                datasets: [{
                    label: 'Sales Report as of this month',
                    data: [
                        <?php
                            $monthInterval = 12 - $monthNow;
                            for($i = 1; $i <= $monthInterval; $i++){
                                $payPerMonth = 0;
                                $reportsPerMonth = mysqli_query($conn,"select * from payments where MONTH(paylog_date_paid) = '$i'");
                                if(mysqli_num_rows($reportsPerMonth) == 0){
                                    $payPerMonth = 0;
                                    if($i != $monthInterval){
                                        echo $payPerMonth.",";
                                    }else{
                                        echo $payPerMonth;
                                    }
                                }else{
                                    $queryGetSales = mysqli_query($conn,"select * from payments where MONTH(paylog_date_paid) = '$i'");
                                    $payPerMonth = null;
                                    while($viewRPM = mysqli_fetch_array($queryGetSales)){
                                        $payPerMonth = $payPerMonth + $viewRPM["paylog_price"];
                                    }
                                    if($i != $monthInterval){
                                        
                                        echo $payPerMonth.",";
                                    }else{
                                        
                                        echo $payPerMonth;
                                    }
                                }
                            }
                        ?>
                    ],
                    
                    borderColor: [
                        'rgba(255, 162, 0, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false,
                    fontSize: 0
                },
                title: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    
    