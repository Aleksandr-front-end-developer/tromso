<?php

/**
 * Some local dev features
 */

/**
 * Dont verify ssl for local dev mode
 */
add_filter( 'https_ssl_verify', '_https_ssl_verify', 10, 2 );
function _https_ssl_verify( $verify, $url ) {
    if ( 'local' == getenv( 'mode' ) ) {
        return false;
    }
    return $verify;
}
