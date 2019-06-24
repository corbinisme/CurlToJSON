function ge(ElementName) { return document.getElementById(ElementName); }

		var ButtonBC = ge("EraBC");
		var ButtonAD = ge("EraAD");
		var ValueEra = ge("Era");
		var ValueYear = ge("Year");

		function SetAD() {
			ValueEra.value = "AD";
			$(ButtonAD).removeClass("adOff").addClass("adOn");
			$(ButtonBC).removeClass("bcOn").addClass("bcOff");
		}

		function SetBC() {
			ValueEra.value = "BC";
			$(ButtonAD).removeClass("adOn").addClass("adOff");
			$(ButtonBC).removeClass("bcOff").addClass("bcOn");
        }

        function IncrementYear() {
            if (ValueYear.value == null || ValueYear.value == "") {
                ValueYear.value = 0;
                SetAD();
            }
            if (ValueEra.value == "AD") {
                ValueYear.value++;
            }
            else {
                ValueYear.value--;
            }
            if (ValueYear.value <= 0) {
                ValueYear.value = 1;
                SetAD();
            }
            StartCalendar()
        }
        function DecrementYear() {
            if (ValueYear.value == null || ValueYear.value == "") {
                ValueYear.value = 0;
                SetBC();
            }
            if (ValueEra.value == "AD") {
                ValueYear.value--;
            }
            else {
                ValueYear.value++;
            }
            if (ValueYear.value <= 0) {
                ValueYear.value = 1;
                SetBC();
            }
            StartCalendar()
        }