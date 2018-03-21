<?php
	require("../../php/EditProfile.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="../tracking/tracking.php">Tracking</a>
                <a href="../goals/goals.php">Goals</a>
                <a href="../reports/reports.php">Reports</a>
				<a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        	Fairfield ID: <span class="userText"><?php echo $ffldId;?><br><br></span>				
 			Username: <span class="userText"><?php echo $username;?><br><br></span>				
  			Name: <span class="userText"><?php echo $fname." ".$lname;?><br><br></span>			
  			Date of Birth: <span class="userText"><?php echo $dob;?><br><br></span>				
 			Gender: 
			<span class="userText">
				<?php
					if($gender=="M")
						echo "Male";
					else if($gender=="F")
						echo "Female";
					else
						echo "Other";
				?>
				<br><br>
			</span>			
 			Email: <span class="userText"><?php echo $email;?><br><br></span>
			Phone Number: <span class="userText"><?php echo $phone;?><br><br></span>
			Height: <span class="userText"><?php echo $heightft."' ".$heightin."\"";?><br><br></span>
			School: <span class="userText"><?php echo $school;?><br><br></span>		
	<?php
		//only show weight if filled in
		if($weight!="")
		{
	?>
			Weight: <span class="userText"><?php echo $weight;?>lbs<br><br></span>
	<?php
		}//end if

		//only show religion if filled in
		if($religion!="")
		{
	?>
			Religious Preference: <span class="userText"><?php echo $religion;?><br><br></span>
	<?php
		}//end if

		//only show student characteristics if student role
		if($role=="1")
		{
	?>
			Class Year: <span class="userText"><?php echo $class;?><br><br></span>
			Residence: <span class="userText"><?php echo $residence;?><br><br></span>	
			Major: <span class="userText"><?php echo $maj1;?><br><br></span>				
	<?php
		if($maj2!="")
		{
	?>
			Major: <span class="userText"><?php echo $maj2;?><br><br></span>
	<?php
		}//end if

		if($maj3!="")
		{
	?>
			Major: <span class="userText"><?php echo $maj3;?><br><br></span>
	<?php
		}//end if

		if($min1!="")
		{
	?>
			Minor: <span class="userText"><?php echo $min1;?><br><br></span>
	<?php
		}//end if

		if($min2!="")
		{
	?>
			Minor: <span class="userText"><?php echo $min2;?><br><br></span>
	<?php
		}//end if
	
		if($min3!="")
		{
	?>
			Minor: <span class="userText"><?php echo $min3;?><br><br></span>
	<?php
		}//end if

		if($min4!="")
		{
	?>
			Minor: <span class="userText"><?php echo $min4;?><br><br></span>
	<?php
		}//end if
		}//end if

		//only show if faculty characteristics if facstaff role
		else if($role=="0")
		{
	?>
			Department: <span class="userText"><?php echo $dept;?><br><br></span>
	<?php
		}//end else
	?>					
		</main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">
            <br>1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>
            
    </body>
</html>
