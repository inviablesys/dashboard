<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Tempetaturaaaaaaaaah</title>
<script type='text/javascript'>
function loadDoc(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myFunction(this);
    }
  };
  xhttp.open('GET','humedad.xml',true);
  xhttp.send();
  setTimeout('loadDoc()',500);
}
function myFunction(xml){
  var i;
  var xmlDoc = xml.responseXML;
  var dato ='';
  dato = xmlDoc.getElementsByTagName('HUMEDAD')[0].childNodes[0].nodeValue;
  document.getElementById('humedad').innerHTML = dato;
  var dato2 ='';
  dato = xmlDoc.getElementsByTagName('TEMPERATURA')[0].childNodes[0].nodeValue;
  document.getElementById('temperatura').innerHTML = dato;
}
</script>
</head>
<body onload='loadDoc()'>
<a>HUMEDAD: </a>
<a id='humedad'></a>
<a>&degC</a>
<a>TEMPERATURA: </a>
<a id='temperatura'></a>
<a>&degC</a>
</body>
</html>