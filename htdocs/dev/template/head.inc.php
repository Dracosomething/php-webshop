<?php
include_once(__DIR__ . "/../src/helpers/login.helper.php");
include_once(__DIR__ . "/../src/database/Database.class.php");
include_once(__DIR__ . "/../src/helpers/cart.helper.php");

try {
    $dbconn = new Database();
    $login = new LoginHelper();
    $CartHelper = new CartHelper($dbconn);
} catch(PDOException $error) {
    echo "Connection failed: " . $e->getMessage();
    die();
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/uikit_rtl.min.css" rel="stylesheet" />
    <link href="./css/uikit.min.css" rel="stylesheet" />

    <title>Stoelen Sleepers</title>
</head>

<body>
    <nav class="uk-navbar-container">
        <div uk-navbar class="uk-margin-xsmall-left uk-margin-medium-right">

            <div class="uk-navbar-left">

                <ul class="uk-navbar-nav">
                    <li>
                        <a href="index.php">
                            <span uk-icon="icon: apple"></span>
                            <p>Stoelen sleepers</p>
                        </a>
                    </li>
                </ul>

            </div>

            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li>
                        <a href="catalogue.php">
                            <span uk-icon="icon: list"></span>
                            <p>Catalogus</p>
                        </a>
                    </li>
                    <?php if (!$login->isLoggedIn()): ?>
                        <li>
                            <a href="login.php">
                                <span uk-icon="icon: sign-in"></span>
                                <p>Inloggen</p>
                            </a>
                        </li>
                        <li>
                            <a href="register.php">
                                <span uk-icon="icon: file-edit"></span>
                                <p>Registreren</p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($login->isLoggedIn()): ?>
                        <li>
                            <a href="cart.php">
                                <span uk-icon="icon: cart"></span>
                                <p>Winkelwagen</p>
                                <span class="uk-badge"><?= $CartHelper->getCartSize(); ?></span>
                            </a>
                        </li>
                        <li>
                            <div>
                                <div class="uk-navbar-item">
                                    <form class="uk-search uk-search-navbar">
                                        <span uk-search-icon></span>
                                        <input class="uk-search-input" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a><?= $login->getUser()["first_name"] . " " . $login->getUser()["infix"] . " " . $login->getUser()["last_name"] ?><span
                                    uk-icon="icon: user" class="uk-parent"></span></a>
                            <div class="uk-navbar-dropdown" uk-drop="boundary: !.uk-navbar; flip: false">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-nav-header">UW GEGEVENS</li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: settings"></span>
                                            <p>Profiel</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: bag"></span>
                                            <p>Bestellingen</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: credit-card"></span>
                                            <p>Facturen</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: refresh"></span>
                                            <p>Retouren</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: heart"></span>
                                            <p>Wensenlijst</p>
                                        </a>
                                    </li>
                                    <br>
                                    <li class="uk-nav-header">CONTACT</li>
                                    <li>
                                        <a href="#">
                                            <span uk-icon="icon: info"></span>
                                            <p>Klantenservice</p>
                                        </a>
                                    </li>
                                    <li class="uk-nav-divider"></li>
                                    <li>
                                        <form method="POST" action="src/formHandlers/logout.handler.php" style="display: none;" id="logout-form">
                                            <input type="hidden" name="id" value="<?= $login->getUser()["ID"] ?>" />
                                        </form>
                                        <a href="javascript:void"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span uk-icon="icon: sign-out"></span>
                                            <p>Uitloggen</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>