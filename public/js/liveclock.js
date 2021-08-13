///////////////////////////////////////////////////////////
// "Live Clock Advanced" script - Version 1.0
// By Mark Plachetta (astroboy@zip.com.au)
/////////////// CONFIGURATION /////////////////////////////

	var mypre_text = "";
	var my12_hour = 0;
	var myupdate = 1;
	var DisplayDate = 1;

    var ie4=document.all
    var ns4 = document.layers
    var ns6 = document.getElementById && !document.all

    var dn = "";
	var mn = "th";
	var old = "";

	var DaysOfWeek = new Array(7);
		DaysOfWeek[0] = "Chủ nhật";
		DaysOfWeek[1] = "Thứ hai";
		DaysOfWeek[2] = "Thứ ba";
		DaysOfWeek[3] = "Thứ tư";
		DaysOfWeek[4] = "Thứ năm";
		DaysOfWeek[5] = "Thứ sáu";
		DaysOfWeek[6] = "Thứ bảy";

	var MonthsOfYear = new Array(12);
		MonthsOfYear[0] = "1";
		MonthsOfYear[1] = "2";
		MonthsOfYear[2] = "3";
		MonthsOfYear[3] = "4";
		MonthsOfYear[4] = "5";
		MonthsOfYear[5] = "6";
		MonthsOfYear[6] = "7";
		MonthsOfYear[7] = "8";
		MonthsOfYear[8] = "9";
		MonthsOfYear[9] = "10";
		MonthsOfYear[10] = "11";
		MonthsOfYear[11] = "12";

    var ClockUpdate = new Array(3);
		ClockUpdate[0] = 0;
		ClockUpdate[1] = 1000;
		ClockUpdate[2] = 60000;

	function show_clock()
	{
		if (old == "die") { return; }
		if (ns4) document.ClockPosNS.visibility="show"
		var Digital = new Date();
		var day = Digital.getDay();
		var mday = Digital.getDate();
		var month = Digital.getMonth();
		var hours = Digital.getHours();
		var yesrs = Digital.getFullYear()
		var minutes = Digital.getMinutes();
		var seconds = Digital.getSeconds();

		if (my12_hour)
		{
			dn = "AM";
			if (hours > 12) { dn = "PM"; hours = hours - 12; }
			if (hours == 0) { hours = 12; }
		}
		else { dn = ""; }

		if (hours <= 9) { hours = "0" + hours; }
		if (minutes <= 9) { minutes = "0" + minutes; }
		if (seconds <= 9) { seconds = "0" + seconds; }
		if (mday <= 9) { mday = '0' + mday; }

		myclock = '';
		myclock += mypre_text;
		if (DisplayDate) {
		    myclock += DaysOfWeek[day] + ', ' + mday + '/';
		    if (MonthsOfYear[month] < 10) myclock += '0';
		    myclock += MonthsOfYear[month] + '/' + yesrs + ', ';
		}
		myclock += hours + ':' + minutes;
		if ((myupdate < 2) || (myupdate == 0)) { myclock += ':' + seconds; }
		myclock += ' ' + dn;

		if (old == "true") {
			document.write(myclock);
			old = "die";
			return;
		}

		if (ns4) {
			clockpos = document.ClockPosNS;
			liveclock = clockpos.document.LiveClockNS;
			liveclock.document.write(myclock);
			liveclock.document.close();
		} else if (ie4) {
			LiveClockIE.innerHTML = myclock;
		} else if (ns6){
		    document.getElementById("showclock").innerHTML = myclock;
                }

		if (myupdate != 0) { setTimeout("show_clock()",ClockUpdate[myupdate]); }
	}