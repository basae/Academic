<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language='javascript' src="popcalendar.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Polizas</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>


</head>
<body>
        <div id="loco">
         <form name="form1" method="post">
           Calendario<input name="nombre_de_la_caja" type="text" id="dateArrival" onClick="popUpCalendar(this, form1.dateArrival, 'mm-dd-yyyy');" size="10">
        </form>
          </div>
          <div id="kja">
          </div>
          <iframe src="calendario.php" width="100%" height="500px;">
          </iframe>
      
</html>