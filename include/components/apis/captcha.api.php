<style>
    .captchaCode{
        padding: 10px;
        border: none;
        margin: 10px;
        background-color: #333;
        color: white;
        user-select: none;
    }

    .captchaCode::placeholder{
        font-weight: black;
        color: white;
    }

    .captcha{
        margin: 15px;
    }

    .captchaStatus{
        display: none;
    }

</style>


<!-- FORM MUST BE EXISTING IN ORDER TO USE THIS API -->

<div class="card text-center">
    <div class="card-content">
        <div class="card-body">
                <p>Enter the code below:</p>
                
                <?php 
                    $captchaCode = random_int(10000,99999);
                ?>

                <h3 id="strCaptchaCode" class="captchaCode"><?php echo $captchaCode?></h3>
                
                <input type="text" id="txtBoxCaptcha" name="txtCaptcha" class="captcha black-color text-center" onchange="checkCaptcha()" placeholder="Enter code here">
                <div id="statusBox"></div>

                <script>
                function checkCaptcha(){
                    const captcha1 = document.getElementById("strCaptchaCode").innerHTML;
                    const captcha2 = document.getElementById("txtBoxCaptcha").value;
                    const status = document.getElementById("statusBox");

                    if(captcha1 == captcha2){
                        status.innerHTML = "<div class='alert alert-success'>Verified</div>";
                        document.getElementById("btnSubmitReg").removeAttribute("disabled");
                    }else{
                        status.innerHTML = "<div class='alert alert-danger'>Wrong Code. Try again.</div>";
                        document.getElementById("btnSubmitReg").setAttribute("disabled",null);
                    }
                }
                </script>
        </div>
    </div>
</div>