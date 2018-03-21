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
            <a href="home.html"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="../users/profile.html">Profile</a>
                <a href="synchronize.html">Synchronize</a>
                <a href="tracking.html">Tracking</a>
                <a href="../goals/goals.html">Goals</a>
                <a href="../reports/reports.html">Reports</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        		<h1> FLEX </h1>
			<h2>Screen Time Tracking</h2>
			<p>
                Lets track your Device Usage!
                    <br>
               
			</p>

			<form action="/action_page.php">


				
				<label for = "date">Date </label>
				<br>
				<input type="date" id = "date" name="date" >
				<br>
				<br>
				<label for="type">Start Time : </label>
				<input type="time" id = "sTime" name="sTime">
				<br>
				<br>
				<label for="type">End Time : </label>
				<input type="time" id = "eTime" name="eTime">
				<br>
				<br>
				<label for="type">What type of device did you use : </label>
				<select>
  				<option value="1">Phone</option>
  				<option value="2">Computer/Laptop</option>
  				<option value="3">Tablet</option>
  				<option value="4">TV</option>
  				<option value="4">Gaming System</option>
  				</select>
  				<input type="submit" value="Submit">
			</form>
        </main>
        <footer>
            <br>
            <div style="float:left; display: inline;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: inline">
            1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>
            
    </body>
</html>