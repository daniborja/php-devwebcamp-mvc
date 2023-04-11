<?php


function debugging($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escape / Sanitize HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// check authentication status
function isAuth(): bool
{
    session_start();

    return !!$_SESSION['is_logged_in'] && isset($_SESSION['email']) && !empty($_SESSION);
}

function isAdmin(): bool
{
    session_start();

    return !!$_SESSION['is_logged_in'] && !!$_SESSION['is_admin'] && !empty($_SESSION);
}



function isActiveLink($path): bool
{
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}
