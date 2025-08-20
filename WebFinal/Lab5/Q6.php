<?php
$array = [10, 20, 30, 40, 50]; // Example array
$search = 30; // Element to search
$found = false;

for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $search) {
        $found = true;
        break;
    }
}

if ($found) {
    echo "Element found";
} else {
    echo "Element not found";
}
?>