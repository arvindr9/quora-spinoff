<?php

// prevent XSS

foreach ($_POST as $i=>$value) {
    $_POST[$i] = str_replace("<ul>","||ul||",$_POST[$i]);
    $_POST[$i] = str_replace("</ul>","||/ul||",$_POST[$i]);
    $_POST[$i] = str_replace("<li>","||li||",$_POST[$i]);
    $_POST[$i] = str_replace("</li>","||/li||",$_POST[$i]);
}

$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_var_array($_POST, FILTER_SANITIZE_STRING);

function add_slashes_recursive( $variable )
{
    if ( is_string( $variable ) )
        return addslashes( $variable ) ;

    elseif ( is_array( $variable ) )
        foreach( $variable as $i => $value )
            $variable[ $i ] = add_slashes_recursive( $value ) ;

    return $variable ;
}

$_GET = add_slashes_recursive($_GET);
$_POST = add_slashes_recursive($_POST);

foreach ($_POST as $i=>$value) {
    $_POST[$i] = str_replace("||ul||","<ul>",$_POST[$i]);
    $_POST[$i] = str_replace("||/ul||","</ul>",$_POST[$i]);
    $_POST[$i] = str_replace("||li||","<li>",$_POST[$i]);
    $_POST[$i] = str_replace("||/li||","</li>",$_POST[$i]);
}


?>