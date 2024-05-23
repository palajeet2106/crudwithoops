<?php
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
        
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                    <h2>Registration Form</h2>
                    </div>
                    <div class="card-body">
                    <div class="alert alert-success" id = "result"></div>
                    <form action="function.php" method="post" id = "form" enctype = "multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <span id="nameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span id="emailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" required>
                            <span id="contactError"></span>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <!-- <input type="country" class="form-control" id="country" name="country" required> -->
                            <select name="country" id="country" class = "form-control">
                                <option value="" selected disabled >-- Select country--</option>
                                <?php $res = $user -> country($cid);
                                
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select name="state" id="state" class = "form-control">
                                <option value="" selected disabled >-- Select State--</option>
                            </select>
                            <!-- <input type="state" class="form-control" id="state" name="state" required> -->
                            
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <!-- <input type="city" class="form-control" id="city" name="city" required> -->
                            <select name="city" id="city" class = "form-control">
                                <option value="" selected disabled >-- Select City--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class = "form-control">
                                <option value="" selected disabled >-- Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pic">Photo</label>
                            <input type="file" class="form-control-file" id="pic" name="pic" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="pincode">Pin Code</label>
                            <input type="number" class="form-control" id="pincode" name="pincode" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <input type="submit"  class=" form-control btn btn-primary" value="Register" id = "btn">
                        <input type="hidden" name="submit" class=" form-control btn btn-primary" value="Register">
                        <a href="record.php" class="mt-2 form-control btn btn-warning">Display Record</a>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#result").hide();
        $("#form").submit(function(e){
            e.preventDefault();
            $.ajax({
                url : "function.php",
                method : "POST",
                data : new FormData(this),
                contentType :false,
                processData :false,
                success :function(res){
                    $("#result").show(1000);
                    $("#result").html(res);
                    alert("Record Created");
                    $("#form").trigger('reset');
                    // window.location.href = 'record.php';
                }
            })
        })

        $("#country").change(function(){
            let cid = $("#country").val();
            $.ajax({
                url : "function.php",
                method : "POST",
                data : {cid : cid , cmd : "getState"},
                success : function(res){
                    $("#state").html(res);
                }
            })
        })
        $("#state").change(function(){
            let sid = $("#state").val();
            $.ajax({
                url : "function.php",
                method : "POST",
                data : {sid : sid , cmd : "getCity"},
                success : function(res){
                    $("#city").html(res);
                }
            })
        })
        $("#contactError").hide();
        $("#contact").keyup(function(){
            let contact = $("#contact").val();
             if(contact.length != 10){
                $("#contactError").show();
                $("#contactError").text("Please enter valid number");
                $("#contactError").css("color" , "red");
                $("#btn").hide();
             }else{
                $("#contactError").hide();
                $("#btn").show();
             }
            
        })
        $("#nameError").hide();
        $("#name").keyup(function(){
            let name = $("#name").val();
             if(name === ' ' || name === '@' || name === '#' || name === '$'){
                $("#nameError").show();
                $("#nameError").text("Please enter valid name");
                $("#nameError").css("color" , "red");
                $("#btn").hide();
             }else{
                $("#nameError").hide();
                $("#btn").show();
             }
            
        })
        $("#emailError").hide();
        $("#email").keyup(function(){
            let email = $("#email").val();
            let emailRegex = /^[^\s]+[^\s]+\.[^\s]+$/;
           if (!emailRegex.test(email)) {
               $("#emailError").show();
                $("#emailError").text("Please enter valid email");
                $("#emailError").css("color" , "red");
                $("#btn").hide();
        }else{
            $("#emailError").hide();
            $("#btn").show();
        }
        
            
        })
    })
</script>
</html>
