<?php require("login.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="homestyle.css">
        <link rel="stylesheet" href="css/styles.css?v=1.0">
    </head>
    
    <body>
        <header>
            <a href="home.html"><img src="antlers.png" alt="logo" height="50px" width="50px"/></a>
        </header>
        <main>
	       <h1>
	           FLEX    
	       </h1>
	       <script src="js/scripts.js"></script>
	        <form method="POST" action="">
	            login test<br>
	            <input type="text" name="formUser"><br>
	            <input type="text" name="formPass"><br>
	            <input type="submit" value="submit"><br>
	            <?php echo $message."<br>";?>
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

