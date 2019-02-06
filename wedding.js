/*
Author: Jacob Pell
Date: 12/10/2018
Script: wedding.js
Description: This script will serve to validate the login form
	     on the wedding website. There is a lot that is needed
	     for validation and this is the best way to do the work.
*/

function validateUname() {
  	console.log("beginning username validation");
  	var uname = document.getElementById("UserName");
	var unValid = true;
  	try{
    	
	}//end try
}//end validateUname

function AjaxFunction() {
	console.log("Beginning AJAX request");
	var ajaxRequest; // The variable that makes the AJAX magic possible!
	try{
		// REAL BROWSERS
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		// Internet Exploder Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	console.log("Now processing AJAX request");
	ajaxRequest.onreadystatechange = function(){
		console.log(ajaxRequest.statusText);
		console.log(ajaxRequest.readyState);
		if(ajaxRequest.readyState == 4) 
		{
			console.log("Entering IF READYSTATE");
			var ajaxDisplay = document.getElementById('unameHelp');
			var resultText = ajaxRequest.responseText;
			ajaxDisplay.innerHTML = resultText;
			console.log("response text is = " + resultText);
		}
	}
	var uname = document.getElementById('username').value;
	console.log("username is = " + username);
	var queryString = "?uname=" + uname;
	console.log("queryString is = " + queryString);
	ajaxRequest.open("GET", "course-info-query.php" + queryString, true);
	ajaxRequest.send(null);
	console.log("Ending IF PROGRAM");
}
/*	This is where I'm putting bits I'll need later	*/
/*
	var pwValid = true;
  	var pword = document.getElementById("Password");
*/