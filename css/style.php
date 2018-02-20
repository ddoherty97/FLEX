h1	{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    color:#e03a3e;
    text-align:center;
    font-size:60px;
}
body    {
    font-family: sans-serif;
}
main   {
    text-align: center;
}

main a  {
    text-decoration: none;
    color: #e03a3e;
}

main a:hover    {
    color: #CCC;
}


header img, header nav {
    display: inline;
    vertical-align: middle;
}

header img  {
    width: 12%;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #e03a3e;
    float:right;
    width:88%
}

li {
    float: right;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 16px;
    text-decoration: none;
}



li a:hover, .dropdown:hover .dropbtn {
    background-color: #A00;
}

li.dropdown {
    display: inline;
	float: right;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    right:0;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover, 

.dropdown:hover .dropdown-content {
    display: block;
}
