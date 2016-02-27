<?php
//Escape HTML entities in a string.
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

//Strips non numeric from a string
function n($value)
{
    return preg_replace('/\D/', '', $value);
}
