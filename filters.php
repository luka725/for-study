<?php

function addition( $argument ){
    $argument = $argument + 1;
    return $argument;
}

function square( $argument ){
    $argument = $argument * $argument;
    return $argument;
}


// $hook name is to unite other three arguments which is function name, prioriti, and arguments(how many argument is taking a function)

function add_filter( $hook_name, $func_name, $priority, $arguments ){

    //global $val is for store information and give it on the another function in this moment global value must be a hook_name
    global $val;
    $val = array(  
        'function' => $func_name, 
        'priority' => $priority,
    );
}






// in $tag is stored hook name 
// in $argument is value for thing we must filter

function apply_filter( $tag, $argument){
    global $val; 
    echo $val;

}






?>