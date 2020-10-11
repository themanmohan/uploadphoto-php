<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
     <div class="container">
    <h2 class="bg-dark text-white text-center">Register form for Event</h2>
    <div class=" table-responsive">
    <table class=" table text-center  table-striped table-hover table-bordered ">
   <thead class="text">
   <th>id </th>
   <th>user</th>
   <th>profile pic</th>
   </thead>
   <tbody>
   <?php
   $con = mysqli_connect('localhost','root');
   mysqli_select_db($con,'displayupload');
   if(isset($_POST['submit'])){
    $files = $_FILES['file'];
    $username = $_POST['username'];
    //print_r($files);
    print_r($username);
    echo "<br /";
    $filename = $files['name'];
    $fileerror = $files['error'];
    $filetmp = $files['tmp_name'];

    $fileext = explode('.',$filename);   //dive file into two name  44.jpg
    $filecheck = strtolower(end($fileext));

     $fileextstored = array('png','jpg','jpeg');
     

     //checkinfg extension of a file
     if(in_array($filecheck,$fileextstored)){
         
     $destinationfile = 'upload/'.$filename;   //ttemp folder
     move_uploaded_file($filetmp,$destinationfile);

     $q = "INSERT INTO `imageupload`(`username`, `image`) VALUES ('$username','$destinationfile')";
     $query = mysqli_query($con,$q);


     $displayquery = "select * from imageupload";
     $querydisplay = mysqli_query($con,$displayquery);
     while($result = mysqli_fetch_array($querydisplay)){
         ?>
         <tr>
             <td><?php  echo $result['id'];  ?></td>
             <td><?php  echo $result['username'];  ?></td>
             <td> <img src="<?php  echo $result['image']; ?>" height="100px;" width="auto" ></td>
         </tr>
         <?php
     }
     }
     else{
         echo "extension is not matching";
     }

   }
   ?>
   </tbody>
    </table>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>