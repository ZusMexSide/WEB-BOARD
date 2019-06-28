<?php
$password="321";
$hash=password_hash($password,PASSWORD_DEFAULT,['cost'=>10]);
echo $hash;
if (password_verify('123', $hash)){
    echo " correcto";
}