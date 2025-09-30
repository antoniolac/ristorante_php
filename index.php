<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //variabili
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $piatto = isset($_POST["piatto"]) ? $_POST["piatto"] : "";
    $allergie = isset($_POST["allergie"]) ? $_POST["allergie"] : "";

    //saluto
    if ($nome != "") {
        echo "<h2>Benvenuto, $nome!</h2>";
    } else {
        echo "<h2>Benvenuto!</h2>";
    }

    //piatto preferito
    if ($piatto != "") {
        echo "<p>Hai scelto di assaggiare: <b>$piatto</b>. Lo prepareremo con cura!</p>";
    } else {
        echo "<p>il nostro chef ti sorprenderà!</p>";
    }

    //allergie
    if (isset($allergie[0])) {
        echo "<p><b>Allergie da considerare:</b></p><ul>";
        foreach ($allergie as $a) {
            echo "<li>$a</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nessuna allergia segnalata, ottimo!</p>";
    }

    //curiosità su ip
    $ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "sconosciuto";
    echo "<p><i>Curiosità: la tua richiesta arriva dall'indirizzo IP $ip</i></p>";

    //homepage
    echo "<p><a href=''>Torna indietro</a></p>";
} else {
    ?>
    <h1>Ristorante da Tony</h1>
    <form method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
        </p>
        <p>
            <label for="piatto">Piatto preferito:</label>
            <input type="text" id="piatto" name="piatto">
        </p>
        <p>Allergie:</p>
        <label for="all1"><input type="checkbox" id="all1" name="allergie[]" value="Glutine"> Glutine</label><br>
        <label for="all2"><input type="checkbox" id="all2" name="allergie[]" value="Lattosio"> Lattosio</label><br>
        <label for="all3"><input type="checkbox" id="all3" name="allergie[]" value="Frutta secca"> Frutta secca</label><br>
        <label for="all4"><input type="checkbox" id="all4" name="allergie[]" value="Crostacei"> Crostacei</label><br>
        <label for="all5"><input type="checkbox" id="all5" name="allergie[]" value="Altro"> Altro</label><br><br>
        <input type="submit" value="Invia">
    </form>
    <?php
}
?>
