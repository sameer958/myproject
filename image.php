!DOCTYPE html> 
<html> 
  
<head> 
    <title>Image Upload</title> 
    <link rel="stylesheet" 
          type="text/css"
          href="style.css" /> 
</head> 
  
<body> 
    <div id="content"> 
  
        <form method="POST" action="" enctype="multipart/form-data"> 
            <input type="file" name="uploadfile" value="" /> 
  
            <div> 
                <button type="submit"name="upload"> 
                  UPLOAD 
                </button> 
            </div> 
        </form> 
    </div> 
	<?php 
error_reporting(0); 
?> 
<?php 
$con=MySQLi_connect("localhost","root",""); 

MySQLi_select_db($con,"image");
  $msg = ""; 
  
  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 
  
    $filename = $_FILES["uploadfile"]["name"]; 
    $tempname = $_FILES["uploadfile"]["tmp_name"];     
        $folder = "image/".$filename; 
          
   
        // Get all the submitted data from the form 
        $sql = "INSERT INTO img (filename) VALUES ('$filename')"; 
  
        // Execute query 
        MySQLi_query($con,$sql); 
          
        // Now let's move the uploaded image into the folder: image 
        if (move_uploaded_file($tempname, $folder))  { 
            $msg = "Image uploaded successfully"; 
        }else{ 
            $msg = "Failed to upload image"; 
      } 
  } 
  $result = MySQLi_query($con, "SELECT * FROM image"); 
?> 
<?php
$con=MySQLi_connect("localhost","root",""); 

MySQLi_select_db($con,"image");
 // Using database connection file here

$records = mysqli_query($con,"select * from img"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
 
    
    <img src="<?php echo $data['filename']; ?> "width="200" height="200" >	
<?php
}
?>

</body> 
  
</html> 