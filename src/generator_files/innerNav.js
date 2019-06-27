function ge(ElementName) { return document.getElementById(ElementName); }
function FindPassover(){
    
}

function StartCalendar() {
    //alert(ValueYear + ValueEra);
    var newloc =  ValueEra + ValueYear + ".html";
    alert(newloc);
    window.location.href = newloc;
}
        var loc = window.location.href;
		var ButtonBC = ge("EraBC");
		var ButtonAD = ge("EraAD");
        var startLoc = 0;
		var ValueEra = "AD";

        if(loc.indexOf("/BC")>-1){
            ValueEra = "BC";
        }

		var ValueYearString = loc.substring(loc.indexOf("/" + ValueEra)+3, loc.indexOf(".html"));
        //alert(ValueYearString);
        ValueYear = parseInt(ValueYearString);       


		
        function SetAD() {
			ValueEra = "AD";
			//$(ButtonAD).removeClass("adOff").addClass("adOn");
			//$(ButtonBC).removeClass("bcOn").addClass("bcOff");
		}

		function SetBC() {
			ValueEra = "BC";
			//$(ButtonAD).removeClass("adOn").addClass("adOff");
			//$(ButtonBC).removeClass("bcOff").addClass("bcOn");
        }
        

        function IncrementYear() {
            
            if (ValueYear == null || ValueYear == "") {
                ValueYear = 0;
                SetAD();
            }
            if (ValueEra == "AD") {
                ValueYear++;
            }
            else {
                ValueYear--;
            }
            if (ValueYear <= 0) {
                ValueYear = 1;
                SetAD();
            }
            StartCalendar()
        }
        function DecrementYear() {
            if (ValueYear == null || ValueYear == "") {
                ValueYear= 0;
                SetBC();
            }
            if (ValueEra == "AD") {
                ValueYear--;
            }
            else {
                ValueYear++;
            }
            if (ValueYear <= 0) {
                ValueYear = 1;
                SetBC();
            }


            StartCalendar()
        }