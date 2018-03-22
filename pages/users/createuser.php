<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/CreateUserStyle.css">
		<script src="../../javascript/createuser.js"></script>
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
						<a href="tracking.php">Tracking</a>
						<a href="goals.php">Goals</a>
						<a href="reports.php">Reports</a>
						<a href="../../php/logout.php">Logout</a>			
						</div>
					</li>
				</ul>
			</nav>
        </header>
        <main>
            <?php
				//get form submission status
				if(isset($_GET["status"]))
				{
					$status = $_GET["status"];
				}//end if
				else
				{
					$status = "new";
				}//end else

				//only show form if no message to display
				if($status=="new")
				{
			?>
			<form method="POST" action="../../php/CreateUser.php" onsubmit="return validateUserSubmission();">
				<div class="newUserInput">
					<label for="fuID">Fairfield ID<sup>*</sup>:</label>
					<input type="text" name="fuID" id="fuID" maxlength="8">
					<div class="errorMSG" id="fuID_error"></div>
				</div>
 				
				<div class="newUserInput">
					<label for="email">Email<sup>*</sup>:</label>
					<input type="email" name="email" id="email" maxlength="50" onchange="showUserSpecificFields();">
					<div class="errorMSG" id="email_error"></div>
				</div>
			 
				<div class="newUserInput">
					<label for="username">Username<sup>*</sup>:</label>
					<input type="text" name="username" id="username" maxlength="80">
					<div class="errorMSG" id="username_error"></div>
				</div>
 				
				<div class="newUserInput">
					<label for="password">Password<sup>*</sup>:</label>
					<input type="password" name="password" id="password">
					<div class="errorMSG" id="password_error"></div>
				</div>
				  
				<div class="newUserInput">
					<label for="cpassword">Confirm Password<sup>*</sup>:</label>
					<input type="password" name="cpassword" id="cpassword">
					<div class="errorMSG" id="confirm_error"></div>
				</div>
  				
				<div class="newUserInput">
					<label for="firstname">First Name<sup>*</sup>:</label>
					<input type="text" name="firstname" id="firstname" maxlength="50">
					<div class="errorMSG" id="fname_error"></div>
				</div>
 				
				<div class="newUserInput">
					<label for="lastname">Last Name<sup>*</sup>:</label>
					<input type="text" name="lastname" id="lastname" maxlength="50">
					<div class="errorMSG" id="lname_error"></div>
				</div>
				  
				<div class="newUserInput">
					<label for="DOB">Date of Birth<sup>*</sup>:</label>
					<input type="date" name="DOB" id="DOB">
					<div style="font-size: .8em; font-style: italic;">Select a date or use the format yyyy-mm-dd</div>
					<div class="errorMSG" id="dob_error"></div>
				</div>

				<div class="newUserInput">
					<label for="gender">Gender<sup>*</sup>:</label>
					<select id="gender" name="gender">
						<option value="-1">Select</option>  
						<option value="M">Male</option>
						<option value="F">Female</option>
						<option value="O">Other</option>
					</select>
					<div class="errorMSG" id="gender_error"></div>
				</div>
				
				<div class="newUserInput">
					<label>Height<sup>*</sup>:</label>
					<select name="heightft" id="heightft">
						<option value="-1">Select</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
					</select>'
					<select name="heightin" id="heightin">
						<option value="-1">Select</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
					</select>"
					<div class="errorMSG" id="height_error"></div>
				</div>
 				
				<div class="newUserInput">
					<label for="weight">Weight:</label>
					<input type="text" name="weight" id="weight" size="10" maxlength="3">lbs
					<div class="errorMSG"></div>
				</div>
 				
				<div class="newUserInput">
					<label for="religion">Religious Preference:</label>
					<select name="religion" id="religion">
						<?php
							//load all religions from php file
							require("../../php/loadReligionSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>

 				<div class="newUserInput">
					<label for="phone">Phone Number<sup>*</sup>:</label>
					<input type="tel" name="phone" id="phone" maxlength="15">
					<div class="errorMSG" id="phone_error"></div>
				</div>
				
				<div class="newUserInput">
					<label for="school">School<sup>*</sup>:</label>
						<select id="school" name="school">
							<option value="-1">Select</option>  
							<option value="Engineering">Engineering</option>
							<option value="Nursing">Nursing</option>
							<option value="Arts and Sciences">Arts and Sciences</option>
							<option value="Business">Business</option>
						</select>
					<div class="errorMSG" id="school_error"></div>
				</div>

				<div class="newUserInput studentRole">
					<label for="year">Class Year<sup>*</sup>:</label>
					<select id="year" name="year">
						<option value="-1">Select</option>  
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
					</select>
					<div class="errorMSG" id="class_error"></div>
				</div>

				<div class="newUserInput facstaffRole">
					<label for="dept">Department<sup>*</sup>:</label>
					<select name="dept" id="dept">
						<?php
							//load all departments from php file
							require("../../php/loadDeptSelect.php");
						?>
					</select>
					<div class="errorMSG" id="dept_error"></div>
				</div>	
 			
				<div class="newUserInput studentRole">
					<label for="res">Residence<sup>*</sup>:</label>	 
					<select name="res" id="res">
						<?php
							//load all residencies from php file
							require("../../php/loadResSelect.php");
						?>
					</select>
					<div class="errorMSG" id="res_error"></div>
				</div>
				
				<div class="newUserInput studentRole">
					<label for="major1">Major<sup>*</sup>:</label>
					<select name="major1" id="major1">
						<?php
							//load all majors from php file
							require("../../php/loadMajorSelect.php");
						?>
					</select>
					<div class="errorMSG" id="maj1_error"></div>
				</div>
				
				<div class="newUserInput studentRole">
					<label for="major2">Major:</label>
					<select name="major2" id="major2">
						<?php
							//load all majors from php file
							require("../../php/loadMajorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>
 				
				<div class="newUserInput studentRole">
					<label for="major3">Major:</label>
					<select name="major3" id="major3">
						<?php
							//load all majors from php file
							require("../../php/loadMajorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>
			
				<div class="newUserInput studentRole">
					<label for="minor1">Minor:</label>
					<select name="minor1" id="minor1">
						<?php
							//load all minors from php file
							require("../../php/loadMinorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>
 				
				<div class="newUserInput studentRole">
					<label for="minor2">Minor:</label>
					<select name="minor2" id="minor2">
						<?php
							//load all minors from php file
							require("../../php/loadMinorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>
 				
				<div class="newUserInput studentRole">
					<label for="minor3">Minor:</label>
					<select name="minor3" id="minor3">
						<?php
							//load all minors from php file
							require("../../php/loadMinorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>
 				
				<div class="newUserInput studentRole">
					<label for="minor4">Minor:</label>
					<select name="minor4" id="minor4">
						<?php
							//load all minors from php file
							require("../../php/loadMinorSelect.php");
						?>
					</select>
					<div class="errorMSG"></div>
				</div>

 				<input type="submit" value="Create Account">
			</form>
			<?php
				}//end if

				//show error message if ID already exists
				else if($status=="fail-id")
				{
			?>
			<div class="errorHeader">Error: Account Not Created</div>
			<div class="errorBody">
				We're sorry, but we could not create your account because the Fairfield ID you entered is already associated with an account.
					<br>
				<a href="javascript:window.history.back();">Retry.</a>
			</div>
			<?php
				}//end if

				//show error message if username already exists
				else if($status=="fail-user")
				{
			?>
			<div class="errorHeader">Error: Account Not Created</div>
			<div class="errorBody">
				We're sorry, but we could not create your account because the username you entered is already associated with an account.
					<br>
				<a href="javascript:window.history.back();">Retry.</a>
			</div>
			<?php
				}//end if

				//show error message if email already exists
				else if($status=="fail-email")
				{
			?>
			<div class="errorHeader">Error: Account Not Created</div>
			<div class="errorBody">
				We're sorry, but we could not create your account because the email address you entered is already associated with an account.
				<br>
				<a href="javascript:window.history.back();">Retry.</a>
			</div>
			<?php
				}//end if

				//show error message if server error
				else if($status=="fail-server")
				{
			?>
			<div class="errorHeader">Error: Account Not Created</div>
			<div class="errorBody">
				We're sorry, but we could not create your account due to a server error. Please try again.
					<br>
				<a href="javascript:window.history.back();">Retry.</a>
			</div>
			<?php
				}//end if

				//show error message if unknown error occured
				else if($status=="fail-unknown")
				{
			?>
			<div class="errorHeader">Error: Account Not Created</div>
			<div class="errorBody">
				We're sorry, but we could not create your account because an unknown error occurred.
					<br>
				<a href="javascript:window.history.back();">Retry.</a>
			</div>
			<?php
				}//end if

				//show success message if account created
				else if($status=="success")
				{
			?>
			<div class="errorHeader">Account Successfully Created!</div>
			<div class="errorBody">Your new FLEX account has been created! You can now <a href="login.php">login</a>.</div>
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
