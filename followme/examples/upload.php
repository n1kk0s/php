<?php

  if (!isset($_SESSION)){
    session_start();
  }

  require('sitedbconn.php');

  if (!isset($_SESSION['email'])){
  header('Location: login.php');
  }

  if (isset($_FILES['upload'])) { //This checks to see if post data has been submitted into upload....In the form below the input type is called upload..Thats what we're referring to

    if (!file_exists("uploads")){ //if the uploads directory does not exist, create it
        mkdir("uploads/");
    }

    if(!file_exists("uploads/" . $_SESSION['user_id'])){ //if uploads/student does not exist..we create it..this is dynamic..dependent on the username
      mkdir("uploads/" . $_SESSION['user_id']);
    }

    $target_dir = "uploads/" . $_SESSION['user_id'] . "/"; //the target directory of the file...will be on the server in the same PHP directory as this file...we must append the "/" because we are uploading this to a directory
    $target_file = $target_dir . basename($_FILES['upload']['name']);

    $uploadVerification = true;



    //Check to see if the file already exists..if it does it sets the uploadVerification to false and it wont enter the if statement for if($uploadVerification == true)
    if (file_exists($target_file)){
        $uploadVerification = false;
        $ret = "This file already exists.";
    }

    //Checks the file type to see if it is an approved type
    $file_type = $_FILES['upload']['type'];

    switch ($file_type) { //Switch case for the file types that are allowed to be uploaded
      case 'image/jpeg':
        $uploadVerification = true;
        break;

      case 'image/png':
        $uploadVerification = true;
        break;

      case 'image/gif':
        $uploadVerification = true;
        break;

      default:
        $uploadVerification = false;
        $ret = "Sorry! It appears your file type is not supported! Only JPEGs, PNGs, and GIFs may be used for your profile picture!";
    }

    if ($uploadVerification) {
       $thisuser=$_SESSION['user_id'];
        move_uploaded_file($_FILES['upload']['tmp_name'], $target_file);
        $newpicture="UPDATE fm_users SET image_url='$target_file' WHERE user_id=$thisuser;";
        $conn->query($newpicture);
        $_SESSION['image_url']=$target_file;
        header('Location: profile.php');
    }

    else{
      echo $ret;
    }

  }
 ?>