<?php
include_once("template/head.inc.php");
?>
<main>
    <div class="uk-container">
        <div class="uk-flex uk-flex-center uk-flex-wrap uk-flex-wrap-around">
            <div class="uk-flex-column"></div>
            <div class="uk-flex-column">
                <div class="uk-flex-row@xl uk-margin-xlarge-bottom"></div>
                <div class="uk-flex-row@xl">
                    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                        <div class="uk-card-media-left uk-cover-container">
                            <img src="images/light.jpg" alt="" uk-cover>
                            <canvas width="600" height="400"></canvas>
                        </div>
                        <div>
                            <div class="uk-card-body">
                                <div class="uk-flex">
                                    <div class="uk-flex-row">
                                        <h2 class="uk-card-title">Stoel</h2>
                                        <p>De beste stoel voor een beginnende stoelensleeper.</p>
                                    </div>
                                    <div class="uk-flex-row">
                                        <div class="uk-flex-column"></div>
                                        <div class="uk-flex-column"></div>
                                        <div class="uk-flex-column">
                                            <h4 class="price-text">&euro; 10,00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-column-1-2 uk-margin-xlarge-top">
                                <p></p>
                                <div class="uk-container uk-margin-medium-right">
                                    <div class="uk-flex uk-flex-right">
                                        <form class="uk-margin-large">
                                            <div uk-form-custom="target: true">
                                                <input type="number" class="uk-form-width-xsmall uk-margin-xsmall-right"
                                                    value="1" min="1" max="50" required>
                                                <button type="submit" class="uk-label uk-button uk-button-primary"><span
                                                        uk-icon="icon: cart"></span> in Winkelwagen</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-flex-row@xl uk-margin-xlarge-top"></div>
            </div>
            <div class="uk-flex-column"></div>
        </div>
    </div>
</main>
<?php
include_once("template/foot.inc.php");