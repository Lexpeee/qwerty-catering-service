<?php
    session_start();
    require "include/inc.dbconnect.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sad Project</title>

        <?php topLinks(); include "include/components/templates/lib.navbar.comp.php"?>

	</head>
	<body>

        <div class="wrapper">
            <div class="container">
                <div class="col-6 mx-auto py-5 moreblack-bg-color">
                    <h3 class="text-center">Register an account:</h3>
                    <hr>
                        <?php
                            if(isset($_GET["reg"])){
                                if($_GET["reg"] == "success"){
                        ?>
                        <div class="alert alert-success">
                            &#10003 Success! You have successfully registered for an account. Please verify your account by going to<a href="#"> this link.</a>
                        </div>
                        <?php        
                                }else if($_GET["reg"] == "error"){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            &#10007 Something's gone wrong. Contact your administrator.
                        </div>
                        <?php
                                }
                            }else{
                                
                            }
                        ?>
                    
                    <form class="customForm" name="orderForm" method="post" action="include/inc.usermanagement.php">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="txtBoxUsername">Username</label>
                                <input id="txtBoxUsername" name="txtUsername" type="text" class="inputForm">
                            </div>
                            <div class="form-group">
                                <label for="txtBoxUsername">Password</label>
                                <input id="txtBoxPassword" name="txtPassword" type="password" class="inputForm" maxlength="16">
                            </div>
                            <div class="form-group">
                                <label for="txtBoxUsername">Confirm Password</label>
                                <input id="txtBoxPassword" name="txtPassword" type="password" class="inputForm" maxlength="16">
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="txtBoxFName">First Name: </label>
                                    <input id="txtBoxFName" name="txtFName" type="text" class="inputForm">
                                </div>
                                <div class="form-group col-6">
                                    <label for="txtBoxLName">Last Name: </label>
                                    <input id="txtBoxLName" name="txtLName" type="text" class="inputForm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtBoxEmail">E-mail address: </label>
                                <input id="txtBoxEmail" name="txtEmail" type="text" class="inputForm">
                            </div>
                            <div class="form-group">
                                <label for="txtBoxContact">Contact Number: </label>
                                <input id="txtBoxContact" name="txtContact" type="text" class="inputForm" maxlength="11">
                            </div>
                            
                            <div class="form-group">
                                <input id="checkTNC" type="checkbox" class="form-check-input">
                                <label for="checkTNC" class="form-check-label">I have read the Terms and Conditions applied</label>
                            </div>
                            
                            
                            <?php include "include/components/apis/captcha.api.php"?>
                            <input type="submit" id="btnSubmitReg" name="btnRegisterSubmit" class="btn btn-max-width primaryButton" disabled>
                            <a class="btn secondaryButton btn-max-width" href="preview.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            
           
            
        </div>
		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>