<?php
if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]))
{
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        print("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    }
    else
    {
        print("File is not an image.");
        $uploadOk = 0;
    }
    

    if (file_exists($target_file)) 
    {
        print("Sorry, file already exists.");
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000)  // 500 000 B, eller 500 kB
     {
        print("Sorry, your file is too large.");
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
    {
        print("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }

    if($uploadOk == 0)
    {
        print("Sorry, your file was not uploaded");
    }
    else
    {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            print("The file ".basename($_FILES["fileToUpload"]["name"]). " has been uploaded.");
        }
        else
        {
            print("Sorry, there was an error uploading your file.");
        }
    }
}
else
{
    "No file was uploaded or form was not submitted";
}
?>