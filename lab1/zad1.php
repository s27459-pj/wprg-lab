<?php
// 1. Stwórz tablicę zawierającą nazwy kilku owoców (np. "jabłko", "banan", "pomarańcza").
// Napisz pętlę, która wyświetli każdy owoc w osobnej linii, pisany od tyłu (nie używaj
// żadnej funkcji wbudowanej) oraz informację, czy dany owoc zaczyna się literą "p".

$fruit = ["jablko", "banan", "pomarancza", "pomidor", "gruszka", "papaja", "pomelo"];
foreach ($fruit as $value) {
    for ($i = strlen($value) - 1; $i >= 0; $i--) {
        echo $value[$i];
    }
    if ($value[0] == "p") {
        echo " (starts with p)";
    }
    echo "\n";
}
