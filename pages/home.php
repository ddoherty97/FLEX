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
            <a href="home.html"><img src="../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!-- -->
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
        <h1>
            FLEX    
        </h1>
        <h2>Quick Links</h2>
            <p style="font-style: italic">Click any of the following to navigate to Fairfield University resources:</p>
            <a href="https://www.fairfield.edu/undergraduate/student-life-and-services/health-and-wellness/fitness-recreation/" style="text-decoration: none; ">Fitness and Recreation</a>
            <br><br><a href="https://www.fairfield.edu/library/" style="text-decoration: none;">Library</a>
            <br><br><a href="https://www.fairfield.edu/catholic-and-jesuit/campus-ministry/liturgy-worship/" style="text-decoration: none;">Egan Chapel</a>
            <br><br><a href="https://www.fairfield.edu/museum/" style="text-decoration: none;">Bellarmine Museum</a>
            <br><br><a href="https://www.fairfield.edu/undergraduate/student-life-and-services/student-  services/dining/" style="text-decoration: none;">Dining</a>
            <br><br><a href="https://www.fairfield.edu/undergraduate/student-life-and-services/health-and-wellness/counseling-and-psychological-services/" style="text-decoration: none;">Counseling</a>
        
        <!--Logout button?-->
        <form method="POST" action="../php/logout.php"> 
        <input type="submit" value="Logout">
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