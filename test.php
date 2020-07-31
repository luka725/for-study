<php?>

function addition( $val ){
    $val = $val + 1;
    return $val;
}

function multipycation( $val ){
    $val = $val * 2;
    return $val;
}

add_filter("unit", "addition", 1, 1)
add_filter("unit", "multipycation", 2, 1)

global s = 15

apply_filters("unit", s)

<?php