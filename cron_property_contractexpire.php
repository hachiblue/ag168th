<?php
require("bootstrap.php");

use Main\DB\Medoo\MedooFactory;

$dt = new DateTime();
$dt->sub(new DateInterval('P1M'));

$db = MedooFactory::getInstance();

$sth = $db->pdo->prepare("SELECT * FROM property WHERE DATE(contract_expire) = :dt");
$sth->execute([
  "dt"=> $dt->format("Y-m-d")
  ]);

$items = $sth->fetchAll(\PDO::FETCH_ASSOC);
$admins = $db->select("account", "*", ["level_id"=> 2]);

foreach($items as $item) {
  $mailContent = <<<MAILCONTENT
  Notify: Contract expire in 1 month<br />
  ==============================<br />
  Property No: {$item["reference_id"]}<br />
MAILCONTENT;
  foreach($admins as $admin) {

    $mailHeader = "From: system@agent168th.com\r\n";
    $mailHeader = "To: admin@agent168th.com\r\n";
    $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
    @mail("admin@agent168th.com", "Property contract expire in 1 month", $mailContent, $mailHeader);
  }
}
