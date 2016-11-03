//Declare JavaScript Function
function val(frm){

	//Initialize error message variable
	var errorMsg = "";
	var username = frm.username.value;
	var password = frm.password.value;
	var confirmpassword = frm.confirmpassword.value;
	var email = frm.email.value;
	var supermarket = frm.supermarket.value;
	var captcha = frm.captcha.value;
	var apostrophe = "'";
	var hasNumber = /\d/;
	var number = hasNumber.test(frm.password.value); // false

	/*----------Test Form Elements----------*/
	///////////Username Validation//////////////////////
	if(frm.username.value == "" || frm.username.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error1').innerHTML="Enter a username";
	}
	else if( (frm.username.value).length < 5){
		//Append password length message to variable
		errorMsg++;
		document.getElementById('error1').innerHTML="Username cannot be less than 5 characters. E.g. alex4";
	}else
	{
		document.getElementById('error1').innerHTML="";
	}
	
	///////////Password Validation//////////////////////
	if(frm.password.value == "" || frm.password.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error2').innerHTML="Enter a password";
	}else if ( password.indexOf(apostrophe) > -1 ) {
		  errorMsg++;
		document.getElementById('error2').innerHTML="Password cannot contain apostrophe '";
	}else if(number < 1 && /^[a-zA-Z0-9- ]*$/.test(frm.password.value) == true){
		errorMsg++;
		document.getElementById('error2').innerHTML="Password must contain at least 1 number and 1 symbol E.g. hello_1.";
	}
	//https://www.reddit.com/r/javascript/comments/2hhq1n/how_can_i_check_if_a_string_contains_a_number/
	else if (number < 1){
		errorMsg++;
		document.getElementById('error2').innerHTML="Password must contain at least 1 number. E.g. hello_1";
	}
	
	//http://stackoverflow.com/questions/13840143/jquery-check-if-special-characters-exists-in-string
	 else if(/^[a-zA-Z0-9- ]*$/.test(frm.password.value) == true) {
		errorMsg++;
		document.getElementById('error2').innerHTML="Username must contain at least 1 symbol. E.g. hello_1";
	}
	else
	{
		document.getElementById('error2').innerHTML="";
	}
	
	////////Email///////////
	
	if(frm.email.value == "" || frm.email.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error3').innerHTML="Enter an email address";
	}
	else if(!validEmailString(frm.email.value)){
		//Append invalid email message to variable 
		errorMsg++;
		document.getElementById('error3').innerHTML="Please enter a valid email address. E.g. janedoe@hotmail.com";
	}
	else
	{
		document.getElementById('error3').innerHTML="";
	}
	
	///////////Captcha Validation//////////////////////
	if(frm.captcha.value == "" || frm.captcha.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error4').innerHTML="Enter the captcha value.";
	}
	else
	{
		document.getElementById('error4').innerHTML="";
	}
	
	
		///////////Username Validation//////////////////////
	if(frm.confirmpassword.value == "" || frm.confirmpassword.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error5').innerHTML="Enter confirm password.";
	}
	else if(frm.password.value != frm.confirmpassword.value ) {
		errorMsg++;
		document.getElementById('error5').innerHTML="Password and Confirm password do not match.";
	}
	else
	{
		document.getElementById('error5').innerHTML="";
	}
	
	if(supermarket == ""|| supermarket == null || supermarket =="default")
	{
		errorCount++;
		document.getElementById('error6').innerHTML="Please enter a supermarket";
	}
	else
	{
		document.getElementById('error6').innerHTML="";
	}
	

	
	
	
	if(errorMsg != ""){
		
		return false;
	}else return true;
	

}//END OF FUNCTION validate

/* Function to check email format */
function validEmailString(emailString){
	// regular expression works for most email strings
   var filter  =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   if (filter.test(emailString)) 
	return true;
	else return false;
}// end of validEmailString function




