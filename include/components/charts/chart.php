
    
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