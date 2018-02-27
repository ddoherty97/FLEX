<?php
    /**
     * CreateUser.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a user to the FLEX application. It will process the create user form fields on
     * the profile.html page. Note: This is intended to be an action script
     * 
     * Author: Davis Doherty
     * Last Updated: 2/26/18 DD
     **/

    //include script to ensure no unauthorized access
    require("IsLoggedIn.php");

    //only run if form was submitted
    if(isset($_POST['fuID']))
    {
        //get submitted form data
        $ffldID = $_POST['fuID'];           //fairfield id
        $user = $_POST['username'];         //new username
        $pass = $_POST['password'];         //new password
        $fName = $_POST['firstname'];       //first name
        $lName = $_POST['lastname'];        //last name
        $dob = $_POST['DOB'];               //date of birth
        $gender = $_POST['gender'];         //gender
        $heightft = $_POST['heightft'];     //height in ft
        $heightin = $_POST['heightin'];     //height in inches
        $weight = $_POST['weight'];         //weight in pounds
        $religion = $_POST['religion'];     //religious prefrence
        $phone = $_POST['phone'];           //phone number
        $email = $_POST['email'];           //email
        $role = $_POST['role'];             //facstaff or student
        $school = $_POST['school'];         //school
        $dept = $_POST['dept'];             //department
        $residence = $_POST['res'];         //campus residence
        $maj1 = $_POST['major1'];           //primary major
        $maj2 = $_POST['major2'];           //other major
        $maj3 = $_POST['major3'];           //other major
        $min1 = $_POST['minor1'];           //primary minor
        $min2 = $_POST['minor2'];           //other minor
        $min3 = $_POST['minor3'];           //other minor
        $min4 = $_POST['minor4'];           //other minor








    }//end if

    //if no form submitted
    else
    {
        //redirect to home page
        header("Location: ../page/home.php");
    }//end else
?>