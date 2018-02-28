<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body>
        <header>
            <a href="home.html"><img src="../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="profile.html">Profile</a>
                <a href="synchronize.html">Synchronize</a>
                <a href="tracking.html">Tracking</a>
                <a href="goals.html">Goals</a>
                <a href="reports.html">Reports</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
            <form method="POST" action="../php/CreateUser.php">
        	<label for="fuID">Fairfield ID<sup>*</sup>: </label>
 				<input type="text" name="fuID" id="fuID"><br><br>
 				
 			<label for="username">Username<sup>*</sup>: </label>
 				<input type="text" name="username" id="username"><br><br>
 				
  			<label for="password">Password<sup>*</sup>: </label>
				  <input type="password" name="password" id="password"><br><br>
				  
			<label for="cpassword">Confirm Password<sup>*</sup>: </label>
  				<input type="password" name="cpassword" id="cpassword"><br><br>
  				
  			<label for="firstname">First Name<sup>*</sup>: </label>
 				<input type="text" name="firstname" id="firstname"><br><br>
 				
  			<label for="lastname">Last Name<sup>*</sup>: </label>
  				<input type="text" name="lastname" id="lastname"><br><br>
  				
  			<label for="DOB">Date of Birth<sup>*</sup>: </label>
 				<input type="date" name="DOB" id="DOB"><br><br>
 				
 			<label for="gender">Gender<sup>*</sup>: </label>
 				<select id="gender" name="gender">
					<option value="-1">Select</option>  
					<option value="M">Male</option>
  					<option value="F">Female</option>
  					<option value="O">Other</option>
				</select> <br><br>
				
			<label>Height<sup>*</sup>: </label>
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
				</select>"<br><br>
 				
 			<label for="weight">Weight: </label>
 				<input type="text" name="weight" id="weight" size="10">lbs<br><br>
 				
 			<label for="religion">Religious Preference: </label>
 				<input type="text" name="religion" id="religion"><br><br>

 			<label for="phone">Phone Number<sup>*</sup>: </label>
 				<input type="tel" name="phone" id="phone"><br><br>
 				
 			<label for="email">Email<sup>*</sup>: </label>
 				<input type="email" name="email" id="email"><br><br>
 				
 			<label for="role">Role<sup>*</sup>: </label>
 				<select id="role" name="role">
					<option value="-1">Select</option>  
					<option value="0">Faculty/Staff</option>
  					<option value="1">Student</option>
				</select> <br><br>
				
			<label for="school">School<sup>*</sup>: </label>
 				<select id="school" name="school">
					<option value="-1">Select</option>  
					<option value="ENG">Engineering</option>
  					<option value="NUR">Nursing</option>
  					<option value="AaS">Arts and Sciences</option>
  					<option value="DSB">Business</option>
				</select> <br><br>
			
			<label for="dept">Department<sup>*</sup>: </label>
 				<select name="dept" id="dept">
					 <option value="-1">Select</option>
					 <option value="CS">Computer Science</option>
				</select><br><br>	
 			
			<label for="res">Residence<sup>*</sup>: </label>	 
				<select name="res" id="res">
					<option value="-1">Select</option>
					<option value="MDZ">Meditz Hall</option>
			   </select> <br><br>
				
			<label for="major1">Major<sup>*</sup>: </label>
				<select name="major1" id="major1">
					<option value="-1">Select</option>
					<option value="Software Engineering">Software Engineering</option>
				</select> <br><br>
				
 			<label for="major2">Major: </label>
			 <select name="major2" id="major2">
					<option value="-1">Select</option>
					<option value="Software Engineering">Software Engineering</option>
				</select> <br><br>
 				
 			<label for="major3">Major: </label>
			 <select name="major3" id="major3">
					<option value="-1">Select</option>
					<option value="Software Engineering">Software Engineering</option>
				</select> <br><br>
			
			<label for="minor1">Minor: </label>
				<select name="minor1" id="minor1">
					<option value="-1">Select</option>
					<option value="Mathematics">Mathematics</option>
				</select> <br><br>
 				
 			<label for="minor2">Minor: </label>
			 <select name="minor2" id="minor2">
					<option value="-1">Select</option>
					<option value="Mathematics">Mathematics</option>
				</select> <br><br>
 				
 			<label for="minor3">Minor: </label>
				<select name="minor3" id="minor3">
					<option value="-1">Select</option>
					<option value="Mathematics">Mathematics</option>
				</select> <br><br>
 				
 			<label for="minor4">Minor: </label>
			 <select name="minor4" id="minor4">
					<option value="-1">Select</option>
					<option value="Mathematics">Mathematics</option>
				</select> <br><br>
 				
 			<input type="submit" value="Submit">
		</form>
        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">
            1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>
            
    </body>
</html>
