

function getData(){            
    var orderForm = document.forms["orderForm"];

    var fname = orderForm["txtBoxFName"].value;
    var lname = orderForm["txtBoxLName"].value;
    var email = orderForm["txtBoxEmail"].value;
    var contact = orderForm["txtBoxContactNumber"].value;
    var package = orderForm["selBoxPackage"].value;
    var additionalInformation = orderForm["txtBoxAddInfo"].value;
    var orderDate = orderForm["txtBoxDate"].value;
    var orderTime = orderForm["txtBoxTime"].value;
    var payType = orderForm["selBoxPayType"].value;

    /*var fname = document.getElementById("txtBoxFName").value;
    var lname = document.getElementById("txtBoxLName").value;
    var email = document.getElementById("txtBoxEmail").value;
    var contact = document.getElementById("txtBoxContactNumber").value;
    var package = document.getElementById("selBoxPackage").value;
    var additionalInformation = document.getElementById("txtBoxAddInfo").value;
    var orderDate = document.getElementById("txtBoxDate").value;
    var orderTime = document.getElementById("txtBoxTime").value;
    var payType = document.getElementById("selBoxPayType").value;*/

    document.getElementById("pFName").innerHTML = fname;
    document.getElementById("pLName").innerHTML = lname;
    document.getElementById("pEMail").innerHTML = email;
    document.getElementById("pContact").innerHTML = contact;
    document.getElementById("pPackage").innerHTML = package;
    document.getElementById("pAdditionalInfo").innerHTML = additionalInformation;
    document.getElementById("pDate").innerHTML = orderDate;
    document.getElementById("pTime").innerHTML = orderTime;
    document.getElementById("pPayType").innerHTML = payType;
}

function xhttpCondition(col){
    if(this.readyState == 4 && this.status == 200){
        document.getElementById("list-dashboard").innerHTML = this.responseText;
    }
}

function deleteMessage(value){
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET","../../include/ajax.php?deletemessage="+value,true);
    xhttp.send();
}

function linkedJSMessage(){
    window.alert("this is working.");
}

function sortTable(n,tableName){
    var shouldSwitch;
    var table = document.getElementById(tableName);
    var switching = true;   
    var direction = "asc";
    var switchcount = 0;
    while(switching){
        switching = false;
        rows = table.getElementsByTagName("TR");
        for(var i=1; i<(rows.length - 1); i++){
            shouldSwitch = false;
            var x = rows[i].getElementsByTagName("TD")[n];
            var y = rows[i+1].getElementsByTagName("TD")[n];
            //window.alert(x);
            //window.alert(y);
            
            if(direction == "asc"){
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;    
                    break;
                }
            }else if(direction == "desc"){
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;    
                    break;
                }
            }
        }
        if(shouldSwitch){
            rows[i].parentNode.insertBefore(rows[i+1],rows[i]);
            switching = true;
            switchcount++;
        }else{
            if(switchcount == 0 && direction == "asc" ){
                direction = "desc";
                switching = true;
            }
        }
    }
}

function sortTableByNumber(n,tableName){
    var shouldSwitch;
    var table = document.getElementById(tableName);
    var switching = true;   
    var direction = "asc";
    var number = 3;
    var switchcount = 0;
    while(switching){
        switching = false;
        rows = table.getElementsByTagName("TR");
        for(var i=1; i<(rows.length - 1); i++){
            shouldSwitch = false;
            var x = rows[i].getElementsByTagName("TD")[n];
            var y = rows[i+1].getElementsByTagName("TD")[n];
            //window.alert(Number(x.innerHTML));
            //window.alert(y);
            
            if(direction == "asc"){
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    shouldSwitch = true;    
                    break;
                }
            }else if(direction == "desc"){
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    shouldSwitch = true;    
                    break;
                }
            }
        }
        if(shouldSwitch){
            rows[i].parentNode.insertBefore(rows[i+1],rows[i]);
            switching = true;
            switchcount++;
        }else{
            if(switchcount == 0 && direction == "asc" ){
                direction = "desc";
                switching = true;
            }
        }
    }
}

