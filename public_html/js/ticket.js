const daten = document.querySelector("#daten");
let date = new Date();
let year = date.getFullYear();
let day = ("0" + date.getDate()).slice(-2);
let month = ("0" + (date.getMonth() + 1)).slice(-2);

daten.textContent = `${year}-` + `${month}-` + `${day}`;

const clock = document.querySelector("#clock");

function startTime() {
 let today = new Date();
 let h = today.getHours();
 let m = today.getMinutes();
 let s = today.getSeconds();
 let am_pm = "AM";
 m = checkTime(m);
 s = checkTime(s);
 if (h > 12) {
  am_pm = "PM";
  h %= 12;
 }
 document.getElementById("clock").innerHTML = h + ":" + m + ":" + s + " " + am_pm;
 let t = setTimeout(startTime, 500);
}
function checkTime(i) {
 if (i < 10) {
  i = "0" + i;
 } // add zero in front of numbers < 10
 return i;
}

startTime();

setTimeout(() => {
 let alerts = document.getElementsByClassName("alert");
 if (alerts.length) {
  alerts[0].remove();
 }
}, 3000);
$(document).ready(function () {
 $(".calc").on("keyup", function () {
  var total = $("#total").val();
  var received = $("#received").val();
  var balance = total - received;
  $("#balance").val(balance);
 });
});
$("#search").on("click", function (e) {
 const d1 = $("#fromDate").val();
 const d2 = $("#toDate").val();
 const contact = $("#contact").val();
 if (contact) {
  $("#kmashistory").submit();
 }
 if (d1 != "" && d2 != "") {
  const fromDate = new Date(d1.trim());
  const toDate = new Date(d2.trim());
  if (fromDate <= toDate) {
   $("#kmashistory").submit();
  } else if (fromDate > toDate) {
   alert("Please Check Your Date");
   e.preventDefault();
  }
 }
});
