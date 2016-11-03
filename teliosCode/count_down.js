var sec = 15;   // set the seconds
var min = 0;   // set the minutes
// obtained from http://www.javascriptsource.com/time-date/countdown-timer-2.html
function countDown() {
  sec--;
  if (sec == -01) {
    sec = 59;
    min = min - 1;
  } else {
   min = min;
  }
if (sec<=9) { sec = "0" + sec; }
  time = (min<=9 ? "0" + min : min) + " : " + sec;
if (document.getElementById) { timeLeft.innerHTML = time; }
  SD=window.setTimeout("countDown();", 1000);
	if (min == '00' && sec == '00') 
	{ sec = "00"; window.clearTimeout(SD); 
		
		
		//window.alert("YOW!");
		
		//call the ajax function to check stuff
		checkStatus(customerID);
		//var appended = Math.floor((Math.random() * 100) + 1);
		//document.getElementById('refreshContent').innerHTML="Content changed again"+appended;
		min = 0;
		sec = 15;
		countDown();
	}
}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function() {

//call the ajax function to refresh stuff
 checkStatus(customerID);
  //document.getElementById('refresherContent').innerHTML="Initial Content";
  countDown();
});