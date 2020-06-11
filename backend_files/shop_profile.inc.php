<?php
$conn = mysqli_connect( 'localhost','root',"",'dmce' );
session_start();
$username= $_SESSION['username'];

    // $conn = mysqli_connect('localhost', 'root','','house');
    $filename ="";   
    $target_directory = "../DB_docs_images/profile_images/".$username;
    if(!is_dir("../DB_docs_images/profile_images/$username")){
        mkdir("../DB_docs_images/profile_images/$username");
    }else{
        
        rmdir("../DB_docs_images/profile_images/$username");
        mkdir("../DB_docs_images/profile_images/$username");
    }
    $target_file = $target_directory.basename($_FILES['file']['name']);

    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $filename .= $_SESSION['username']."profimg.".$filetype;
    $query="INSERT INTO files(filename) VALUES('$filename')";

        if(mysqli_query($conn,$query)){
            $newfilename = $filename;
            
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename)) echo $filename;
            else echo $_FILES['file']['name'];
    };


    
?>