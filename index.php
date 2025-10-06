<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //variabili
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $piatto = isset($_POST["piatto"]) ? $_POST["piatto"] : "";
    $allergie = isset($_POST["allergie"]) ? $_POST["allergie"] : [];

    //ricettario con array associativo
    $ricette = [
        [
            "nome" => "pancake",
            "img" => "https://blog.giallozafferano.it/allacciateilgrembiule/wp-content/uploads/2018/03/ricetta-pancake-perfetti.jpg",
            "allergeni" => ["uova", "glutine", "lattosio"],
        ],
        [
            "nome" => "lasagne alla bolognese",
            "img" => "https://www.giallozafferano.it/images/ricette/178/17816/foto_hd/hd650x433_wm.jpg",
            "allergeni" => ["glutine", "lattosio"],
        ],
        [
            "nome" => "torta alle nocciole",
            "img" => "https://www.giallozafferano.it/images/ricette/4/473/foto_hd/hd650x433_wm.jpg",
            "allergeni" => ["frutta secca", "glutine", "lattosio"],
        ],
        [
            "nome" => "spaghetti ai gamberi",
            "img" => "https://www.giallozafferano.it/images/ricette/232/23245/foto_hd/hd650x433_wm.jpg",
            "allergeni" => ["crostacei", "glutine"],
        ],
    ];

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
        echo "<p>Il nostro chef ti sorprenderà! Ecco le ricette disponibili per te:</p>";

        $trovata = false; 
        foreach ($ricette as $r) {
            $compatibile = true;

            //controlla se la ricetta contiene uno degli allergeni selezionati
            foreach ($allergie as $a) {
                if (in_array(strtolower($a), array_map('strtolower', $r["allergeni"]))) {
                    $compatibile = false;
                    break;
                }
            }

            //se compatibile, mostra la ricetta
            if ($compatibile) {
                $trovata = true;
                echo "<div style='margin-bottom: 15px;'>";
                echo "<h3>" . ucfirst($r["nome"]) . "</h3>";
                echo "<img src='" . $r["img"] . "' alt='" . $r["nome"] . "' width='300'><br>";
                echo "</div>";
            }
        }

        //se nessuna ricetta è disponibile
        if (!$trovata) {
            echo "<p><i>Sembra che il nostro menu non sia adatto alle tue esigenze alimentari...<br>
            Ma non preoccuparti, il nostro chef preparerà qualcosa di speciale!</i> </p>";
        }
    }

    //allergie
    if (!empty($allergie)) {
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
        <label><input type="checkbox" name="allergie[]" value="Glutine"> Glutine</label><br>
        <label><input type="checkbox" name="allergie[]" value="Lattosio"> Lattosio</label><br>
        <label><input type="checkbox" name="allergie[]" value="Frutta secca"> Frutta secca</label><br>
        <label><input type="checkbox" name="allergie[]" value="Crostacei"> Crostacei</label><br>
        <label><input type="checkbox" name="allergie[]" value="Altro"> Altro</label><br><br>
        <input type="submit" value="Invia">
    </form>
    <?php
}
?>
