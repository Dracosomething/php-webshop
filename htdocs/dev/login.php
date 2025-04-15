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
                            <div class="uk-card-header uk-text-center">
                                <h2>
                                    Inloggen
                                </h2>
                            </div>
                            <div class="uk-card-body">
                                <form>
                                    <div class="uk-flex uk-flex-column uk-width-1-4">
                                        <div class="uk-flex-row">
                                            <label for="user-name">Username</label><br>
                                            <input type="text" id="user-name" name="user-name">
                                        </div>
                                        <div class="uk-flex-row">
                                            <label for="mail">e-mail</label><br>
                                            <input type="email" id="mail">
                                        </div>
                                        <div class="uk-flex-row">
                                            <label for="password">Password</label><br>
                                            <input type="password" id="password">
                                        </div>
                                        <div class="uk-width-1-1 uk-margin-top">
                                            <hr>
                                        </div>
                                        <div class="uk-flex-row uk-margin-top">
                                            <input class="uk-button uk-button-default" type="submit" name="login"
                                                value="login">
                                        </div>
                                    </div>
                                </form>
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