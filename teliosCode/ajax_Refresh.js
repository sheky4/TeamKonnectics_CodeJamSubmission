var xmlhttp;

function checkStatus(customerID)
{
	
	//alert(customerID);

	xmlhttp=getXmlHttpObject();
    if (xmlhttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
	
	
    var url="check_DB.php?customerID="+customerID;
	
    xmlhttp.onreadystatechange=handleAjaxResponse3;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
	

}



//ajax response and object handlers

function handleAjaxResponse3()
{
	if (xmlhttp.readyState==4)
    {
        document.getElementById("refreshContent").innerHTML = '';
		
		document.getElementById("refreshContent").innerHTML = xmlhttp.responseText;
		
		var tester = xmlhttp.responseText;
		var subTester = tester.substring(0, 21);
		//alert(subTester);
		if(subTester == "List has been updated")
		{
			document.getElementById('trigger1').play();
			alert("Your order status has been updated!");
			
		}
		
    }
}


function getXmlHttpObject()
{
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject)
    {
        // code for IE6, IE5
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}