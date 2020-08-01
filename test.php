<?php

function addition( $val ){
    $val = $val + 1;
    return $val;
}



function multiplication( $val ){
    $val = $val * 2;
    return $val;
}



function _wp_filter_build_unique_id( $tag, $function, $priority ) {
    if ( is_string( $function ) ) {
        return $function;
    }
 
    if ( is_object( $function ) ) {
        // Closures are currently implemented as objects.
        $function = array( $function, '' );
    } else {
        $function = (array) $function;
    }
 
    if ( is_object( $function[0] ) ) {
        // Object class calling.
        return spl_object_hash( $function[0] ) . $function[1];
    } elseif ( is_string( $function[0] ) ) {
        // Static calling.
        return $function[0] . '::' . $function[1];
    }
}



function add_filter( $tag, $function_to_add, $priority, $accepted_args ) {
    $idx = _wp_filter_build_unique_id( $tag, $function_to_add, $priority );
 
    $priority_existed = isset( $this->callbacks[ $priority ] );
 
    $this->callbacks[ $priority ][ $idx ] = array(
        'function'      => $function_to_add,
        'accepted_args' => $accepted_args,
    );
 
    // If we're adding a new priority to the list, put them back in sorted order.
    if ( ! $priority_existed && count( $this->callbacks ) > 1 ) {
        ksort( $this->callbacks, SORT_NUMERIC );
    }
 
    if ( $this->nesting_level > 0 ) {
        $this->resort_active_iterations( $priority, $priority_existed );
    }
}



function apply_filters( $tag, $value ) {
    global $wp_filter, $wp_current_filter;
 
    $args = func_get_args();
 
    // Do 'all' actions first.
    if ( isset( $wp_filter['all'] ) ) {
        $wp_current_filter[] = $tag;
        _wp_call_all_hook( $args );
    }
 
    if ( ! isset( $wp_filter[ $tag ] ) ) {
        if ( isset( $wp_filter['all'] ) ) {
            array_pop( $wp_current_filter );
        }
        return $value;
    }
 
    if ( ! isset( $wp_filter['all'] ) ) {
        $wp_current_filter[] = $tag;
    }
 
    // Don't pass the tag name to WP_Hook.
    array_shift( $args );
 
    $filtered = $wp_filter[ $tag ]->apply_filters( $value, $args );
 
    array_pop( $wp_current_filter );
 
    return $filtered;
}


add_filter( 'hook', 'addition', 1, 1);



apply_filters('hook', 4, 1, 1);



?>