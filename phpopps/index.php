<?php include('dbconnect.php');
$obj=new connection();
//insert data
if(isset($_POST['submit'])){
    $obj->insertRecord($_POST);
}
if(isset($_POST['update'])){
    $obj->updateRecord($_POST);
}
if(isset($_GET['deleteid'])){
    $deleteid= $_GET['deleteid'];
    $obj->deleterecord($deleteid);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<body>
<?php
    if(isset($_GET['msg']) && ($_GET['msg']=='insert')){
        echo'<div class="alert alert-primary" role="alert">
                Data insert Sucessfully!
            </div>';
    }
    if(isset($_GET['msg']) && ($_GET['msg']=='update')){
        echo'<div class="alert alert-primary" role="alert">
                Data update Sucessfully!
            </div>';
    }
    //update
    if(isset($_GET['editid'])){
        $editid=$_GET['editid'];
        $update=$obj->displayrecordByid($editid);
        ?>
        <form method='post' action='index.php'>
            <div class="row">
            <input type="hidden" class="form-control" name='hid'value="<?php echo $update['id'];?>">
                <div class="col-md-6">
                <input type="text" class="form-control" value="<?php echo $update['name'];?>"placeholder="Enter Name" id="name" name="name">
                </div>
                <div class="col-md-6">
                <input type="text" class="form-control" value="<?php echo $update['email'];?>" id="email" placeholder="Enter email" name="email">
                </div>
                
            </div><br>
            <div class="row">
                <div class="col-md-6">
                <input type="text" class="form-control" value="<?php echo $update['mobile'];?>" id="mobile" placeholder="Entermobile" name="mobile">
                </div>
                <!-- <div class="col-md-6">
                <input type="password" class="form-control" value="" placeholder="Enter password" name="password">
                </div> -->
            </div><br>
            <div class="row">
            <div class="col-md-4"> </div>
                <div class="col-md-4">
                <button type="submit"  name='update' class="btn btn-primary form-control">Update</button>
                </div>
            <div class="col-md-4"> </div>
            </div>
        </form><br><br><br>
        <?php
    }else{
   
?>
<form method='post' action='index.php'>
<div class="row">
    <div class="col-md-6">
      <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
    </div>
    <div class="col-md-6">
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
</div><br>
<div class="row">
    <div class="col-md-6">
      <input type="text" class="form-control" id="mobile" placeholder="Entermobile" name="mobile">
    </div>
    <div class="col-md-6">
      <input type="password" class="form-control" placeholder="Enter password" name="password">
    </div>
</div><br>
<div class="row">
<div class="col-md-4"> </div>
    <div class="col-md-4">
    <button type="submit"  name='submit' class="btn btn-primary form-control">Submit</button>
    </div>
<div class="col-md-4"> </div>
</div>
</form>
<?php }?>
<br><br><br><br>
<h1 class='text-center'>Show All Data of Table</h1>
<table class="table">
   
  <thead>
    <tr class='text-center'>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
    <tbody>
    <?php
         $data=$obj->readtriveData('user');
         $sno=1;
           foreach($data as $value){?>
                <tr class='text-center'>
                    <th scope="row"><?php echo $sno++; ?></th>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['email'] ?></td>
                    <td><?php echo $value['mobile'] ?></td>
                    <td>
                        <a href="index.php?editid=<?php echo $value['id'];?>"class='btn btn-info'>Edit</a>
                        <a href="index.php?deleteid=<?php echo $value['id'];?>"class='btn btn-danger'>Delete</a>
                    </td>
                    </tr>
            <?php
           }
           
    ?>
        
    </tbody>
</table>
</body>
</html>