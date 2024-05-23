<?php
include("connection.php");

if(!isset($_SESSION['email'])){
    ?>
    <script>
        window.location.href = "login.php";
    </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        /* body{
            background-color: #414141;
            color: #fff;
        } */
        a{
            text-decoration: none;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Users Data</h2>
        <h2>Welcome <?php echo $_SESSION['email']; ?></h2>
        <div class = "float-end">
        <a href="index.php">Add Record</a>
        <a href="logout.php" class = "text-danger">Logout</a>
        </div>
        <table class="table  table-hover table-striped table-bordered text-center text-white" id = 'myTable'>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Salary</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $res = $user -> display();
                if(mysqli_num_rows($res) > 0){
                    $sn = 1;
                    while($row = mysqli_fetch_assoc($res)){
                        $country = $user -> displayCountry($row['country']);
                        $state = $user -> displayState($row['state']);
                        $city = $user -> displayCity($row['city'])
                        ?>
                        <tr id = "row<?php echo $row['id']; ?>">
                            <td>
                                <?php echo $sn; ?>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                               <img src=" <?php echo $row['pic']; ?>" alt="image" width = "80px" height="80px">
                            </td>
                            <td>
                            <?php echo $row['email']; ?>
                            </td>
                            <td>
                            <?php echo $row['contact']; ?>
                            </td>
                            <td>
                            <?php echo $row['salary']; ?>
                            </td>
                            <td>
                            <?php echo $row['gender']; ?>
                            </td>
                            <td>
                            <?php echo $city['name']. ' '. $state['name']. ' '. $country['name'].' ' . $row['pincode']; ?>
                            </td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id']?>&cmd=update">Update</a>
                                <!-- <a href="function.php?id=<?php // echo $row['id']?>&cmd=delete">Delete</a> -->
                                <a href="#" id = "delete<?php echo $row['id']; ?>">Delete</a>

                            </td>

                        </tr>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function(){
                                $("#delete<?php echo $row['id'];?>").click(function(){
                                    if(confirm("Are you sure to delete this record ?")){
                                    $.ajax({
                                        url : "function.php",
                                        method : "POST",
                                        data : {id : '<?php echo $row['id'] ?>', cmd : 'delete'},
                                        success :function(res){
                                            alert("Record deleted")
                                            $("#row<?php echo $row['id'] ?>").fadeOut(1000);
                                           $("#totalRecord").text(res);
                                            
                                        }
                                    })
                                }
                                    
                                })
                                
                            })
                        </script>
                        <?php
                    $sn++;}
                }

                ?>
            </tbody>
        </table>
        <strong id = 'totalRecord'><?php  echo  $user -> countRecords(); ?> : Record Available</strong>
    </div>
</body>
<script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
<script src = "https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#myTable');
</script>
</html>
