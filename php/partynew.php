﻿<script language="php">
$host  = "mysql.cluelessresearch.com";
$con = mysql_connect($host,"monte","e123456");
$database = 'congressoaberto';
mysql_select_db($database, $con);

$table = 'br_partyindices';

// sending query
$result = mysql_query("SELECT partyname FROM br_partyindices where partyid={$partyid} limit 1");
if (!$result) {
  die("Query to show fields from table failed");
 }
$row = mysql_fetch_row($result);
$partyacronym = $row[0];

#Get some summary statistics
$result = mysql_query("select t1.*, Convert(Convert((t2.name) using binary) using latin1), t2.number from br_partyindices as t1, br_parties_current as t2 where t1.partyid={$partyid} AND t2.number={$partyid}");
$row = mysql_fetch_row($result);
$sizeparty = $row[0];
$cohesion = $row[2];
$shareabsent = $row[3];
$sharegovall = $row[4];
$sharegovdiv = $row[5];
$nameparty = $row[8];

##Get Ranks
$result = mysql_query("select t1.*, t2.name, t2.number from br_partyindices_rank as t1, br_parties_current as t2 where t1.partyid={$partyid} AND t2.number={$partyid}");
$row = mysql_fetch_row($result);
$ranksizeparty = $row[0];
$rankcohesion = $row[2];
$rankshareabsent = $row[3];
$ranksharegovall = $row[4];
$ranksharegovdiv = $row[5];

##Get number of ranked parties
$result = mysql_query("select count(*) as row_ct from br_partyindices");
$row = mysql_fetch_row($result);
$nparties = $row[0];
</script>



<script language="php"> 
print("<img src=\"/images/partylogos/".$partyacronym.".jpg\"  width=100/>");
print("<h3>$nameparty </h3>");
print("Tamanho da Bancada: $sizeparty/513 ($ranksizeparty dentre os $nparties maiores partidos)<br>
            Taxa de Absenteismo  $shareabsent% ($rankshareabsent dentre os $nparties maiores partidos)<br>
            Taxa de Governismo: $sharegovdiv% em votações contenciosas ($ranksharegovdiv dentre os $nparties maiores partidos) <br>
            Índice de Coesão:  $cohesion ($rankcohesion dentro os $nparties maiores partidos)");
</script>