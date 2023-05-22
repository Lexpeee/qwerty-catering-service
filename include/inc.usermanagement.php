<?php
    require_once "inc.dbconnect.php";
    session_start();
    
    if(isset($_POST["btnLoginSubmit"])){
        
        $username = mysqli_real_escape_string($conn,$_POST["txtUsername"]);
        $password = mysqli_real_escape_string($conn,$_POST["txtPassword"]);

        $sqlFetchAccount = "SELECT * from useraccounts where acct_username = '$username' and acct_password = '$password' ";
        $resultCheck = mysqli_query($conn,$sqlFetchAccount);

        $rows = mysqli_num_rows($resultCheck);
        $view = mysqli_fetch_assoc($resultCheck);
        
        if($rows < 1){
            header("location:../preview.php?signin=nousers");
            exit();
        }else if($rows > 1){
            header("location:../preview.php?signin=duplicateaccounts");
        }else{
            $_SESSION["ses_uid"] = $view["acct_id"];
            $_SESSION["ses_user"] = $view["acct_username"];
            $_SESSION["ses_lname"] = $view["acct_lname"];
            $_SESSION["ses_fname"] = $view["acct_fname"];
            $_SESSION["ses_accttype"] = $view["acct_type"];

            if(!$_POST["txtUsername"] == $view["acct_username"] || !$_POST["txtPassword"] == $view["acct_password"]){
                header("location:../preview.php?signin=invaliduserpass");
            }else{
                if($_SESSION["ses_accttype"] == "user" ){
                    if($view["acct_status"] == "registered"){
                        header("location:../index.php?type=user&status=registered");
                    }else if($view["acct_status"] == "verified"){
                        header("location:../index.php?type=user&status=verified");
                    }else{
                        header("location:../preview.php?signin=statusunknown");
                        
                    }   
                }else if($view["acct_type"] == "admin"){
                    header("location:../adminportal.php");
                }else{
                    header("location:../preview.php?unabletoidentifytype");
                }
            }
        }    
    }
    
    /* user logs out */
    if(isset($_POST["btnLogoutSubmit"])){
        $sqllogout = "update useraccounts set acct_lastlogin_date = '$dateNow',  acct_lastlogin_time = '$timeNow' where acct_id = '".$_SESSION["ses_uid"]."'";
        if(mysqli_query($conn,$sqllogout)){
            session_destroy();
            header("location:../preview.php?success");
        }else{
            print_r($conn);
            echo "theres a problem logging out";
        }
    }
    
    if(isset($_POST["btnRegisterSubmit"])){
        print_r(mysqli_error($conn));
        $username = $_POST["txtUsername"];
        $password = $_POST["txtPassword"];
        $firstname = $_POST["txtFName"];
        $lastname = $_POST["txtLName"];
        $email = $_POST["txtEmail"];
        $contactnumber = $_POST["txtContact"];

        echo $_POST["strCaptchaCode"];
        echo $_POST["txtCaptcha"];
        exit();
        $sqlRegister = "INSERT INTO useraccounts (acct_username,acct_password,acct_type,acct_lname,acct_fname,acct_emailaddress,acct_contact,acct_status,acct_timereg,acct_datereg) values ('$username','$password','user','$lastname','$firstname','$email','$contactnumber','registered','$timeNow','$dateNow')";
        $resultRegister = mysqli_query($conn,$sqlRegister);
        $resultRegister = mysqli_query($conn,$sqlRegister);


        if($resultRegister){
            if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_accttype"]) || $_SESSION["ses_accttype"] == 'admin'){
                header("location:../adminportal.php?success");
            }else{
                header("location:../register.php?reg=success");
                exit();
            }
        }else{
            if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_accttype"]) || $_SESSION["ses_accttype"] == 'admin'){
                header("location:../adminportal.php?error");
            }else{

            }
            header("location:../register.php?reg=error");
            exit();
        }

    }

?>