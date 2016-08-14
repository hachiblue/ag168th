<?php
session_start();
// if(!(@$_SESSION['login']['level_id'] <= 2 && @$_SESSION['login']['level_id'] > 0)) {
//   return "";
// }
?>

<style>

  .q_header {
    color:#1F497D;
    font-size: 24px;
    font-weight: bold;
  }

</style>

<div class="container" ng-controller="QuotCTL">

  <div class="col-xs-12 q_report">

    <div class="text-center q_header">QUOTATION</div>

  </div>

</div>