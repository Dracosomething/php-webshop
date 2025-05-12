<?php
include_once("src/helpers/error.helper.php");
$ErrorHelper = new ErrorHelper();

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
                        <?php if ($ErrorHelper->hasError()): ?>
                            <div id="error-card" class="uk-alert-<?= $ErrorHelper->getErrorCollor() ?>" uk-alert>
                                <p><?= $ErrorHelper->getErrorMsg() ?></p>
                                <button class="uk-alert-close" type="button" uk-close></button>
                            </div>
                        <?php endif; ?>
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
                                <form name="login" method="POST" action="src/formHandlers/login.handler.php">
                                    <div class="uk-flex uk-flex-column uk-width-1-4">
                                        <div class="uk-flex-row">
                                            <label for="mail">E-mail</label><br>
                                            <input type="email" id="mail" name="email" required>
                                        </div>
                                        <div class="uk-flex-row">
                                            <label for="password">Password</label><br>
                                            <input type="password" id="password" name="password" required>
                                        </div>
                                        <div class="uk-width-1-1 uk-margin-top">
                                            <hr>
                                        </div>
                                        <div class="uk-flex-row uk-margin-top">
                                            <div class="uk-clearfix">
                                                <div class="uk-float-right uk-margin-large-left">
                                                    <input onclick="addRedTextToEmptyInputFields('login')"
                                                        class="uk-button uk-button-default" type="submit" name="login"
                                                        value="login">
                                                </div>
                                                <div class="uk-float-left uk-margin-large-right">
                                                    <a class="uk-link-text uk-text-primary" href="register.php">
                                                        Registreren
                                                    </a>
                                                </div>
                                            </div>
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