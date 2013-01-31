<?php
$con = mysql_connect("http://isctejuniorconsulting.pt:2082","ijcpt_leilao","leilao2013");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ijcpt_leilao", $con);

$result = mysql_query("SELECT * FROM Licitacoes
WHERE quadro_id='1'");

while($row = mysql_fetch_array($result))
  {
  echo $row['nome'] . " " . $row['preco'];
  echo "<br>";
  }
?>