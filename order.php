<?php
    session_start();
    require "include/inc.dbconnect.php";
    include "include/functions.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Order Cart | QWERTY Catering</title>

        <?php topLinks();?>
        
        <style>
            .firstForm, .secondForm{
                background: rgba(50,50,50,0.8);
                padding: 10px 50px;
                margin: 10px;
            }

            .secondForm{
                background: rgba(255,255,255,0.8);
                padding: 10px 50px;
                margin: 10px;
            }
            
            tr#totalPrice{
                border-top: 2px solid white;
            }
        </style>
	</head>
	<body id="orderPage">
    
    <?php include "include/components/templates/lib.navbar.comp.php"?>
        
        <div class="wrapper">
            <div class="container">
                <?php
                    if($_SESSION["ses_cart"] == null){
                ?>
                    <div class="alert alert-danger text-center">There are no records to show. Click <a href="menu.php">here</a> to order now.</div>
                <?php
                    }else{
                ?>
                
                <div class="firstForm">
                    <form method="post" action="include/inc.scart.php">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Quantity</th>
                                <th>Name</th>
                                <th>Item Price</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Total Price</th>
                            </tr>
                    <?php
                        foreach($_SESSION["ses_cart"] as $keys => $value){
                    ?>
                            <tr>
                                <td><input type="checkbox" name="chkbox[]" value="<?php echo $value["id"]?>">  <?php echo $value["id"]?></td>
                                <td><?php echo $value["quantity"]?></td>
                                <td><?php echo $value["name"]?></td>
                                <td><?php echo getItemInfoById($conn,$value["id"])["pcont_price"]?> PHP</td>
                                <td><?php echo $value["category"]?></td>
                                <td><?php echo $value["type"]?></td>
                                <td><?php echo number_format($value["price"])?> PHP</td>
                            </tr>
                    <?php
                        }    
                    ?>	
                    
                            <tr id="totalPrice">
                                <td colspan="5"></td>
                                <td>Total:</td>
                                <td>
                                    <span id="totalPriceValue">
                                        <?php
                                            $totalPrice = 0;
                                            foreach($_SESSION["ses_cart"] as $i => $data){
                                                $totalPrice = $totalPrice + $_SESSION["ses_cart"][$i]["price"];}
                                                echo number_format($totalPrice);
                                        ?>
                                    </span> PHP
                                </td>
                            </tr>
                        </table>   
                        <!-- <input type    ="submit" id="deleteItemButton" name="btnDeleteCartItem" class="btn dangerButton" value="Delete records"> -->
                        <!-- <button id="clearCartButton" type="button" class="btn secondaryButton" onclick="clearSCart()">Clear Cart</button> -->
                        <script>
                            function goBackButton(){
                                window.open("menu.php","_self");
                                history.back();
                            }
                            
                            document.getElementById("deleteItemButton").addEventListener("click",function(){
                                window.alert("Records have been deleted!"); 
                            });
                            
                            function clearSCart(pcontid){
                                window.alert("Cart cleared!");
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        window.location.reload();
                                    }
                                }
                                xhttp.open("GET","include/inc.scart.php?btn=deletecart",true);
                                xhttp.send();
                            }
                            
                            
                        </script>

                    </form>
                    

                <?php 
                    if(isset($_GET["order"])){
                        if($_GET["order"] == "success"){ 
                        ?>
                        <div class="alert alert-success" role="alert">
                            &#10003 Success! You have successfully placed an order! <a href="preview.php">Go back.</a>
                        </div>
                        <?php 
                        }else if($_GET["order"] == "failed"){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            &#10007 Error placing order in database. Contact your administrator.
                        </div>
                        <?php 
                        }else if($_GET["order"] == "existingdate"){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            &#10007 Date given is full. Change another date.
                        </div>
                        <?php 
                        }else{}
                    }
                ?>
                </div>

                <!-- Second Form -->
                <div class="secondForm">
                    

                    <form id="clientForm" class="informationForm" name="orderForm" method="post" action="include/inc.sendorderform.php?totalprice=<?php echo $totalPrice;?>">
                        <div class="row">
                                <div class="col-6 py-5 ">
                                    <h4 class="text-center black-color">Client Information</h4><hr>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="formsgroup col-6">
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
                                                <label for="txtBoxAddress">Address: </label>
                                                <textarea id="txtBoxAddress" name="txtAddress" type="text" class="inputForm" rows="3"></textarea>
                                            </div>

                                    </div>                    
                                </div>
                                <div class="col-6 py-5 ">
                                    <h4 class="text-center black-color">Event Information</h4><hr>
                                    <script>
                                        function eventTypeSelect(eventtype){   
                                            if(eventtype == "Other"){
                                                document.getElementById("otherEventType").style.display = "inline";
                                                document.getElementById("txtBoxOtherEvent").value = null;
                                            }else{
                                                document.getElementById("otherEventType").style.display = "none";
                                                document.getElementById("txtBoxOtherEvent").value = eventtype;
                                            }
                                        }
                                    </script>
                                    <div class="form-group">
                                        <label for="txtBoxEventType">Event Type:</label>
                                        <select id="txtBoxEventType" name="txtEventType" type="text" class="inputForm" placeholder="select event" onchange="eventTypeSelect(this.value)">
                                            <option class="black-color">Birthday</option>
                                            <option class="black-color">Christening</option>
                                            <option class="black-color">Anniversary</option>
                                            <option class="black-color">Church Events</option>
                                            <option class="black-color">Party</option>
                                            <option class="black-color">School Events</option>
                                            <option class="black-color">Other</option>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group" id="otherEventType" style="display: none;">
                                        <label for="txtBoxOtherEvent">Other Type</label>
                                        <input id="txtBoxOtherEvent" name="txtEventName" type="text" class="inputForm">
                                    </div>

                                    <div class="form-group">
                                        <label for="txtBoxEventName">Event Name:</label>
                                        <input id="txtBoxEventName" name="txtEventName" type="text" class="inputForm">
                                    </div>

                                    <div class="form-group">
                                        <label for="txtBoxAdditionalInfo">Additional Info: </label>
                                        <textarea id="txtBoxAdditionalInfo" name="txtAdditionalInfo" class="inputForm" rows="4"></textarea>
                                    </div>
                                    
                                    <div id="calendarStatus"></div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="txtBoxDate">Date: </label>
                                            <input id="txtBoxDate" name="txtDate" type="date" class="inputForm" onchange="checkDateAvailability(this.value)" onfocusout="checkDateAvailability(this.value)">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="txtBoxTime">Time: </label>
                                            <input id="txtBoxTime" name="txtTime" type="time" class="inputForm">
                                        </div>                        
                                    </div>
                                    <script>
                                        function checkDateAvailability(dateValue){
                                            var xhttp = new XMLHttpRequest();
                                            xhttp.onreadystatechange = function(){
                                                if(this.status == 200){
                                                    if(this.readyState == 3){
                                                        document.getElementById("calendarStatus").innerHTML = "Please wait a moment.. <br>Please wait a moment.. <br>Please wait a moment.. <br>Please wait a moment.. <br>Please wait a moment.. <br>Please wait a moment.. <br>Please wait a moment.. <br>";
                                                    }else if(this.readyState == 4){
                                                        var utcd = new Date(dateValue);
                                                        //dateValue = utcd.getTime();
                                                        document.getElementById("calendarStatus").innerHTML = this.responseText;
                                                        return dateValue;
                                                        //this.innerHTML = "<div class='alert alert-danger'>Sorry, date is already taken.</div>";
                                                    }
                                                }
                                            }
                                            xhttp.open("GET","include/ajax.php?orderFormAction=checkdate&date="+dateValue,true);
                                            xhttp.send();
                                        }
                                    </script>

                                    <div class="row">
                                    <div class="form-group col-6">
                                        <label for="txtBoxPayType">Payment Type: </label>
                                        <select id="txtBoxPayType" name="txtPayType" class="inputForm">
                                            <option class="black-color">Paypal</option>
                                            <option class="black-color">On Hand</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="txtBoxPax">PAX: </label>
                                        <input type="number" id="txtBoxPax" name="txtPax" class="inputForm" maxlength="4">
                                    </div>
                                    
                                    </div>

                                    <div class="form-group col-12">
                                        <input id="checkTNC" type="checkbox" class="form-check-input">
                                        <span id="txtTNCError" class="red-text" style="display:none"></span><!-- error message for terms and conditions -->
                                        <label for="checkTNC" class="form-check-label">I have read the Terms and Conditions applied</label>
                                    </div>
                                    
                                    
                                    <button type="button" class="btn secondaryButton" onclick="placeExampleValues()">Place Values</button>
                                    <button type="button" class="btn primaryButton" onclick="getData()">Submit</button>

                                </div>

                            <!--ORDER SUMMARY MODAL-->
                                <div id="modalOrderSummary" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            
                                                <div class="modal-body">
                                                <h3 class="text-center">Order Summary</h3>
                                                <div id="yellow-bar"></div>
                                                <h3 class="text-center"><span id="peventname"></span></h3>
                                                <p class="text-center"><span id="padditionalinfo"></span></p>
                                                <hr>
                                                <p><strong>Name: </strong><span id="pfname"></span> <span id="plname"></span></p>
                                                <p><strong>Email: </strong><span id="pemail"></span></p>
                                                <p><strong>Contact: </strong><span id="pcontact"></span></p>
                                                <p><strong>Address: <br></strong><span id="paddress"></span></p>
                                                
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-6">
                                                        <p><strong>Proposed Date: </strong><br><span id="pdate"></span></p>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <p><strong>Proposed Time: </strong><br><span id="ptime"></span></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <p><strong>Payment Type: </strong><span id="ppaytype"></span></p>
                                                <p><strong>Price: </strong><span id="pprice"></span> PHP</p>
                                                <div id="paypal-button" style="display: none;"></div>
                                                <?php
                                                    if(!isset($_SESSION["ses_accttype"])){
                                                        ?>
                                                            <p class="green-color">Note: You are booking a reservation as a non-user</p>
                                                        <?php
                                                    }
                                                ?>

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
                                                                    amount: { total: "<?php echo $totalPrice?>", currency: 'PHP'}
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
                                                <!-- end of PAYPAL API SCRIPT -->
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button name="btnCancel" type="button" class="btn secondaryButton" data-dismiss="modal">Cancel</button>
                                                <input name="btnReserveForm" id="buttonReserve" type="submit" class="btn secondaryButton" value="Reserve">
                                                <input name="btnSendForm" id="buttonSendForm" type="submit" class="btn primaryButton" value="Send Form" >

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    
                                    function placeExampleValues(){
                                        document.getElementById("txtBoxFName").value = "John";
                                        document.getElementById("txtBoxLName").value = "Doe";
                                        document.getElementById("txtBoxEmail").value = "john.doe@gmail.com";
                                        document.getElementById("txtBoxContact").value = "09156132354";
                                        document.getElementById("txtBoxAddress").value = "#225 Broadway St. California, USA";
                                        document.getElementById("txtBoxDate").value = "2018-10-01";
                                        document.getElementById("txtBoxTime").value = "17:00";
                                        document.getElementById("txtBoxEventName").value = "Birhday Paps";
                                        document.getElementById("txtBoxAdditionalInfo").value = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
                                        document.getElementById("txtBoxPayType").value = "Paypal";
                                        document.getElementById("txtBoxPax").value = "500";
                                    }

                                    function getData(){           
                                        if(document.getElementById("checkTNC").checked == false){
                                            document.getElementById("txtTNCError").innerHTML = "*";
                                            document.getElementById("txtTNCError").style.display = "inline";
                                        }else{
                                            $("#modalOrderSummary").modal("show");
                                            document.getElementById("txtTNCError").style.display = "none";
                                            document.getElementById("txtTNCError").innerHTML = "";

                                            var orderForm = document.forms["orderForm"];
                                            var fname = orderForm["txtBoxFName"].value;
                                            var lname = orderForm["txtBoxLName"].value;
                                            var email = orderForm["txtBoxEmail"].value; 
                                            var contact = orderForm["txtBoxContact"].value;
                                            var address = orderForm["txtBoxAddress"].value;
                                            var date = orderForm["txtBoxDate"].value;
                                            var time = orderForm["txtBoxTime"].value;
                                            var eventname = orderForm["txtBoxEventName"].value;
                                            var additionalInfo = orderForm["txtBoxAdditionalInfo"].value;
                                            var paytype = orderForm["txtBoxPayType"].value;
                                            var pax = orderForm["txtBoxPax"].value;
                                            var totalPrice = document.getElementById("totalPriceValue").innerHTML;

                                            
                                            if(paytype == "Paypal"){
                                                document.getElementById("paypal-button").style.display = "inline";
                                                document.getElementById("buttonSendForm").style.display = "none";

                                            }else{
                                            document.getElementById("paypal-button").style.display = "none";
                                                document.getElementById("buttonSendForm").style.display = "inline";

                                            }
                                            document.getElementById("pfname").innerHTML = fname; 
                                            document.getElementById("plname").innerHTML = lname; 
                                            document.getElementById("pemail").innerHTML = email; 
                                            document.getElementById("pcontact").innerHTML = contact; 
                                            document.getElementById("paddress").innerHTML = address; 
                                            document.getElementById("peventname").innerHTML = eventname; 
                                            document.getElementById("padditionalinfo").innerHTML = additionalInfo; 
                                            document.getElementById("pdate").innerHTML = date; 
                                            document.getElementById("ptime").innerHTML = time; 
                                            document.getElementById("ppaytype").innerHTML = paytype; 
                                            document.getElementById("pprice").innerHTML = totalPrice;  
                                        }
                                    }

                                </script>

                            <?php
                                }
                            ?>
                        </div>
                    </form>


                </div>
                <!-- end of Second form -->
            </div>
        </div>
		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>