<?php
    $mostraRisultato = false;
    $errore = "";
    $risultato = 0;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $num1 = (float) $_POST["a"];
        $num2 = (float) $_POST["b"];

        if (isset($_POST["operazione"])) {
            $operazione = $_POST["operazione"];
        } else {
            $operazione = "";
        }

        if (isset($_POST["opzioni"])) {
            $opzioni = $_POST["opzioni"];
        } else {
            $opzioni = array();
        }

        if ($operazione == "") {
            $errore = "Devi scegliere un'operazione.";
        } elseif ($operazione == "somma") {
            $risultato = $num1 + $num2;
        } elseif ($operazione == "differenza") {
            $risultato = $num1 - $num2;
        } elseif ($operazione == "prodotto") {
            $risultato = $num1 * $num2;
        } elseif ($operazione == "quoziente") {
            if ($num2 == 0) {
                $errore = "Non puoi dividere per zero.";
            } else {
                $risultato = $num1 / $num2;
            }
        }

        // Applico le opzioni solo se non ci sono errori
        if ($errore == "") {
            if (in_array("valAsso", $opzioni)) {
                $risultato = abs($risultato);
            }
            if (in_array("quadr", $opzioni)) {
                $risultato = $risultato * $risultato;
            }
            if (in_array("arr", $opzioni)) {
                $risultato = round($risultato, 2);
            }
        }

        $mostraRisultato = true;
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatrice</title>
</head>
<body>
    <h1>Calcolatrice</h1>

    <form action="index.php" method="POST">
        <label for="a">a: </label>
        <input type="number" id="a" name="a" step="any" required>
        <br>
        <label for="b">b: </label>
        <input type="number" id="b" name="b" step="any" required>

        <br>
        <fieldset>
            <legend>Operazione</legend>

            <input type="radio" name="operazione" id="somma" value="somma">
            <label for="somma">Somma</label>
            <br>
            <input type="radio" name="operazione" id="differenza" value="differenza">
            <label for="differenza">Differenza</label>
            <br>
            <input type="radio" name="operazione" id="prodotto" value="prodotto">
            <label for="prodotto">Prodotto</label>
            <br>
            <input type="radio" name="operazione" id="quoziente" value="quoziente">
            <label for="quoziente">Quoziente</label>
        </fieldset>

        <br>

        <fieldset>
            <legend>Opzioni</legend>

            <input type="checkbox" name="opzioni[]" id="valAsso" value="valAsso">
            <label for="valAsso">Valore Assoluto</label>
            <br>
            <input type="checkbox" name="opzioni[]" id="quadr" value="quadr">
            <label for="quadr">Quadrato</label>
            <br>
            <input type="checkbox" name="opzioni[]" id="arr" value="arr">
            <label for="arr">Arrotonda a due decimali</label>
        </fieldset>
        <br>
        <input type="submit" value="Calcola">
    </form>

    <div class="risultato">
        <?php if ($mostraRisultato): ?>

            <h1>Risultato</h1>

            <?php if ($errore != ""): ?>
                <p style="color: red;"><?php echo $errore; ?></p>
            <?php else: ?>
                <p><?php echo $risultato; ?></p>
            <?php endif; ?>

            <a href="index.php" class="link-back">Calcola di nuovo</a>

        <?php endif; ?>
    </div>
</body>
</htm