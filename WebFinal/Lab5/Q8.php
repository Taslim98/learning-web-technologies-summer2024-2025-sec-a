<?php
$array = [
    [1, 2, 3],
    ['A', 1, 2],
    ['B', 'C', 1],
    ['D', 'E', 'F']
];

// Shape 1: Using first row for base, but printing inverted like in the example
for ($i = 3; $i >= 1; $i--) {
    for ($j = 0; $j < $i; $j++) {
        echo $array[0][$j] . " "; // Adapting from row 1 for numbers
    }
    echo "<br>";
}

echo "<br>";

// Shape 2: Triangle of letters (adapting from later rows)
for ($i = 1; $i <= 3; $i++) {
    for ($j = 0; $j < $i; $j++) {
        echo $array[$i][$j] . " "; // Row 1: A, Row 2: B C, Row 3: D E F (skipping row 0)
    }
    echo "<br>";
}
?>