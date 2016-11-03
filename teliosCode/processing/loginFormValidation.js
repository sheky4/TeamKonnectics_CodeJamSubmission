function loginValidation(frm){
	
	//Initialize error message variable
	var errorMsg = "";
	
	var username = frm.username.value;
	var password = frm.password.value;
	
	
	if(frm.username.value == "" || frm.username.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error1').innerHTML="Enter a username";
	}
	else
	{
		document.getElementById('error1').innerHTML="";
	}
	
	
	
		///////////Password Validation//////////////////////
	if(frm.password.value == "" || frm.password.value==null){
		//Append title error message to variable
		errorMsg++;
		document.getElementById('error2').innerHTML="Enter a password";
	}
	else
	{
		document.getElementById('error2').innerHTML="";
	}
	
	if(errorMsg != ""){
		
		return false;
	}else return true;
	
}