<script language="php">
$host  = "mysql.cluelessresearch.com";
$con = mysql_connect($host,"monte","e123456");
$database = 'congressoaberto';
mysql_select_db($database, $con);

$table = 'br_partyindices';
##$bioid = 96734;
##$bioid = $_GET["bioid"];

// sending query
$result = mysql_query("SELECT partyname FROM br_partyindices where partyid={$partyid} limit 1");
if (!$result) {
  die("Query to show fields from table failed");
 }

$row = mysql_fetch_row($result);
$nameparty = $row[0];

// $statelegis = $row[2]; FIX: make it not depend on row order (Call by name)
echo '<table border="0">';
echo '<tr>';
print("<td><img src=\"/images/partylogos/".$bioid.".png\" alt=\"$partyid\" width=100/></td>");
print("<td> 
<p>$nameparty<br>
Legislaturas: </p>
 </td></tr></table>");

</script>



<script language="javascript" type="text/javascript">
  var bioid = "<?php echo $bioid; ?>";
</script>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript">
  google.load('visualization', '1', {packages: ['table']});
</script>
<script type="text/javascript">
  var visualization;
var data;
var options = {'showRowNumber': true};
function drawVisualization() {
  var query = new google.visualization.Query('/php/query.php?form=votes&limit=100&bioid='+bioid);    
  // Send the query with a callback function.
    query.send(handleQueryResponse);
}
function handleQueryResponse(response) {
  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }
  var data = response.getDataTable();
  var formatter = new google.visualization.DateFormat({formatType: 'long'});
  // Reformat our data.
  formatter.format(data, 1);
  options['page'] = 'enable';
  options['pageSize'] = 10;
  //options['pagingSymbols'] = {prev: 'P', next: 'N'};
  options['pagingButtonsConfiguration'] = 'auto';
  visualization = new google.visualization.Table(document.getElementById('table2'));
  visualization.draw(data, options);
}

google.setOnLoadCallback(drawVisualization);

var visualization2;
var data2;
var options2 = {'showRowNumber': true};
function drawVisualization2() {
  var query = new google.visualization.Query('/php/query.php?form=contrib&limit=100&bioid='+bioid);    
  // Send the query with a callback function.
  query.send(handleQueryResponse2);
}
function handleQueryResponse2(response) {
  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }
  var data2 = response.getDataTable();
  options2['page'] = 'enable';
  options2['pageSize'] = 10;
  //options['pagingSymbols'] = {prev: 'P', next: 'N'};
  options2['pagingButtonsConfiguration'] = 'auto';
  visualization2 = new google.visualization.Table(document.getElementById('table3'));
  visualization2.draw(data2, options2);
}

google.setOnLoadCallback(drawVisualization2);

</script>
<h3> Últimas Votações </h3>
<div id="table2">
  </div>
  <script language="php">
  print("<a href=\"/php/query.php?form=votes&bioid=$bioid&limit=all&tqx=reqId:0;out:csv;csvFile:votacoes$bioid\"> Download de todas as votações do legislador em csv</a>");
</script>


<h3> Doações de Campanha </h3>
<div id="table3">
</div>
<script language="php">
print("<a href=\"/php/query.php?form=contrib&bioid=$bioid&limit=all&tqx=reqId:0;out:csv;csvFile:doacoes$bioid\"> Download de todas as doações para o legislador em csv</a>");
</script>


<h3> Mapa eleitoral - 2006 </h3>
<script language="php"> 
print("<img src=\"/images/elections/2006/deputadofederal$state$candno.png\"  alt=\"Electoral Map\"");
</script>


<hr>
<address></address>
