


<form action="include/functions.php" method="post">
    <div id="addPackageModal1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Package</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <input id="txtBoxPackageName" name="txtPackageName" type="text" class="form-control" placeholder="Package Name">
                        </div>
                        <div class="form-group">
                            <input id="txtBoxPackageCategory" name="txtPackageCategory" type="text" class="form-control" placeholder="Category">
                        </div>
                        <div class="form-group">
                            <textarea id="txtBoxPackageDesc" name="txtPackageDesc" class="form-control" placeholder="Description" rows="5"></textarea>
                        </div>
                        <div id="errorMessagesBox"></div>
                    </div>
                    <!--<a class="btn primaryButton" onclick="checkPackageName(packname,hey)">Next</a>-->

                    <button type="button" class="btn primaryButton" id="nextBtn">Next</button>

                    <script>
                        var packname = document.getElementById("txtBoxPackageName").value;
                        var hey = packname.length;
                        var btnNext = document.getElementById("nextBtn");


                        btnNext.onclick = function(){
                            var input = document.getElementById("txtBoxPackageName");
                            var input2 = document.getElementById("txtBoxPackageCategory");
                            var input3 = document.getElementById("txtBoxPackageDesc");
                            if(input.value == null || input.value == "" || input.value == 0 || input2.value == null || input2.value == "" || input2.value == 0  || input3.value == null || input3.value == "" || input3.value == 0 ){
                                console.log("test2");
                                var alertBox = document.createElement("div");
                                alertBox.setAttribute("id","errorMessage");
                                alertBox.setAttribute("class","alert alert-danger");
                                var errorMessage = document.getElementById("errorMessagesBox");
                                errorMessage.append(alertBox);
                            }else{
                                console.log("success");
                                $('#addPackageModal1').modal('hide');
                                $('#addPackageModal2').modal('show');
                            }
                        }
                        /*LAGYAN NG ERROR HANDLERS JS MO NA LANG*/
                    </script>

                </div>
            </div>
        </div>
    </div>

    <div id="addPackageModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Package</h5>
                </div>
                <div class="modal-body">
                    How many contents would you like to add? (Max 10)
                    <input type="number" id="numQuantityPCont" class="form-control">                                            
                    <a class="btn secondaryButton" data-toggle="modal" data-target="#addPackageModal1" data-dismiss="modal">Back</a>
                    <a class="btn primaryButton" data-toggle="modal" data-target="#addPackageModal3" data-dismiss="modal" onclick="getPContQuantity(q2.value)">Next</a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="addPackageModal3" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Package</h5>
                </div>
                <div class="modal-body">
                    <div id="addFieldsContainer" class="row">
                        <script>
                        var q2 = document.getElementById("numQuantityPCont");
                        function getPContQuantity(num){

                            if(num == 0 || num === ""){
                                var area = document.getElementById("addFieldsContainer");
                                var alertbox = document.createElement("div");
                                alertbox.setAttribute("class","alert alert-danger");
                                alertbox.append("No input");
                                area.appendChild(alertbox);

                            }else if(num > 10){
                                for (var i = 0; num > 10; i++){ 
                                    var area = document.getElementById("addFieldsContainer");
                                    var alertbox = document.createElement("div");
                                    alertbox.setAttribute("class","alert alert-danger");
                                    alertbox.append("Max is 10!");
                                    area.appendChild(alertbox);
                                    /*There's something wrong here*/
                                }
                            }else{
                                for (var i = 0; i < num; i++){

                                    var div1 = document.createElement("div");
                                    div1.setAttribute("class","col-sm-12 col-md-5 form-group");
                                    div1.setAttribute("id","txtBoxContName"+i);
                                    document.getElementById("addFieldsContainer").appendChild(div1);                                                            

                                    var text1 = document.createElement("input");
                                    text1.setAttribute("type","text");
                                    text1.setAttribute("id","txtBoxContName"+i);
                                    text1.setAttribute("name","txtContName[]");
                                    text1.setAttribute("placeholder","Name");
                                    text1.setAttribute("class","form-control");
                                    document.getElementById("txtBoxContName"+i).appendChild(text1);


                                    var div2 = document.createElement("div");
                                    div2.setAttribute("class","col-sm-12 col-md-5 form-group");
                                    div2.setAttribute("id","txtBoxCategoryName"+i);
                                    document.getElementById("addFieldsContainer").appendChild(div2);


                                    var text2 = document.createElement("input");    
                                    text2.setAttribute("type","text");
                                    text2.setAttribute("id","txtBoxCategoryName"+i);
                                    text2.setAttribute("name","txtCategoryName[]");
                                    text2.setAttribute("placeholder","Category");
                                    text2.setAttribute("class","form-control");
                                    document.getElementById("txtBoxCategoryName"+i).append(text2);
                                    
                                    var div3 = document.createElement("div");
                                    div3.setAttribute("class","col-sm-12 col-md-2 form-group");
                                    div3.setAttribute("id","txtBoxPrice"+i);
                                    document.getElementById("addFieldsContainer").appendChild(div3);

                                    var text3 = document.createElement("input");
                                    text3.setAttribute("type","text");
                                    text3.setAttribute("id","txtBoxPrice"+i);   
                                    text3.setAttribute("name","txtPrice[]");
                                    text3.setAttribute("placeholder","Price");
                                    text3.setAttribute("class","form-control");
                                    document.getElementById("txtBoxPrice"+i).append(text3);
                                }
                            }
                        }
                        </script>
                    </div>
                    <a class="btn primaryButton" data-toggle="modal" data-target="#addPackageModal2" data-dismiss="modal" onclick="document.getElementById('addFieldsContainer').innerHTML=''">Back</a>
                    <input type="submit" name="btnAddPackage" class="btn primaryButton">
                    
                </div>
            </div>
        </div>     
    </div>
</form>

<div class="moreblack-bg-color p-3">
    <form method="post" action="include/functions.php">
        <table id="packagesTable" class="table table-hover">
            <a href="#" class="btn btn-sm secondaryButton modal-toggle" data-toggle="modal" data-target="#addPackageModal1"><i class="fas fa-plus fa-lg"></i> Add Package</a>
            <a href="#" class="btn btn-sm secondaryButton modal-toggle" data-toggle="modal" data-target="#"><i class="fas fa-edit fa-lg"></i> Edit Package</a>
            <button type="submit" class="btn btn-sm dangerButton" name="btnDeletePackages"><i class="fas fa-trash fa-lg"></i> Delete Package</a>
                <tr>
                    <th></th>
                    <th><a href="#" id="idColumn" class="link white-color" onclick="sortTable(1,'packagesTable')">ID</a></th>
                    <th><a href="#" id="packageColumn" class="link white-color" onclick="sortTable(2,'packagesTable')">Package</a></th>
                    <th><a href="#" id="packageColumn" class="link white-color" onclick="sortTable(3,'packagesTable')">Category</a></th>
                    <th><a href="#" id="packageColumn" class="link white-color" onclick="sortTableByNumber(4,'packagesTable')">Orders</a></th>
                    <th><a href="#" id="packageColumn" class="link white-color" onclick="sortTableByNumber(5,'packagesTable')">Rating</a></th>
                    <th></th>
                </tr>
                
            <?php
                function test($a){
                    echo "<script> window.alert('this'".$a."'')</script>";
                }

                $sqlGetPackages = "select * from packages";
                
                $AllPackages = mysqli_query($conn,$sqlGetPackages);
                while($viewAP = mysqli_fetch_array($AllPackages)){
            ?>
                <tr>
                    <td><input id="checkboxPackages[]" type="checkbox" name="chkboxpackage[]" value="<?php echo $viewAP["package_id"]?>"></td>
                    <td><?php echo $viewAP["package_id"]?></td>
                    <td><?php echo $viewAP["package_name"]?></td>
                    <td><?php echo $viewAP["package_category"]?></td>
                    <td><?php echo $viewAP["package_order_counter"]?></td>
                    <td><?php echo $viewAP["package_rating"]?></td>
                    <td><a href="#" data-toggle="modal" data-target="#packageModal<?php echo $viewAP["package_id"];?>">View</a></td>
                </tr>


                <!-- package modal -->
                <div id="packageModal<?php echo $viewAP["package_id"];?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-body">
                                        <h5 class="uniqueHeader text-center"><?php echo $viewAP["package_name"]?></h5>
                                        <div id="yellow-bar"></div>
                                <img src="assets/db/package/<?php echo $viewAP["package_image"]?>" width="100%">
                                <div class="row text-center m-2">
                                    <div class="col-sm-12 col-md-6">
                                        <h5>Rating:</h5>
                                        <h3><img src="assets/icons/star.png"><?php echo $viewAP["package_rating"]?></h3>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <h5>Order count:</h5>
                                        <h3><?php echo $viewAP["package_order_counter"]?></h3>
                                    </div>
                                </div>
                                <p>Category: <?php echo $viewAP["package_category"] ?><br></p>
                                <h4 class="text-center">Package Contents:</h4>
                                <ul>
                                    <?php
                                        $queryCat = mysqli_query($conn,"select * from categories where cat_isshow = 1");
                                        while($viewCat = mysqli_fetch_array($queryCat)){
                                            $queryFetchItems = mysqli_query($conn,"select * from package_contents where pcont_package_id = '".$viewAP['package_id']."'");
                                            while($viewItems = mysqli_fetch_array($queryFetchItems)){
                                                if($viewCat["cat_id"] == $viewItems["pcont_category_id"]){
                                                    ?>
                                                        <li><?php echo $viewItems["pcont_name"]?></li>
                                                    <?php
                                                }
                                            }

                                        }
                                    ?>
                                    <hr>
                                    <p class="text-center">Price: <?php echo number_format($viewAP["package_price"])." PHP"?></p>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of package modal -->

            <?php
                }
            ?>
        </table>
    </form>
</div>