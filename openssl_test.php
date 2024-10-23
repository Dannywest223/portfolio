<?php
if (function_exists('openssl_encrypt')) {
    echo "OpenSSL is available!";
} else {
    echo "OpenSSL is NOT available.";
}
?>
