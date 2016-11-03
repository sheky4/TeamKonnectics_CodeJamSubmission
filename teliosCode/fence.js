  var xmlhttp;

function checkID(groceryID)
{
	
	alert(groceryID);

	xmlhttp=getXmlHttpObject();
    if (xmlhttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
	
	
    //var url="check_Database.php?groceryID="+groceryID;
	
    xmlhttp.onreadystatechange=handleAjaxResponse3;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
	

}
  
   
   window.onload = function() {
        var startPos;
        var startPosLat;
        var startPosLong;
        var distance;
		
		var instanceCounter = false;
		
      
        if (navigator.geolocation) {

		
          startPosLat = 10.273372;
          startPosLong =   -61.438400;

          $("#startLat").text(startPosLat);
          $("#startLon").text(startPosLong);
      
          navigator.geolocation.watchPosition(function(position) {
            $("#currentLat").text(position.coords.latitude);
            $("#currentLon").text(position.coords.longitude);

            distance = calculateDistance(startPosLat, startPosLong,position.coords.latitude, position.coords.longitude)
            $("#distance").text(distance);

            if(distance < .05){
              $("#message").text("Yes, were inside .05 KM!!! :) A+")
				if(instanceCounter == false)
			  {
				document.getElementById('trigger1').play();
				instanceCounter = true;
				alert("Don't forget to Pickup your grocery items!!");
				
			  }
			
            }else if(distance > .05){
              $("#message").text("No, not inside .05 KM :(")
			
            }
          });
        }
		
		
			 
		
		
      };
      
	  //function alertPosition()
	  //{
	 
	 
	  //}
	  
	  
      // Reused code - copyright Moveable Type Scripts - retrieved May 4, 2010.
      // http://www.movable-type.co.uk/scripts/latlong.html
      // Under Creative Commons License http://creativecommons.org/licenses/by/3.0/
      function calculateDistance(lat1, lon1, lat2, lon2) {
        var R = 6371; // km
        var dLat = (lat2-lat1).toRad();
        var dLon = (lon2-lon1).toRad();
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return d;
      }
      Number.prototype.toRad = function() {
        return this * Math.PI / 180;
      }