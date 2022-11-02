<?php
    class connection{ 
        private $host="localhost";
        private $user="root";
        private $password="";
        private $databaseName='phpoopd';
        private $conn;
         function __construct(){
            $this->conn = new mysqli($this->host,$this->user,$this->password,$this->databaseName);
           if($this->conn->connect_error){
            echo'connection failed';
           }else{
            // echo'conected';
            return $this->conn;
           }
         }
         //insert data 
         public function insertRecord($post){
            $name=$post['name'];
            $email=$post['email'];
            $mobile=$post['mobile'];
            $password=$post['password'];
            $query="insert into user(name,email,mobile,password)values('$name','$email','$mobile','$password')";
            $result=$this->conn->query($query);
            if($result){
                header("location:index.php?msg=insert");

            }else{
                echo 'error';
            }
         } 
         //update record
         public function updateRecord($post){
            $editid=$post['hid'];
            $name=$post['name'];
            $email=$post['email'];
            $mobile=$post['mobile'];
            $query="update  user set name='$name',email='$email',mobile='$mobile' where id= '$editid'";
            $result=$this->conn->query($query);
            if($result){
                header("location:index.php?msg=update");

            }else{
                echo 'error';
            }
         } 
         //select data in table
         public function readtriveData($table){
            $sql="select* from $table ";
            $result=$this->conn->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $data[]=$row;
                }
                return $data;
            }
         } 
         //for update select data
         public function displayrecordByid($editid){
            $updateql="select* from user where id='$editid' ";
            $result=$this->conn->query($updateql);
            if($result->num_rows==1){
             $row=$result->fetch_assoc();
             return $row;
            }
         } 
         //delete record
         public function deleterecord($deleteid){
            $sql="delete from user where id='$deleteid'";
            $result=$this->conn->query($sql);
            if($result){
                header("location:index.php?msg=delete");

            }

         }
    }
    $obj=new connection();
?>