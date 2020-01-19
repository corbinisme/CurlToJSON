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

function ge(ElementName) { return document.getElementById(ElementName); }
function FindFirstOfNisan() {
    //console.log("Nisan");
           var a = document.getElementById("Nisan1");
           var b = document.getElementById("Nisan2");
           var c = document.getElementById("Nisan3");
           var d = document.getElementById("Nisan4");
           var e = document.getElementById("Nisan5");
           var f = document.getElementById("Nisan6");
           var g = document.getElementById("Nisan7");
           var LowValue = 16;
           var using = null;
           if(document.getElementById("AMYear")){
           var year = document.getElementById("AMYear").value;
            } else {
                var year = ValueYear;
            }
           if (a != null) {
               var y = parseFloat(a.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = a; }
           }
           if (b != null) {
               var y = parseFloat(b.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = b; }
           }
           if (c != null) {
               var y = parseFloat(c.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = c; }
           }
           if (d != null) {
               var y = parseFloat(d.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = d; }
           }
           if (e != null) {
               var y = parseFloat(e.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = e; }
           }
           if (f != null) {
               var y = parseFloat(f.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = f; }
           }
           if (g != null) {
               var y = parseFloat(g.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = g; }
           }
           if (using != null) {

               var u = using.parentNode;
               var child = u.firstChild;
               var value = u.Value;

               child = child.nextSibling;
               child = child.nextSibling;
               while (child) {
                   child.style.backgroundColor = '#FFFABA';
                   child.style.color = 'black';
                   child = child.nextSibling;
               }
           }
       }

       function FindPassover() {
           var a = document.getElementById("Sivan5");
           var b = document.getElementById("Sivan7");
           var c = document.getElementById("Sivan9");
           var d = document.getElementById("Sivan11");
           var g = document.getElementById("Nisan7");
           var LowValue = 16;
           var using = null;
           if(document.getElementById("AMYear")){
           var year = document.getElementById("AMYear").value;
           } else {
            var year = ValueYear
           }
           if (a != null) {
               var y = parseFloat(a.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = a; }
           }
           if (b != null) {
               var y = parseFloat(b.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = b; }
           }

           if (c != null) {
               var y = parseFloat(c.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = c; }
           }
           if (d != null) {
               var y = parseFloat(d.getAttribute("count"))
               if (LowValue > y) { LowValue = y; using = d; }
           }
           if (g != null) {
               var w = document.getElementById("Sivan4");
               var y = parseFloat(w.getAttribute("count") - 1)
               if (LowValue > y) { LowValue = y; using = w; }
           }
           if (using != null) {
               var u = using.parentNode;
               var child = u.firstChild;
               child = child.nextSibling;
               var GregorianDate = strip(child.innerHTML);
               //              if (g != null) {
               //                  GregorianDate -= 7;
               //              }
               var GregorianMonth = child.getAttribute("month");
               var output = GregorianMonth + ' ' + (parseFloat(GregorianDate) + 1);
               //document.getElementById("PentcostDate").innerHTML = output;
               while (child) {
                   child.style.backgroundColor = '#FFFABA';
                   child.style.color = 'black';
                   child = child.nextSibling;
               }
               FindFirstOfNisan();
           }
       }
       function strip(html) {
           var tmp = document.createElement("DIV");
           tmp.innerHTML = html;
           return tmp.textContent || tmp.innerText || "";
         }


function StartCalendar() {
    //alert(ValueYear + ValueEra);
    var newloc =  ValueEra + ValueYear + ".html";
    //alert(newloc);
    window.location.href = newloc;
}
     

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


window.onload = function(){
    var t = window.setInterval(function(){
        if(document.getElementById("AMYear")){
            FindPassover();
            clearInterval(t);
        } else {

        }
    }, 300);
    

};

FindPassover();