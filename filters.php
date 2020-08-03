<?php

function addition( $argument ){
    $argument = $argument + 1;
    return $argument;
}
function square( $argument ){
    $argument = $argument * $argument;
    return $argument;
}
function divide_by_two( $argument ){
    $argument = $argument / 2;
    return $argument;
}

//$filters = array();
//$hooked_functions_list = array();
//$filters[$hook_name] = $hooked_functions_list;

$filters = array();
$hooks = array();
$functions = array();

function add_filter( $hook_name, $func_name, $priority, $arguments ){
    global $filters;
    global $hooks;
    global $functions;
 
    array_push($filters, $hook_name, $func_name, $priority, $arguments);
    array_push($hooks, $func_name, $priority, $arguments);
    array_push($functions, $priority, $arguments);
 
    print_r($filters);
    print_r($hooks);
    print_r($functions);
}
    //print_r($filters);
    //print_r($hooks);
    //print_r($functions);
    //  echo 'petre';
    //array_push($filters[$hook_name], $hook_name, $func_name, $priority, $arguments); 
    //$filters["$hook_name"] = $hooked_functions_list// 
    //array_push ( $hooked_functions_list, $func_name, $priority, $arguments );
    //echo $filters[$hook_name], "\n";
    
add_filter( 'unit', 'addition', 1, 1 );
add_filter( 'unit', 'square', 2, 1 );
add_filter( 'unit', 'divide_by_two', 3, 1 );
add_filter( 'tinu', 'by_by_two', 3, 1 );

// in $tag is stored hook name 
// in $argument is value for thing we must filter
function apply_filter($tag, $argument){
    global $val; 
    echo $val[$tag];
}

/**foreach ($filters as $key => $val){
    foreach ($val as $key1 => $val1){
        echo $key1.' & '.$val1;
    }
}*/

?>