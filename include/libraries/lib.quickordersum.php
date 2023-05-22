
<?php
    include "../functions.php";
    $sumId = $_REQUEST["sumid"];
    $view = getPaymentRecord($conn,$sumId);
    
?>
<div class='card'>
<!-- THIS DOCUMENT SERVES AS THE 
FORM BEING SHOWN IN THE ORDER 
CHECKER SECTION OF THE VERY 
LANDING PAGE OF THE SYSTEM  -->
    <div class='card-body'>
        <div class='card-body'> 
            <?php
                if($sumId == ""){
            ?>
            <div class="alert alert-warning">
                Enter a number. 
            </div>
            <?php   
                }else if($sumId != $view["paylog_id"]){
            ?>
            <div class="alert alert-danger">
                There are no results. Kindly check your transaction ID carefully. 
            </div>
             <?php       
                }else{
            ?>
            <h3><?php echo $view["paylog_eventname"]?></h3>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p class="text-center">Status: <?php echo $view["paylog_status"]?></p>
                </div>
            </div>
            
           
            <div class="card-action">
                <button type="button" class="btn primaryButton" onclick="getPaymentSummary(<?php echo $view["paylog_id"]?>)">View Summary</button>
            </div>
            <?php
                }
            ?>
            
        </div>
        
    </div>
</div>

<div id="cancelModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="include/inc.contactusform.php" method="post">

                    <div class="form-group">
                        <label for="txtBoxReason">Tell us why you want to cancel your order?</label>
                        <?php 
                    if(isset($errText)){
                        echo $errText;
                        
                    }; ?>
                    <input type="hidden" name="hidOrderID" value="<?php echo $_REQUEST["sumid"]?>">
                    <input id="txtBoxName" name="txtCancelName" class="inputForm" placeholder="Name">
                    <textarea id="txtBoxReason" name="txtReason" class="inputForm" placeholder="Indicate your reason here" rows="6"></textarea>
                    <p>Please note that 50% will only be refunded once the order is paid.</p>
                    <input type="submit" name="btnSubmitReason" class="btn primaryButton">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

