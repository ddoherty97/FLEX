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
			 	<select name="religion" id="religion">
					<option value="-1">Select</option>
					<option value="0">R0</option>
					<option value="1">R1</option>
					<option value="2">R2</option>
					<option value="3">R3</option>
					<option value="4">R4</option>
					<option value="5">R5</option>
					<option value="6">R6</option>
					<option value="7">R7</option>
					<option value="8">R8</option>
					<option value="9">R9</option>
				</select><br><br>

 			<label for="phone">Phone Number<sup>*</sup>: </label>
 				<input type="tel" name="phone" id="phone"><br><br>
 				
 			<label for="email">Email<sup>*</sup>: </label>
 				<input type="email" name="email" id="email"><br><br>
				
			<label for="year">Class Year<sup>*</sup>: </label>
 				<select id="year" name="year">
					<option value="-1">Select</option>  
					<option value="18">2018</option>
  					<option value="19">2019</option>
  					<option value="20">2020</option>
  					<option value="21">2021</option>
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
					 <option value="-1">---Arts and Sciences---</option>
					 <option value="Anthropology">Anthropology</option>
					 <option value="Applied Ethics">Applied Ethics</option>
					 <option value="Art History">Art History</option>
					 <option value="Asian Studies">Asian Studies</option>
					 <option value="Arabic">Arabic</option>
					 <option value="Biology">Biology</option>
					 <option value="Black Studies">Black Studies</option>
					 <option value="Chemistry">Chemistry</option>
					 <option value="Chinese">Chinese</option>
					 <option value="Classical Studies">Classical Studies</option>
					 <option value="Communication">Communication</option>
					 <option value="Economics">Economics</option>
					 <option value="Education">Education</option>
					 <option value="English">English</option>
					 <option value="Environmental Studies">Environmental Studies</option>
					 <option value="Film, Television and Media Arts">Film, Television and Media Arts</option>
					 <option value="French">French</option>
					 <option value="German">German</option>
					 <option value="Graphic Design">Graphic Design</option>
					 <option value="Greek">Greek</option>
					 <option value="Hebrew">Hebrew</option>
					 <option value="History">History</option>
					 <option value="Humanitarian Action">Humanitarian Action</option>
					 <option value="Humanities">Humanities</option>
					 <option value="International Studies">International Studies</option>
					 <option value="Irish Studies">Irish Studies</option>
					 <option value="Italian">Italian</option>
					 <option value="Japanese">Japanese</option>
					 <option value="Latin">Latin</option>
					 <option value="Latin American and Caribbean Studies">Latin American and Caribbean Studies</option>
					 <option value="Mathematics">Mathematics</option>
					 <option value="Music">Music</option>
					 <option value="Philosophy">Philosophy</option>
					 <option value="Physics">Physics</option>
					 <option value="Politics">Politics</option>
					 <option value="Psychology">Psychology</option>
					 <option value="Religious Studies">Religious Studies</option>
					 <option value="Russian">Russian</option>
					 <option value="Sociology">Sociology</option>
					 <option value="Spanish">Spanish</option>
					 <option value="Studio Art">Studio Art</option>
					 <option value="Theatre">Theatre</option>
					 <option value="Women, Gender and Sexuality Studies">Women, Gender and Sexuality Studies</option>
					 <option value="-1">---Business---</option>
					 <option value="Accounting">Accounting</option>
					 <option value="Business">Business</option>
					 <option value="Economics">Economics</option>
					 <option value="Finance">Finance</option>
					 <option value="Information Systems">Information Systems</option>
					 <option value="Management">Management</option>
					 <option value="Marketing">Marketing</option>
					 <option value="Operations Management">Operations Management</option>
					 <option value="-1">---Engineering---</option>
					 <option value="Bioengineering">Bioengineering</option>
					 <option value="Computer Engineering">Computer Engineering</option>
					 <option value="Computer Science">Computer Science</option>
					 <option value="Electrical Engineering">Electrical Engineering</option>
					 <option value="Engineering">Engineering</option>
					 <option value="Mechanical Engineering">Mechanical Engineering</option>
					 <option value="Software Engineering">Software Engineering</option>
					 <option value="-1">---Nursing---</option>
					 <option value="Health Studies">Health Studies</option>
					 <option value="Nursing">Nursing</option>
					 <option value="Public Health">Public Health</option>
					 
				</select><br><br>	
 			
			<label for="res">Residence<sup>*</sup>: </label>	 
				<select name="res" id="res">
					<option value="-1">Select</option>
					<option value="Campion">Campion</option>
					<option value="Gonzaga">Gonzaga</option>
					<option value="Jogues">Jogues</option>
					<option value="Regis">Regis</option>
					<option value="Claver">Claver</option>
					<option value="Kostka">Kostka</option>
					<option value="Faber">Faber</option>
					<option value="Loyola">Loyola</option>
					<option value="McCormick">McCormick</option>
					<option value="Dolan">Dolan</option>
					<option value="Mahan">Mahan</option>
					<option value="Meditz">Meditz</option>
					<option value="Townhouses">Townhouses</option>
					<option value="Off-Campus">Off-Campus</option>
			   </select> <br><br>
				
			<label for="major1">Major<sup>*</sup>: </label>
				<select name="major1" id="major1">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Bioengineering">Bioengineering</option>
					<option value="Biology">Biology</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Communication">Communication</option>
					<option value="Computer Engineering">Computer Engineering</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="Electrical Engineering">Electrical Engineering</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="History">History</option>
					<option value="Individually Designed">Individually Designed</option>
					<option value="Italian">Italian</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="International Business">International Business</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Liberal Studies">Liberal Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Nursing">Nursing</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Health">Public Health</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Software Engineering">Software Engineering</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
				</select> <br><br>
				
 			<label for="major2">Major: </label>
			 <select name="major2" id="major2">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Bioengineering">Bioengineering</option>
					<option value="Biology">Biology</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Communication">Communication</option>
					<option value="Computer Engineering">Computer Engineering</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="Electrical Engineering">Electrical Engineering</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="History">History</option>
					<option value="Individually Designed">Individually Designed</option>
					<option value="Italian">Italian</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="International Business">International Business</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Liberal Studies">Liberal Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Nursing">Nursing</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Health">Public Health</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Software Engineering">Software Engineering</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
				</select> <br><br>
 				
 			<label for="major3">Major: </label>
			 <select name="major3" id="major3">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Bioengineering">Bioengineering</option>
					<option value="Biology">Biology</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Communication">Communication</option>
					<option value="Computer Engineering">Computer Engineering</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="Electrical Engineering">Electrical Engineering</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="History">History</option>
					<option value="Individually Designed">Individually Designed</option>
					<option value="Italian">Italian</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="International Business">International Business</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Liberal Studies">Liberal Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Nursing">Nursing</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Health">Public Health</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Software Engineering">Software Engineering</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
				</select> <br><br>
			
			<label for="minor1">Minor: </label>
				<select name="minor1" id="minor1">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Applied Ethics">Applied Ethics</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Asian Studies">Asian Studies</option>
					<option value="Behavioral Neuroscience">Behavioral Neuroscience</option>
					<option value="Biology">Biology</option>
					<option value="Black Studies">Black Studies</option>
					<option value="Catholic Studies">Catholic Studies</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Classical Studies">Classical Studies</option>
					<option value="Communication">Communication</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="Graphical Design">Graphical Design</option>
					<option value="Health Studies">Health Studies</option>
					<option value="History">History</option>
					<option value="Humanitarian Action">Humanitarian Action</option>
					<option value="Italian">Italian</option>
					<option value="Italian Studies">Italian Studies</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Irish Studies">Irish Studies</option>
					<option value="Judaic Studies">Judaic Studies</option>
					<option value="Latin American and Caribbean Studies">Latin American and Caribbean Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Peace and Justice Studies">Peace and Justice Studies</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Russian, East European and Central Asian Studies">Russian, East European and Central Asian Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
					<option value="Women, Gender and Sexuality Studies">Women, Gender and Sexuality Studies</option>
				</select> <br><br>
 				
 			<label for="minor2">Minor: </label>
			 <select name="minor2" id="minor2">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Applied Ethics">Applied Ethics</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Asian Studies">Asian Studies</option>
					<option value="Behavioral Neuroscience">Behavioral Neuroscience</option>
					<option value="Biology">Biology</option>
					<option value="Black Studies">Black Studies</option>
					<option value="Catholic Studies">Catholic Studies</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Classical Studies">Classical Studies</option>
					<option value="Communication">Communication</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="Graphical Design">Graphical Design</option>
					<option value="Health Studies">Health Studies</option>
					<option value="History">History</option>
					<option value="Humanitarian Action">Humanitarian Action</option>
					<option value="Italian">Italian</option>
					<option value="Italian Studies">Italian Studies</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Irish Studies">Irish Studies</option>
					<option value="Judaic Studies">Judaic Studies</option>
					<option value="Latin American and Caribbean Studies">Latin American and Caribbean Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Peace and Justice Studies">Peace and Justice Studies</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Russian, East European and Central Asian Studies">Russian, East European and Central Asian Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
					<option value="Women, Gender and Sexuality Studies">Women, Gender and Sexuality Studies</option>
				</select> <br><br>
 				
 			<label for="minor3">Minor: </label>
				<select name="minor3" id="minor3">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Applied Ethics">Applied Ethics</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Asian Studies">Asian Studies</option>
					<option value="Behavioral Neuroscience">Behavioral Neuroscience</option>
					<option value="Biology">Biology</option>
					<option value="Black Studies">Black Studies</option>
					<option value="Catholic Studies">Catholic Studies</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Classical Studies">Classical Studies</option>
					<option value="Communication">Communication</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="Graphical Design">Graphical Design</option>
					<option value="Health Studies">Health Studies</option>
					<option value="History">History</option>
					<option value="Humanitarian Action">Humanitarian Action</option>
					<option value="Italian">Italian</option>
					<option value="Italian Studies">Italian Studies</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Irish Studies">Irish Studies</option>
					<option value="Judaic Studies">Judaic Studies</option>
					<option value="Latin American and Caribbean Studies">Latin American and Caribbean Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Peace and Justice Studies">Peace and Justice Studies</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Russian, East European and Central Asian Studies">Russian, East European and Central Asian Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
					<option value="Women, Gender and Sexuality Studies">Women, Gender and Sexuality Studies</option>
				</select> <br><br>
 				
 			<label for="minor4">Minor: </label>
			 <select name="minor4" id="minor4">
					<option value="-1">Select</option>
					<option value="Accounting">Accounting</option>
					<option value="American Studies">American Studies</option>
					<option value="Applied Ethics">Applied Ethics</option>
					<option value="Art History and Visual Culture">Art History and Visual Culture</option>
					<option value="Asian Studies">Asian Studies</option>
					<option value="Behavioral Neuroscience">Behavioral Neuroscience</option>
					<option value="Biology">Biology</option>
					<option value="Black Studies">Black Studies</option>
					<option value="Catholic Studies">Catholic Studies</option>
					<option value="Chemistry and Biochemistry">Chemistry and Biochemistry</option>
					<option value="Classical Studies">Classical Studies</option>
					<option value="Communication">Communication</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Digital Journalism">Digital Journalism</option>
					<option value="Economics (Arts and Sciences)">Economics (Arts and Sciences)</option>
					<option value="Economics (Business)">Economics (Business)</option>
					<option value="Education">Education</option>
					<option value="English">English</option>
					<option value="Environmental Studies">Environmental Studies</option>
					<option value="Film, TV and Media">Film, TV and Media</option>
					<option value="Finance">Finance</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="Graphical Design">Graphical Design</option>
					<option value="Health Studies">Health Studies</option>
					<option value="History">History</option>
					<option value="Humanitarian Action">Humanitarian Action</option>
					<option value="Italian">Italian</option>
					<option value="Italian Studies">Italian Studies</option>
					<option value="Information Systems and Operations Management">Information Systems and Operations Management</option>
					<option value="Internation Studies">Internation Studies</option>
					<option value="Irish Studies">Irish Studies</option>
					<option value="Judaic Studies">Judaic Studies</option>
					<option value="Latin American and Caribbean Studies">Latin American and Caribbean Studies</option>
					<option value="Management">Management</option>
					<option value="Marketing">Marketing</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Modern Languages and Literatures">Modern Languages and Literatures</option>
					<option value="Music">Music</option>
					<option value="Peace and Justice Studies">Peace and Justice Studies</option>
					<option value="Philosophy">Philosophy</option>
					<option value="Physics">Physics</option>
					<option value="Politics">Politics</option>
					<option value="Psychology">Psychology</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Religious Studies">Religious Studies</option>
					<option value="Russian, East European and Central Asian Studies">Russian, East European and Central Asian Studies</option>
					<option value="Sociology and Anthropology">Sociology and Anthropology</option>
					<option value="Spanish">Spanish</option>
					<option value="Studio Art">Studio Art</option>
					<option value="Theatre">Theatre</option>
					<option value="Visual and Perfoming Arts">Visual and Perfoming Arts</option>
					<option value="Women, Gender and Sexuality Studies">Women, Gender and Sexuality Studies</option>
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
