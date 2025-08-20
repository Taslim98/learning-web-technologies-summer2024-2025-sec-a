<?php
// Shape 1: Triangle of *
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

echo "<br>";

// Shape 2: Inverted triangle of numbers
for ($i = 3; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}

echo "<br>";

// Shape 3: Triangle of letters
$letters = ['A', 'B', 'C', 'D', 'E', 'F'];
$k = 0;
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $letters[$k] . " ";
        $k++;
    }
    echo "<br>";
}
?>