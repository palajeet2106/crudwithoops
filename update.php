<?php

include("connection.php");

if(isset($_REQUEST['id']) && isset($_REQUEST['cmd']) && $_REQUEST['cmd'] == 'update'){
    $id = $_REQUEST['id'];
    $row = $user -> edit($id);
}


?>
<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id']


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
                    <h2 class="mb-4">Correction Form</h2>
                    </div>
                    <div class="card-body">
                    <div class = "alert alert-success" id = "result"></div>
                    <form action="function.php" method="post" id = "form" enctype = "multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'];?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="userId" value="<?php echo $row['id'];?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'];?>">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" value="<?php echo $row['contact'];?>">
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $row['salary'];?>">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <!-- <input type="country" class="form-control" id="country" name="country" required> -->
                            <select name="country" id="country" class = "form-control">
                                <option value="" selected disabled >-- Select country--</option> 
                                <?php $user -> country($row['country']); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select name="state" id="state" class = "form-control">
                                <option value="" selected disabled >-- Select State--</option>
                                <?php $user -> state($row['country'] , $row['state']); ?>
                            </select>
                            <!-- <input type="state" class="form-control" id="state" name="state" required> -->
                            
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select name="city" id="city" class = "form-control">
                                <option value="" selected disabled >-- Select City--</option>
                                <?php $user -> city($row['state'] , $row['city']); ?>
                            </select>
                            <!-- <input type="state" class="form-control" id="state" name="state" required> -->  
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class = "form-control">
                                <option value="" selected disabled >-- Select Gender--</option>
                                <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                                <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pic">Photo</label>
                            <input type="file" class="form-control-file" id="pic" name="pic" accept="image/*">
                            <input type="hidden" class="form-control-file" id="picdb" name="picdb" value="<?php echo $row['pic']; ?>" >
                        </div>

                        <div class="form-group">
                            <label for="pincode">Pin Code</label>
                            <input type="number" class="form-control" id="pincode" name="pincode" value="<?php echo $row['pincode'];?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <input type="submit"  class=" form-control btn btn-primary" value = "Update">
                        <input type="hidden" name="update" class=" form-control btn btn-primary" value = "Update">
                        <a href="record.php" class="mt-2 form-control btn btn-warning"> Display Record</a>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
    <?php
}else{
    ?>
    <script>
        window.location.href = "login.php";
    </script>
    <?php
}
?>
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
                    alert("Record Updated");
                    // window.location.href = 'record.php';
                }
            })
        })
    })
</script>
</html>
