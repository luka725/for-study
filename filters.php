<?php

function addition( $argument ){
    echo 'addition '.$argument, "\n";
    $argument = $argument + 1;
    echo $argument, "\n";
    return $argument;
}
function square( $argument ){
    echo 'square '.$argument, "\n";
    //$argument = $argument - 1;
    $argument = $argument * $argument;
    echo $argument, "\n";
    return $argument;
}
function divide_by_two( $argument ){
    echo 'divide '.$argument, "\n";
    //$argument = $argument + 1;
    $argument = $argument / 2;
    echo $argument, "\n";
    return $argument;
}

$filters   = array();

function add_filter( $hook_name, $func_name, $priority, $arguments ){ 
    global $filters;

    if ( !$filters[$hook_name]):
        $filters[$hook_name] = array(
            $priority => $func_name
        );
    else:
        if ( isset($filters[$hook_name][$priority]) ):
            do {
                $priority ++;
            } while (isset($filters[$hook_name][$priority]));
        endif;
        $filters[$hook_name][$priority] = $func_name;
    endif;
}

add_filter( 'unit', 'addition', 1, 1 );
add_filter( 'unit', 'square', 3, 1 );
add_filter( 'unit', 'divide_by_two', 3, 1 );
/**add_filter( 'unit', 'by_by_two', 3, 1 );
add_filter( 'unit', '21_by_by_two2', 2, 1 );
add_filter( 'unit1', '21_by_by_two1', 2, 1 );*/

function apply_filter($hook_name, $value_to_filter){
    global $filters;
    
    ksort($filters[$hook_name]);
    print_r($filters[$hook_name]);

    foreach ($filters[$hook_name] as $key => $func_name){
            $value_to_filter = $func_name( $value_to_filter );
            echo 'apply filter '.$value_to_filter, "\n";
    }
    return $value_to_filter;
}

$value_to_filter = 5;

echo 'final '.apply_filter('unit' , $value_to_filter );

?>