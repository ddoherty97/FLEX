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
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!--  -->
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="../users/profile.php">Profile</a>
                <a href="../tracking/tracking.php">Tracking</a>
                <a href="goals.php">Goals</a>
                <a href="../reports/reports.php">Reports</a>
                <a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        	<h1>FLEX</h1>
        	<h2>Spiritual Goals</h2>
        	
        	<form method="POST" action=""> <!-- add php -->
				<label for="spiritualGoalType">Spiritual Goal Type<sup>*</sup>: </label>
	 				<select id="spiritualGoalType" name="spiritualGoalType" onchange="check(this);">
						<option value="-1">Select</option>  
			  			<option value="0">Duration</option>
						<option value="1">Events</option>
					</select> <br><br>
        	
        		<div id="ifDuration" style="display:none;">
					<label for="durationGoal">Spiritual Duration Goal<sup>*</sup>: </label>
						<input type="text" name="durationGoal" id="durationGoal" size="5"> Hours<br>
						<p><i>A Spiritual Duration Goal sets a goal based on spending a certain amount of time 
							on spiritual activities.  For example, a goal could be that you want to spend 3 hours 
							a week at the chapel.</i></p>
				</div>

				<div id="ifEvents" style="display:none;">
					<label for="eventGoal">Spiritual Events Goal<sup>*</sup>: </label>
						<input type="text" name="eventGoal" id="eventGoal" size="5"> Events<br>
						<p><i>A Spiritual Events Goal sets a goal based on attending a certain amount of spiritual events.
							  For example, a goal could be that you want to attend 2 masses a week.</i></p>
				</div>
				
				<script>
					
					function check(that) 
					{
	                	if (that.value == 0) 
	                	{
	                    	document.getElementById("ifDuration").style.display = "block";
	                       	document.getElementById("ifEvents").style.display = "none";
						}
	                  	else if (that.value == 1) 
	                	{
	                    	document.getElementById("ifEvents").style.display = "block";
	                    	document.getElementById("ifDuration").style.display = "none";
	                  	}
	              	}
					
				</script>
				
				<label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
 						<input type="text" name="numDays" id="numDays" size="5"> Day(s)<br><br>
 						
 					<button type="submit"  value="Submit">Submit</button>
 			</form>
				
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