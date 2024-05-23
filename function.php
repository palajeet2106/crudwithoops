<?php

include("connection.php");

if(isset($_POST['submit'])){
    if($user -> create()){
        $msg = "Record Created";
        echo $msg;
        // echo $msg;
        ?>
        <!-- <script>
            alert("Record Created");
            window.location.href = "record.php";
        </script> -->
        <?php
    }
}
if(isset($_POST['update'])){
    if($user -> update()){
        ?>
        <!-- <script>
            alert("Record Updated");
            window.location.href = "record.php";
        </script> -->
        <?php
        $msg = "Record Updated";
        echo $msg;
    }
}

if(isset($_REQUEST['id']) && isset($_REQUEST['cmd']) && $_REQUEST['cmd'] == 'delete'){
    $id = $_REQUEST['id'];
     if($user -> delete($id)){
        echo $user -> countRecords();
     }else{
        echo $msg;
     }
}

if(isset($_POST['cid']) && isset($_POST['cmd']) && $_POST['cmd'] == 'getState'){
   $res =  $user -> state ($_POST['cid'] , 0);
   
}
if(isset($_POST['sid']) && isset($_POST['cmd']) && $_POST['cmd'] == 'getCity'){
   $res =  $user -> city ($_POST['sid'] , 0);
   
}

if(isset($_POST['cmd']) && $_POST['cmd']=="login"){
    $msg= $user->login();
    echo $msg;
        
}


?>