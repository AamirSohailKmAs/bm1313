if (document.getElementsByTagName("main")[0]) {
 var header = document.getElementsByTagName("header")[0].clientHeight;
 header += 20;
 document.getElementsByTagName("main")[0].style.marginTop = header + "px";
 document.getElementsByTagName("main")[0].style.height = "calc(100vh - " + header + "px)";
}
setTimeout(() => {
 let alerts = document.getElementsByClassName("alert");
 if (alerts.length) {
  alerts[0].remove();
 }
}, 5000);

const daten = document.querySelector("#daten");
if (daten) {
 let date = new Date();
 let year = date.getFullYear();
 let day = ("0" + date.getDate()).slice(-2);
 let month = ("0" + (date.getMonth() + 1)).slice(-2);

 daten.textContent = `${year}-` + `${month}-` + `${day}`;

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
}
