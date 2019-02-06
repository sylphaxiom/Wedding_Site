/*
Author: Jacob Pell
Date: 12/10/2018
Script: wedding.js
Description: This script will serve to validate the login form
	     on the wedding website. There is a lot that is needed
	     for validation and this is the best way to do the work.
*/

/* run setup functions when page finishes loading */
if (window.addEventListener) {
	window.addEventListener("load", setUpPage, false);
	console.log("Loading setUpPage");
} else if (window.attachEvent) {
	window.attachEvent("onload", setUpPage);
	console.log("For IE8");
}

function setUpPage() {
	console.log("Running setUpPage");
	createEventListeners();
}

function validateUname() 
{
	console.log("beginning username validation");
	var uname = document.getElementById("username").value;
	var inValid = true;
	try
	{
		if(!/^\w{5,10}/.test(uname)){
			inValid = false;
			throw "Username not between 5 and 10 characters. Username is " + uname;
		} else {
			AjaxFunction("username");
		}
	}//end try
	catch(e){
		console.log(e);
		document.getElementById("unameHelp").classList.add("errRed");
	}
}//end validateUname

function AjaxFunction(item) 
{
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
	
	if (item == "username")
	{
		console.log("Now processing AJAX request");
		ajaxRequest.onreadystatechange = function()
		{
			console.log(ajaxRequest.statusText);
			console.log(ajaxRequest.readyState);
			if(ajaxRequest.readyState == 4) 
			{
				console.log("Entering IF READYSTATE");
				var ajaxDisplay = document.getElementById('unameHelp');
				var resultText = ajaxRequest.responseText;
				ajaxDisplay.innerHTML = resultText;
				if (resultText.includes("yes"))
				{
					ajaxDisplay.classList.add("validGreen");
				}
				else if (resultText.includes("sorry"))
				{
					ajaxDisplay.classList.add("errRed");
				}
				else
				{
					ajaxDisplay.innerHTML = "Something went wrong";
				}
				console.log("response text is = " + resultText);
			}
		}
		var uname = document.getElementById('username').value;
		console.log("username is = " + username);
		var queryString = "?uname=" + uname;
		console.log("queryString is = " + queryString);
		ajaxRequest.open("GET", "ajax.php" + queryString, true);
		ajaxRequest.send(null);
		console.log("Ending ajaxRequest");
	}
}

function createEventListeners(){
	var username = document.getElementById("username");
	if(username.addEventListener){
		username.addEventListener("blur", validateUname, false);
	}
	else if (username.attchEvent) {
		username.attachEvent("onblur", validateUname);
	}
}
/*	This is where I'm putting bits I'll need later	*/
/*
	var pwValid = true;
  	var pword = document.getElementById("Password");
*/