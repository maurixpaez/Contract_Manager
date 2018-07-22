

var mydate=new Date(); 
var dayarray = new Array("Domingo,","Lunes,","Martes,","Miercoles,","Jueves,","Viernes,","Sabado,"); 
var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto", 
"Septiembre","Octubre","Noviembre","Diciembre"); 
var year = mydate.getYear() 
if (year < 1000) 
year= year+1900 
var TODAY = dayarray[mydate.getDay()] + " " + mydate.getDate() + " de " + montharray[mydate.getMonth()] + " de " + year; 

