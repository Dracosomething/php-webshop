<?php
include_once("template/head.inc.php");
?>

<main class="uk-container">
    <div class="uk-flex uk-flex-wrap uk-flex-wrap-around">
        <div class="uk-width-1-1 uk-margin-top">
            <div class="uk-card uk-card-default">
                <h3 class="uk-card-title uk-text-center">Bedankt voor uw besteling</h3>
                <div class="uk-card-body">
                    <div class="uk-clearfix">
                        <div class="uk-float-left">
                            <p>U krijgt uw besteling binnenkort binnen.</p>
                        </div>
                        <div class="uk-float-right">
                            <div class="uk-card uk-card-default uk-card-body">
                                besteling nummer:<br>
                                1234567
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-1 uk-margin-top uk-margin-bottom">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <h3>
                        Factuur
                    </h3>
                </div>
                <div class="uk-card-body">
                    <div class="">
                        <div class="uk-width-1-1">
                            <div class="uk-align-left">
                                <p class="uk-text-bolder">Artikelen:</p>
                                <p>Stoel Deluxe (1)</p>
                                <p>Gerard (1 uur)</p><br>
                                <p class="uk-text-bolder">Verzendkosten</p>
                            </div>
                            <div class="uk-align-right">
                                <br>
                                <p>&euro;20,-</p>
                                <p>&euro;20,-</p>
                                <br>
                                <p class="uk-text-bolder">&euro;0,-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-card-footer">
                    <div class="uk-width-1-1">
                        <div class="uk-align-left uk-text-bolder">
                            <p>Te betalen</p>
                        </div>
                        <div class="uk-align-right uk-text-bolder">
                            <p>&euro;40,-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("template/foot.inc.php");