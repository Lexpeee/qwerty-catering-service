    <!-- <button class="btn btn-success" data-toggle="modal" data-target="#addUsersModal">+ Add Users</button> -->
    
    <!-- legend box -->
    <div class="moreblack-bg-color p-3 my-1">
        <h4 class="text-center">Status Indicators:</h4>
        <div class="row">
            <div class="col-sm-12 col-md-3"><span class="dot dot-secondary"></span>Registered</div>
            <div class="col-sm-12 col-md-3"><span class="dot dot-success"></span>Verified</div>
        </div>
    </div>

    <div class="moreblack-bg-color p-3">
        <table id="userAccountsTable" class="table">
            <tr>
                <th><a href="#" class="link white-color" onclick="sortTable(0,'userAccountsTable')">ID</a></th>
                <th><a href="#" class="link white-color" onclick="sortTable(1,'userAccountsTable')">Username</a></th>
                <th><a href="#" class="link white-color" onclick="sortTable(2,'userAccountsTable')">Complete Name(LN, FN)</a></th>
                <th><a href="#" class="link white-color" onclick="sortTable(3,'userAccountsTable')">Email</a></th>
                <th><a href="#" class="link white-color" onclick="sortTable(4,'userAccountsTable')">Contact</a></th>
                <th><a href="#" class="link white-color" onclick="sortTable(5,'userAccountsTable')">Status</a></th>
            </tr>
        <?php
            $sqlGetUsers = "select * from useraccounts where acct_type = 'user'";
            $resultGetUsers = mysqli_query($conn,$sqlGetUsers);
            while($viewGU = mysqli_fetch_array($resultGetUsers)){
        ?>
            <tr>
                <td><?php echo $viewGU["acct_id"]?></td>
                <td><?php echo $viewGU["acct_username"];?></td>
                <td><?php echo $viewGU["acct_lname"].", ".$viewGU["acct_fname"];?></td>
                <td><?php echo $viewGU["acct_emailaddress"];?></td>
                <td><?php echo $viewGU["acct_contact"];?></td>
                <td>
                    <?php 
                        switch($viewGU["acct_status"]){
                            case "verified":
                                ?>
                                    <span class="dot dot-secondary"></span>
                                <?php
                                break;
                            case "registered":
                            ?>
                                <span class="dot dot-success"></span>
                            <?php
                                break;
                            default:
                            ?>
                                <span></span>Undefined</span>
                            <?php
                                break;
                        }
                    ?>
                </td>
            </tr>
        <?php        
            }                                    
        ?>
        </table>
    </div>