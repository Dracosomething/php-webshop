<?php
include_once("template/head.inc.php");
?>
<main>
    <div class="uk-margin-right uk-margin-bottom uk-margin-left uk-margin-top">
        <div class="uk-flex uk-flex-wrap uk-flex-wrap-around">
            <!-- start first card -->
            <div class="uk-flex-column uk-width-1-2 uk-margin-xlarge-right">
                <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-3 uk-margin" uk-grid>
                    <div class="uk-card-media-left uk-cover-container">
                        <img src="images/light.jpg" alt="" uk-cover>
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div class="uk-width-1-2">
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Media Left</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                    <div class="uk-width-1-6 uk-margin-large-top">
                        <form>
                            <input class="uk-input uk-width-1-3" type="number">
                            <div class="uk-inline">
                                <a class="uk-form-icon uk-form-danger" uk-icon="icon: trash"></a>
                                <input class="uk-input uk-form-blank uk-form-danger" type="button"
                                    aria-label="Clickable icon">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end first card -->
            </div>
            <div class="uk-flex-column uk-margin-xlarge-left uk-width-1-4 uk-align-right">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        <h3>
                            Overzicht
                        </h3>
                    </div>
                    <div class="uk-card-body">
                        <div class="">
                            <div class="uk-width-1-1">
                                <div class="uk-align-left">
                                    <p>Artikelen (2)</p>
                                </div>
                                <div class="uk-align-right">
                                    <p>&euro;20,-</p>
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <div class="uk-align-left">
                                    <p>Verzendkosten</p>
                                </div>
                                <div class="uk-align-right">
                                    <p>&euro;0,-</p>
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
                                <p>&euro;20,-</p>
                            </div>
                        </div>
                        <div class="uk-text-center">
                            <a href="confirm.php" class="uk-button uk-button-primary uk-margin-medium-top">verder naar
                                Bestelling</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("template/foot.inc.php");