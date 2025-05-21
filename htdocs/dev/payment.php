<?php
include_once("src/database/Database.class.php");
include_once("src/helpers/error.helper.php");

try {
   $dbconn = new Database();
   $ErrorHelper = new ErrorHelper();
   // set the PDO error mode to exception
   $sql = "SELECT * FROM products";
   $recset = $dbconn->runSql($sql);

} catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
}



include_once("template/head.inc.php");
?>

<main class="uk-container">
   <section class="uk-width-1-3  uk-margin-auto uk-margin-xlarge-top uk-margin-xlarge-bottom">
         <?php if (!$ErrorHelper->hasError()): ?>
      <div id="error-card" class="uk-alert-<?= $ErrorHelper->getErrorColor() ?>" uk-alert>
         <p><?= $ErrorHelper->getErrorMsg() ?></p>
         <button class="uk-alert-close" type="button" uk-close></button>
      </div>
   <?php 
      unset($_SESSION["error"]);
      endif;
   ?>
      <form name="order" method="post" action="confirm.php">
         <div
            class="uk-card-default uk-card-small uk-flex uk-flex uk-flex-column uk-flex-between uk-padding-small uk-flex-1">
            <div class="uk-card-header">
               <h2>Betalen</h2>
            </div>
            <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
               <div class="uk-flex uk-flex-between uk-gap">
                  <img src="img/IDEAL.png" class="" alt="" title="" />
                  <select name="bank" onchange="disableConfirm()">
                     <option value="0">Kies uw bank</option>
                     <option value="1">Rabobank</option>
                     <option value="2">ASN Bank</option>
                     <option value="3">ING Bank</option>
                     <option value="4">Regiobank</option>
                     <option value="5">SNS Bank</option>
                     <option value="6">ABNAMRO Bank</option>
                  </select>
               </div>
            </div>
            <div class="uk-card-footer">
               <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
                  <input type="submit" class="uk-button uk-button-primary" value="Betalen" name="submit" disabled>
               </div>
            </div>
         </div>
      </form>

   </section>
</main>

<?php
include_once("template/foot.inc.php");

