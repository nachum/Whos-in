<?php
session_start();
if(isset($_SESSION['Email'])) {
//  echo "Welcome Back: " . $_SESSION['Email'];
}
	$logEmail =  $_SESSION['Email'];
	require("includes/mysql_connect.php");
//	$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE Email='$Email' LIMIT 1"));
	$query = mysql_query("SELECT * FROM users WHERE Email='$logEmail'");
	$query2 = mysql_query("SELECT Business_Name FROM re");
	$query3 = mysql_query("SELECT * FROM friends_list WHERE User='$logEmail'");
	$numrows = mysql_num_rows($query);
		while ($row = mysql_fetch_assoc($query))
		{
			$dbName = $row['Private_Name'];
			$dbLast = $row['Last_Name'];			
			$dbAge = $row['Age'];
			$dbPicture = $row['Picture'];
			$dbEmail = $row['Email'];
		}
		//$TARGET_PATH .= "images/";
		$TARGET_PATH .= $dbPicture;
		$kab = explode(".", $dbPicture);
		$format = end($kab);
		
		require("includes/ak_php_ing_lib_1.0.php");
	//	$target_file = "uploads/$fileName";
	//	$resized_file = "uploads/resized_$fileName";
        $wmax = 350;
        $hmax = 250;
        ak_img_resize($TARGET_PATH, $TARGET_PATH, $wmax, $hmax, $format);
		//echo " $dbName $dbLast $dbAge <img src='".$TARGET_PATH."'>";

?>
      
      
<html>
<head>
    <meta charset="utf-8" />
    <title>User Profile</title>
    <link rel="shortcut icon" href="/images/logoIcon.ico" />
    <style type="text/css">
    	
    </style>
</head>
<body background = "19820-blue-vintage-wallpaper-background.jpg">
    <p><img src="Untitled.png" width="400" height="130">
      
	  <p>Email: <?php echo $dbEmail;?> </p>
	  <p>First Name:<?php echo $dbName;?></p>  
	  <p>Last Name:<?php echo $dbLast;?></p>
      <p><img src=<?php echo "'".$TARGET_PATH."'" ?> width="350" height="280"></p>
      <p>&nbsp;</p>
      <p>Places we work with: 	<?php echo "<br>";
	  							$i=mysql_num_rows($query2);
	  							while($i!=0)
	  							{
									$Business = mysql_fetch_assoc($query2);
									echo $Business['Business_Name']."<br>";
									$i--;	
								}
	  							?></p>
<p>&nbsp;</p>
                                        
      <p>Friends List: 			<?php echo "<br>";
	  							$i=mysql_num_rows($query3);
	  							while($i!=0)
	  							{
									$Friend = mysql_fetch_assoc($query3);
									echo $Friend['Friend']."<br>";
									$i--;	
								}
	  							?></p>
      <p>&nbsp;</p>                                  
<form action="logout.php" method ="POST">
<button type="submit" class="btn signup-btn">
            logout
          </button>
       </form>
    
</body>
</html>