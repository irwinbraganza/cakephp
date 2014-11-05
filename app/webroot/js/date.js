// var mydate=new Date()
// var year=mydate.getYear()
// if (year < 1000)
// year+=1900
// var day=mydate.getDay()
// var month=mydate.getMonth()
// var daym=mydate.getDate()
// if (daym<10)
// daym="0"+daym
// var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
// var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
// document.write("<small><font color='000000' face='Arial'><b>"+dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>")

$(function(){
	setInterval(function() {
		var currentTime = new Date();
		var timeInHours = currentTime.getHours();
		var timeInMinutes = currentTime.getMinutes();
		var timeInSeconds = currentTime.getSeconds();
		if(timeInMinutes.toString().length == 1){
			timeInMinutes = '0' + timeInMinutes;
		}
		if(timeInHours > 12) {
			timeInHours = timeInHours - 12;
			var timeString = timeInHours + ':' + timeInMinutes + ' pm';
		}
		else if(timeInHours == 12) {
			var timeString = timeInHours + ':' + timeInMinutes + ' pm';
		} 
		else {
			var timeString = timeInHours + ':' + timeInMinutes + ' am';
		}
		$('.timer').text(timeString);
}, 1000);
})