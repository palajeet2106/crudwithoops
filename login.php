<?php
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                    <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <form  enctype="multipart/form-data" id = "loginForm">
                            <div class="form-group">
                                <label for="email">Username or Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter username or email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
        
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    type: 'POST',
                    url: 'function.php',
                    data: {
                        email: email,
                        password: password,
                        cmd: "login"
                    },
                    success: function(res) {
                        
                        if(res=='success'){
                            alert(res)
                            window.location.href = 'record.php';
                        }else {
                            alert(res);
                        }
                        $("#loginForm").trigger('reset');
                    }
                });
            });
        });
    </script>
</html>
