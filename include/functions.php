<?php
    require_once "inc.dbconnect.php";

/*GLOBAL FUNCTIONS*/

    /*global function to fetch records*/
    function fetchRecords($connVariable,$tableName,$tblCond,$tblConA){
        $sql = "select * from '$tableName' where '$tblCond' = '$tblConA' ";
        $result = mysqli_query($connVariable,$sql);
        $view = mysqli_fetch_array($result);
        return $view;
    }

    /*get all records from package contents*/
    function getPackContents($connVariable){
        $sql = "select * from package_contents";
        $result = mysqli_query($connVariable, $sql);
        $view = mysqli_fetch_array($result);
        return $view;
    }

    /*global function to get one from package contents by item id*/
    function getItemInfoById($connVariable, $id){
        $sqlItemID = "select * from package_contents where pcont_id = '$id'";
        $resultItemID = mysqli_query($connVariable,$sqlItemID);
        $viewItemID = mysqli_fetch_array($resultItemID);
        return $viewItemID;
    }

    /*global function to get one from package contents by category id*/
    function getItemInfoByCat($connVariable, $id){
        $sqlItemInfoC = "select * from package_contents where pcont_category_id = '$id'";
        $resultItemInfo = mysqli_query($connVariable,$sqlItemInfoC);
        $viewItemInfo = mysqli_fetch_array($resultItemInfo);
        return $sqlItemInfoC;
    }
    
    /*global function to get one from package contents by package id*/
    function getItemInfoByPack($connVariable, $id){
        $sqlItemInfoP = "select * from package_contents where pcont_package_id = '$id'";
        $resultItemInfo = mysqli_query($connVariable,$sqlItemInfoP);
        $viewItemInfo = mysqli_fetch_array($resultItemInfo);
        return $viewItemInfo;
    }
    
    /*global function to delete from a table*/
    function deleteFromTable($connVar,$tableName,$where1,$cond1){
        $sql = "delete from $tableName where $where1 = $cond1";
        $result = mysqli_query($connVar,$sql);
        return $result;
    }

    //get category detail by id
    function getCategoryDetails($connVar,$id){
        $sql = "select * from categories where cat_id = '$id'";
        $result = mysqli_query($connVar,$sql);
        return mysqli_fetch_assoc($result);
    }

    /*global function to fetch unread notifications*/
    function getAllNotifs($connVariable){
        $sqlGetAll = "select * from notifications where notif_received_user = '".$_SESSION["ses_uid"]."' and notif_isRead = '0'";
        $resultGetAll = mysqli_query($connVariable,$sqlGetAll);
        $rowsGetAll = mysqli_num_rows($resultGetAll);
        if($rowsGetAll > 99){
            echo "99+";
        }else if($rowsGetAll <= 0){
            echo "";
        }else{
            echo $rowsGetAll;
        }        
    }

    /*get user details by user ID*/
    function getUserDetails($connVariable, $userid){
        $sqlGetUser = "select * from useraccounts where acct_id = '$userid'";
        $resultGetUser = mysqli_query($connVariable, $sqlGetUser);
        $view = mysqli_fetch_array($resultGetUser);
        return $view;
    }
    
    /*fetch all packages*/
    function getAllPackage($connVariable){
        $sqlGetAllPackages = "select * from packages";
        $resultGetAllPackages = mysqli_query($connVariable,$sqlGetAllPackages);
        return $resultGetAllPackages;
    }

    
    /*fetch a single package by it's ID*/
    function getPackage($connVariable,$packageID){
        $sqlGetPackage = "select * from packages where package_id = '$packageID'";
        $resultGetPackage = mysqli_query($connVariable,$sqlGetPackage);
        $view = mysqli_fetch_array($resultGetPackage);
        return $view;
    }

    /* fetch a data from inventory log via payment id */
    function getInvLogData($connVariable,$id){
        $sql = "select * from inventory_log where inv_payment_id = '$id'";
        $result = mysqli_query($connVariable,$sql);
        $view = mysqli_fetch_array($result);
        return $view;
    }
    function testFunc($userCondition = null){
        if(isset($userCondition)){
            $var = $userCondition;
            return $var;
        }else{
            $var = "No value!";
            return $var;
        }
    }
    /* fetch all records from payments table */
    function getAllPaymentRecords($connVar, $userCondition = null, $accountID = null){
        if(isset($userCondition)){
            if($userCondition == "admin"){
                $sqlGetRecords = "select * from payments where paylog_account_id = 1 order by 'paylog_date_req', 'paylog_time_req' desc";
                $getRecords = mysqli_query($connVar,$sqlGetRecords);
            }else if($userCondition == "user"){
                if(isset($accountID)){
                    $sqlGetRecords = "select * from payments where paylog_account_id = '$accountID' order by 'paylog_date_req', 'paylog_time_req' desc";
                    $getRecords = mysqli_query($connVar,$sqlGetRecords);
                }else{
                    $sqlGetRecords = "select * from payments where paylog_account_id != '1' order by 'paylog_date_req', 'paylog_time_req' desc";
                    $getRecords = mysqli_query($connVar,$sqlGetRecords);
                }
            }
        }else{
            $getRecords = mysqli_query($connVar,"select * from payments");
        }
        
        $view = mysqli_fetch_array($getRecords);
        return $view;
    }

    /*fetch a single record by a paylog_id*/
    function getPaymentRecord($connVariable, $paylogID){
        $sqlGetRecord = "select * from payments where paylog_id = '$paylogID'";
        $resultGetRecord = mysqli_query($connVariable,$sqlGetRecord);
        $rowsGR = mysqli_num_rows($resultGetRecord);
        if($rowsGR = 0 || $rowsGR > 1){
            //header("location: index.php");
            echo "No records fetched";
        }else{
            $viewGetRecord = mysqli_fetch_array($resultGetRecord);
            return $viewGetRecord;
        }
    }

    /*admin side*/

    /*adminportal.php - clear badge notification counters*/
    function clearNotifCounters($connVar, $section){
        $sqlClear = "update notifications set notif_isRead = 1 where notif_isRead = 0 and notif_type = '$section' ";
        $resultClear = mysqli_query($connVar,$sqlclear);
    }

    /*Messages - dashboard badges*/
    function getMessageNotif($connVariable){
        $sqlMessageNotifications = "select * from notifications where notif_received_user = '".$_SESSION["ses_uid"]."' and notif_type = 'messagesbox' and notif_isRead = '0'";
        $resultMN = mysqli_query($connVariable,$sqlMessageNotifications);
        $rowsMN = mysqli_num_rows($resultMN);
        
        if($rowsMN > 99){
            echo "99+";
        }else if($rowsMN <= 0){
            echo "";
        }else{
            echo $rowsMN;
        }
    }

    /*Schedules - dashboard badges*/
    function getSchedulesNotif($connVariable){
        $sqlSchedulesNotif = "select * from notifications where notif_received_user = '".$_SESSION["ses_uid"]."' and notif_type = 'payments' and notif_isRead = '0'";
        $resultON = mysqli_query($connVariable,$sqlSchedulesNotif);
        $rowsON = mysqli_num_rows($resultON);
        if($rowsON > 99){
            echo "99+";
        }else if($rowsON <= 0){
            echo "";
        }else{
            echo $rowsON;
        }
    }

    /* Payments - gets the total price of a single order via payment Id */
    //TRY TO MAKE ONE FOR THE PAYMENTS DATABASE
    function getTotalPrice($conn,$payid){
        $sql = "select * from inventory_log where inv_payment_id = '$payid'";
        $result = mysqli_query($conn,$sql);
        $totalPrice = 0;
        while($view = mysqli_fetch_array($result)){
            $totalPrice = $totalPrice + $view["inv_price"];
        }
        return $totalPrice;
    }
    
    // function getTotalPrice($payid){
    //     //

    // }




/*AJAX(realtime) FUNCTIONS*/

    /*adminportal.php - delete messages in messagesbox*/
    if(isset($_POST["btnDeleteMessages"])){
        if(isset($_POST["msgrecords"])){
            foreach($_POST["msgrecords"] as $id){
                $sqlDeleteMessages = "delete from messagesbox where mbox_id = '$id'";
                $result = mysqli_query($conn,$sqlDeleteMessages);
                if($result){
                    header("location:../adminportal.php?success");
                }else{  
                    print_r($conn);
                    echo "error deleting multiple messages";
                    header("location:../adminportal.php?success");
                }
            }
        }
        else{
            echo "none checked";
        }
    }
    
    /*adminportal.php - delete a single record in packages table*/
    if(isset($_POST["btnDeletePackages"])){
        $idboxes = $_POST["chkboxpackage"];
        foreach($idboxes as $value){
            if(isset($value)){
                $sqlDeletePack = "delete from packages where package_id = '$value'";
                $resultDeletePack = mysqli_query($conn,$sqlDeletePack);
                $sqlDeletePackItems = "delete from package_contents where pcont_package_id = '$value'";
                $resultDeletePackItems = mysqli_query($conn,$sqlDeletePackItems);

                if(isset($resultDeletePack) && isset($resultDeletePackItems)){
                    header("location: ../adminportal.php?action=success");
                }else{
                    header("location: ../adminportal.php?action=failed");
                }
            }else{
                header("location: ../adminportal.php?action=failed");
            }
        }
        header("location: ../adminportal.php?action=failed");
    }


    /*adminportal.php - delete a single record in payments table(lib.schedules.php) */
    if(isset($_REQUEST["pid"])){    
        $pID = $_REQUEST["pid"];
        if($pID == ""){
            //header("location: ../adminportal.php?empty");
        }else{
            if($_REQUEST["action"] == "delete"){
                $sqlDeleteRecord = "delete from payments where paylog_id = '$pID'";
                $result = mysqli_query($conn,$sqlDeleteRecord);
                if($result){
                    $sqlDelInvData = "delete from inventory_log where inv_payment_id = '$pID'";
                    $resultInv = mysqli_query($conn,$sqlDelInvData);
                    if($resultInv){
                        $paymentID = getPaymentRecord($conn,$pID);
                        $receivedUser = $paymentID['paylog_account_id'];
                        
                        $sqlNotif = "insert into notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_received_user,notif_text,notif_type) values ('$dateNow','$timeNow','0','$receivedUser','Administrator discarded a request ','payments')";
                        $resultNotif = mysqli_query($conn,$sqlNotif);
                        if($resultNotif){
                            //header("location: ../index.php");
                            echo "success!";
                            print_r($conn);
                            echo "<hr>";
                            echo $sqlNotif;
                            echo $resultNotif;
                            echo "<hr>";
                            print_r($resultNotif);
                        }else{
                            //header("location: ../index.php");
                            echo "failed";
                            print_r($conn);
                        }
                    }
                }else{
                    //header("location: ../adminportal.php");
                }
            }
            
            if($_REQUEST["action"] == "changeschedtop"){
                $changeResult = mysqli_query($conn,"update payments set paylog_status = 'Paid' where paylog_id = '$pID'");
                if($changeResult){
                    $sqlNotif = "insert into notifications (notif_date_generated,notif_time_generated,notif_isRead,notif_text,notif_type) values ('$dateNow','$timeNow','0','Administrator: payment ID No. '$pID' has paid ','payments')";
                }
            }
            
        }
    }

    
    

    //add packages to package contents db
    if(isset($_POST["btnAddPackage"])){
        $packageName = $_POST["txtPackageName"];
        $packageCat = $_POST["txtPackageCategory"];
        $packageDesc = $_POST["txtPackageDesc"];
        
        //packages
        $sqlAddPackageName = "insert into packages (package_name,package_category,package_desc,package_order_counter,package_rating) values ('$packageName','$packageCat','$packageDesc','0','0')";
        if($resultAddPackage = mysqli_query($conn,$sqlAddPackageName)){
            $contName = $_POST["txtContName"];
            $category = $_POST["txtCategoryName"];
            $price = $_POST["txtPrice"];
            
            //adding to package contents
            foreach($contName as $key => $var1){
                echo "<br>";
                if(!empty($contName[$key]) || !empty($category[$key]) || !empty($price[$key])){
                    //find package
                    $sqlFindPackage = "select * from packages where package_name = '$packageName' and package_category = '$packageCat' and package_desc = '$packageDesc'";
                    if($resultFP = mysqli_query($conn,$sqlFindPackage)){
                        //fetch package ID from packages
                        $packageID = mysqli_fetch_array($resultFP)["package_id"];
                        //check if category name exists inside category db
                        $sqlFindCat = "select * from categories where cat_name = '$category[$key]'";
                        //checks if category exists

                        if($resultFindCat = mysqli_query($conn,$sqlFindCat)){
                            if(mysqli_num_rows($resultFindCat) > 1){
                                print_r($conn);
                                //header("location: ../adminportal.php?action=failed");
                            }else{
                                //insert to categories db if not exists
                                $sqlInsertCat = "insert into categories (cat_name,cat_isshow) values ('$category[$key]','1')";
                                if($resultInsertCat = mysqli_query($conn,$sqlInsertCat)){
                                    //fetch category details
                                    $sqlFetchCat = "select * from categories where cat_name = '$category[$key]'";
                                    if($resultFetchCat = mysqli_query($conn,$sqlFetchCat)){
                                        if(mysqli_num_rows($resultFetchCat) != 1){
                                            $catID = mysqli_fetch_array($resultFetchCat)["cat_id"];
                                            //add to package contents database
                                            $sqlAddToPackageContent = "insert into package_contents (pcont_name,pcont_category_id,pcont_price,pcont_ordercounter,pcont_package_id) values ('$contName[$key]','catID','$price[$key]','0','$packageID')";
                                            
                                            if($result = mysqli_query($conn,$sqlAddToPackageContent)){
                                                header("location: ../adminportal.php?addedsuccessfully");
                                                echo "success!";
                                            }else{
                                                print_r($conn);
                                                echo "categories exist!";
                                            }
                                        }else{
                                            print_r($conn);
                                        }
                                    }else{
                                        print_r($conn);
                                        //header("location: ../adminportal.php?action=failed");
                                    }
                                }
                            }
                            //success area
                        }
                    }else{
                        echo "error finding package(program error)";
                    }               
                }else{ 
                    echo "nope1";
                }
            }
        }
        
    }

    
    