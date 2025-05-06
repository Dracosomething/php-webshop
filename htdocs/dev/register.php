<?php
include_once("template/head.inc.php");
?>
<main>
    <div class="uk-container">
        <div class="uk-flex uk-flex-center uk-flex-wrap uk-flex-wrap-around">
            <div class="uk-flex-column"></div>
            <div class="uk-flex-column">
                <div class="uk-flex-row@xl">
                    <div class="uk-card uk-card-large uk-card-default uk-grid-collapse uk-margin" uk-grid>
                        <div>
                            <div class="uk-card-header uk-text-center">
                                <h2>
                                    Registreren
                                </h2>
                            </div>
                            <div class="uk-card-body">
                                <div id="error-card" class="uk-alert-danger" uk-alert style="display: none;">
                                    <p>something went wrong</p>
                                    <button class="uk-alert-close" type="button" uk-close></button>
                                </div>
                                <form name="register" method="post" action="src/formHandlers/register.handler.php">
                                    <div class="uk-flex uk-flex-wrap uk-flex-wrap-around uk-margin">
                                        <div class="uk-width-1-1">
                                            <label for="first-name">voornaam</label><br>
                                            <input class="uk-input" type="text" placeholder="voornaam..."
                                                id="first-name" name="first_name" required>
                                        </div>

                                        <div class="uk-width-1-4 uk-margin-top">
                                            <label for="infix">Tussenvoegsels </label><br>
                                            <input class="uk-input" type="text" placeholder="tussenvoegsel..."
                                                id="infix" name="infix">
                                        </div>

                                        <div class="uk-width-1-2 uk-margin-left uk-margin-top">
                                            <label for="last-name">Achternaam</label><br>
                                            <input class="uk-input" type="text" placeholder="achternaam..."
                                                id="last-name" name="last_name" required>
                                        </div>

                                        <div class="uk-width-1-2 uk-margin-top">
                                            <label for="street-name">Straatnaam</label><br>
                                            <input class="uk-input" type="text" placeholder="straatnaam..."
                                                id="street-name" name="street_name" required>
                                        </div>
                                        <div class="uk-width-1-5 uk-margin-left uk-margin-top">
                                            <label for="adress">Huisnummer</label><br>
                                            <input class="uk-input" type="number" placeholder="huisnummer..."
                                                id="house_number" name="house_number" required>
                                        </div>
                                        <div class="uk-width-1-5 uk-margin-left uk-margin-top">
                                            <label for="additions">Toevoegingen</label><br>
                                            <input class="uk-input" type="text" placeholder="toevoegingen..."
                                                id="additions" name="street_name_addon">
                                        </div>

                                        <div class="uk-width-1-3 uk-margin-top">
                                            <label for="code">Postcode</label><br>
                                            <input class="uk-input" type="text" placeholder="postcode..." id="code" name="zipcode" required>
                                        </div>
                                        <div class="uk-width-1-2 uk-margin-left uk-margin-top">
                                            <label for="town">Plaats</label><br>
                                            <input class="uk-input" type="text" placeholder="plaats..." id="town" name="city" required>
                                        </div>

                                        <div class="uk-width-1-1 uk-margin-top">
                                            <label for="mail">Email</label><br>
                                            <input class="uk-input" type="email" name="email" id="mail"
                                                placeholder="E-mail adress..." required>
                                        </div>

                                        <div class="uk-width-1-1 uk-margin-top">
                                            <label for="password">Wachtwoord</label><br>
                                            <input oninput="passwordCheck()" class="uk-input" type="password" name="password"
                                                placeholder="wachtwoord..." required>
                                        </div>

                                        <div class="uk-width-1-1 uk-margin-top">
                                            <label for="password-contr">Wachtwoord Controle</label><br>
                                            <input oninput="passwordCheck()" class="uk-input" type="password" name="password-contr"
                                                id="password-contr" placeholder="Voer het wachtwoord nogmaals in..." required>
                                        </div>
                                        <div class="uk-width-1-1 uk-margin-top">
                                            <hr>
                                        </div>
                                        <div class="uk-margin-top">
                                            <div class="uk-clearfix">
                                                <div class="uk-float-right uk-margin-large-left">
                                                    <input class="uk-button uk-button-default" type="submit"
                                                        name="register" value="Registreren" onclick="addRedTextToEmptyInputFields('register', true)">
                                                </div>
                                                <div class="uk-float-left uk-margin-large-right">
                                                    <a class="uk-link-text uk-text-primary" href="login.php">
                                                        Inloggen
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
            </div>
            <div class="uk-flex-column"></div>
        </div>
    </div>
</main>
<?php
include_once("template/foot.inc.php");