<?php
function setCookies($name = '', $data = '')
{
    deleteCookies($name);
    setcookie($name, is_array($data) ? encode(json_encode($data)) : encode($data), time() + 3600, '/');
}

function getCookies($name = '')
{
    if (isset($_COOKIE[$name])) {
        $temp = decode($_COOKIE[$name]);
        if (is_null(json_decode($temp))) return $temp;
        return (array)json_decode($temp);
    }
    return NULL;
}

function deleteCookies($name = '')
{
    // unset($_COOKIE[$name]);
    // setcookie($name, NULL, -1, '/');  
    $t = explode("_", $name);
    $m = preg_grep('/^' . $t[0] . '_(\w+)/i', array_keys($_COOKIE));
    foreach ($m as $value) {
        unset($_COOKIE[$value]);
        setcookie($value, NULL, -1, '/');
    }
}