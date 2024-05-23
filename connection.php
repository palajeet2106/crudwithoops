<?php
session_start();
class connect{
   public function __construct(){
        $this -> conn  = new mysqli("localhost" , "root" , "" , "crud");;
    }

    function create(){
        $file = $_FILES['pic']['name'];
        $folder = "media/";
        $path = $folder.basename($file);
        move_uploaded_file($_FILES['pic']['tmp_name'] , $path);
        $sql = "INSERT INTO `customerdata`(`name`, `email`, `contact`, `salary`, `country`, `state`, `city`, `pincode`, `password`,`gender` , `pic`) VALUES ('".$_POST['name']."','".mysqli_real_escape_string($this -> conn , stripcslashes($_POST['email']))."','".$_POST['contact']."','".$_POST['salary']."','".$_POST['country']."','".$_POST['state']."','".$_POST['city']."','".$_POST['pincode']."','".mysqli_real_escape_string($this -> conn , stripcslashes(md5($_POST['password'])))."' , '".$_POST['gender']."' , '$path')";

        $res = $this->conn -> query($sql);
        return $res;
    }

    function display(){
        $sql = "SELECT * FROM customerdata";
        $res = $this->conn -> query($sql);
        return $res;

    }
    function edit($id){
        $sql = "SELECT * FROM customerdata WHERE id = '$id'";
        $res = $this->conn -> query($sql);
        $row = mysqli_fetch_assoc($res);
        return $row;

    }

    function update(){
        $file = $_FILES['pic']['name'];
        if(!empty(basename($file))){
            $folder = "media/";
            $path = $folder.basename($file);
        }else{
            $path = $_POST['picdb'];
        }
       
        move_uploaded_file($_FILES['pic']['tmp_name'] , $path);
        $id = $_POST['userId'];
        $sql = "UPDATE `customerdata` SET `name`='".$_POST['name']."',`email`='".mysqli_real_escape_string($this -> conn , stripcslashes($_POST['email']))."',`contact`='".$_POST['contact']."',`salary`='".$_POST['salary']."',`country`= '".$_POST['country']."',`state`= '".$_POST['state']."',`city`='".$_POST['city']."',`pincode`='".$_POST['pincode']."',`password`='".mysqli_real_escape_string($this -> conn , stripcslashes(md5($_POST['password'])))."' , `gender` = '".$_POST['gender']."' , `pic` = '$path' WHERE id = '$id'";
        $res = mysqli_query($this -> conn , $sql);
        return $res;
    }

    function delete($id){
        $sql = "DELETE FROM customerdata WHERE id = '$id'";
        $res = mysqli_query($this -> conn , $sql);
        return $res;
    }

    function countRecords(){
        $sql = "SELECT count(id) AS total FROM customerdata";
        $res = $this->conn -> query($sql);
        $row = mysqli_fetch_assoc($res);
        return $row['total'];
    }

    function country($cid){
        $selected = '';
        $sql = "SELECT * FROM countries";
        $res = mysqli_query($this -> conn , $sql);
        while($row = mysqli_fetch_assoc($res)){
            if($cid != 0 && $row['id'] == $cid){
                $selected = 'selected';
            }else{
                $selected = '';
            }

            ?>
            <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name'];?></option>
            <?php
        }
        return $res;
    }
    function state($cid , $sid){
        $sql = "SELECT * FROM states WHERE country_id = '$cid'";
        $res = mysqli_query($this -> conn , $sql);
        if(mysqli_num_rows($res) > 0){
            ?>
             <option value="" selected disabled >-- Select State--</option>
            <?php
            while($row = mysqli_fetch_assoc($res)){
                if($sid != 0 && $row['id'] == $sid){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
        
                ?>
                <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
                <?php
            }
           }
        return $res;
    }
    function city($sid , $cid){
        $sql = "SELECT * FROM cities WHERE state_id = '$sid'";
        $res = mysqli_query($this -> conn , $sql);
        if(mysqli_num_rows($res) > 0){
            ?>
            <option value="" selected disabled >-- Select City--</option>
           <?php
            while($row = mysqli_fetch_assoc($res)){
                if($cid != 0 && $row['id'] == $cid){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
        
                ?>
                <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
                <?php
            }
           }
        return $res;
    }


    function displayCountry($id){
        $sql = "SELECT * FROM countries WHERE id = '$id'";
        $res = mysqli_query($this -> conn , $sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }

    function displayState($id){
        $sql = "SELECT * FROM states WHERE id = '$id'";
        $res = mysqli_query($this -> conn , $sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }

    function displayCity($id){
        $sql = "SELECT * FROM cities WHERE id = '$id'";
        $res = mysqli_query($this -> conn , $sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }


    function login(){
        $msg="";
        $email = mysqli_real_escape_string($this -> conn , stripcslashes($_POST['email']));
        $password = mysqli_real_escape_string($this -> conn , stripcslashes(md5($_POST['password'])));
        $sql = "SELECT * FROM customerdata WHERE email = '$email' AND password = '$password'";
        $res = mysqli_query($this -> conn , $sql);
        if(mysqli_num_rows($res) == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['email'] = $row['name'];
            $msg= "success";
        }else{
            $msg= "Invalid Username Or Password";
        }
        return $msg;
       
    }
}





$user = new connect();

?>