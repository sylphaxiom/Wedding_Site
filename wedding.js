/*
Author: Jacob Pell
Date: 12/10/2018
Script: wedding.js
Description: This script will serve to validate the login form
	     on the wedding website. There is a lot that is needed
	     for validation and this is the best way to do the work.
*/

/* Globals */

var valArr = Array();

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

/* Validate the username field */

function validateUname() 
{
	console.log("beginning username validation");
	var uname = document.getElementById("username").value;
	var valid = false;
	try
	{
		if(!/^\w{5,10}/.test(uname)){
			console.log("Entering not valid");
			valid = false;
			throw "Username not between 5 and 10 characters.";
		}
		if(valid == true) {
			console.log("Entering valid");
			AjaxFunction("username");
		}
		else{
			console.log("Something went Wrong, validation failed");
		}
	}//end try
	catch(e){
		console.log(e + "Username is " + uname);
		var help = document.getElementById("unameHelp");
		help.classList.add("errRed");
		help.classList.remove("validGreen");
		help.classList.remove("text-muted");
		help.innerHTML = e;
		inValid = true;
	}//end catch
	finally{
		createEventListeners();
	}
}//end validateUname

/* Validate initial password */

function validatePass1(){
	console.log("beginning password1 validation");
	var pass = document.getElementById("password1").value;
	var help = document.getElementById("pwHelp");
	try
	{
		if(/^\S{8,15}/.test(pass)){
			console.log("Entering valid length");
			if (/[A-Z]+/.test(pass)){
				console.log("Entering valid Cap");
				if (/[0-9]+/.test(pass)){
					console.log("Entering valid Num: password passes validation");
					help.innerHTML = "Password is valid!";
					help.classList.add("validGreen");
					help.classList.remove("errRed");
					help.classList.remove("text-muted");
				}
				else {
					console.log("Entering invalid Num");
					throw "Password must contain at least 1 number.";
				}
			}
			else {
				console.log("Entering invalid Cap");
				throw "Password must contain at least 1 capital letter.";
			}
		}
		else {
			console.log("Entering invalid length");
			throw "Password not between 8 and 15 characters.";
		}
	}//end try
	catch(e){
		console.log(e + "Password is " + pass);
		help.classList.add("errRed");
		help.classList.remove("validGreen");
		help.classList.remove("text-muted");
		help.innerHTML = e;
	}//end catch
	finally{
		createEventListeners();
	}
}//end validatePass1

/* Validate passwords match */

function validatePass2(){
	console.log("beginning password2 validation");
	var pass = document.getElementById("password2").value;
	var validPass = document.getElementById("password1").value;
	var help = document.getElementById("pwErr");
	try
	{
		if(pass === validPass){
			console.log("Entering valid password passes validation");
			help.innerHTML = "Passwords are a match!";
			help.classList.add("validGreen");
			help.classList.remove("errRed");
			help.classList.remove("text-muted");
		}
		else {
			console.log("Entering invalid match");
			throw "Passwords do not match!";
		}
	}//end try
	catch(e){
		console.log(e + "Password is " + pass);
		help.classList.add("errRed");
		help.classList.remove("validGreen");
		help.classList.remove("text-muted");
		help.innerHTML = e;
	}//end catch
	finally{
		createEventListeners();
	}
}//end validatePass2

/* Get additional guests and add them to the div */

function addRSVP(){
	var select = document.getElementById("guest");
	var optValue = select.options[select.selectedIndex].value;
	console.log("optValue = " + optValue)
	var nameArr = optValue.split(',',2);
	var name = nameArr[0];
	var minor = nameArr[1];
	var container = document.getElementById("guestList");
	if((optValue !== "") && (!valArr.includes(optValue))){
		if(minor==1){
			container.innerHTML += "<p class=\"list-group-item row\"><i class=\"far fa-times-circle fa-lg\"></i> "+name+" </p>\n";
			valArr.push(optValue);
		}
		else {
			container.innerHTML += "<p class=\"list-group-item row\"><i class=\"far fa-times-circle fa-lg\"></i> "+name+" <label class=\"mx-4\">Alcohol?<input type=\"checkbox\" name=\"drink[]\" value=\""+name+"\" class=\"mx-2\" /></label></p>\n";
			valArr.push(optValue);
		}
	}
	createEventListeners();
}

/* Remove guests from div list */

function removeRSVP(e){
	var elem = e.target;
	var item = elem.parentNode;
	var parent = document.getElementById("guestList");
	console.log("innerHTML of item = " + item.innerHTML);
	parent.removeChild(item);
	createEventListeners();
}

/* Clear help text */

function clearHelp(){
	var unamehelp = document.getElementById("unameHelp");
	var pass1help = document.getElementById("pwHelp");
	var pass2help = document.getElementById("pwErr");
	unamehelp.innerHTML = "Username must be 5-10 characters long.";
	unamehelp.classList.add("text-muted");
	unamehelp.classList.remove("validGreen");
	unamehelp.classList.remove("errRed");
	pass1help.innerHTML = "Password must be 8-15 characters long and contain at least 1 capital letter and 1 number";
	pass1help.classList.add("text-muted");
	pass1help.classList.remove("validGreen");
	pass1help.classList.remove("errRed");
	pass2help.innerHTML = "Re-type password";
	pass2help.classList.add("text-muted");
	pass2help.classList.remove("validGreen");
	pass2help.classList.remove("errRed");
	createEventListeners();
}

/* Ajax function to validate username against the database */

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
				if (resultText.includes("Yes"))
				{
					ajaxDisplay.classList.add("validGreen");
					ajaxDisplay.classList.remove("errRed");
					ajaxDisplay.classList.remove("text-muted");
				}
				else if (resultText.includes("Sorry"))
				{
					ajaxDisplay.classList.add("errRed");
					ajaxDisplay.classList.remove("validGreen");
					ajaxDisplay.classList.remove("text-muted");
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

/* Create event listeners on load and to re-instate after functions */

function createEventListeners(){
	var username = document.getElementById("username");
	if(username.addEventListener){
		username.addEventListener("input", validateUname, false);
	}
	else if (username.attchEvent) {
		username.attachEvent("onblur", validateUname);
	}
	var pass1 = document.getElementById("password1");
	if(pass1.addEventListener){
		pass1.addEventListener("input", validatePass1, false);
	}
	else if (pass1.attachEvent){
		pass1.attachEvent("onblur", validatePass1);
	}
	var pass2 = document.getElementById("password2");
	if(pass2.addEventListener){
		pass2.addEventListener("input", validatePass2, false);
	}
	else if (pass2.attachEvent){
		pass2.attachEvent("onblur", validatePass2);
	}
	var cancel = document.getElementsByClassName("fa-times-circle");
	for (var i = 0; i < cancel.length; i++) {
		cancel[i].addEventListener("click", removeRSVP, false);
	}
	var select = document.getElementById("guest");
	if(select.addEventListener){
		select.addEventListener("change",addRSVP,false);
	}
	else if(select.attchEvent){
		select.attachEvent("onchange",addRSVP);
	}
	var reset = document.getElementById("reset");
	if(reset.addEventListener){
		reset.addEventListener("click",clearHelp,false);
	}
	else if(reset.attachEvent){
		reset.attachEvent("onclick",clearHelp);
	}
}