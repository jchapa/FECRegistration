<?php

/**
 * Starts a session and returns whether there already was one.
 * It creates one if there isn't already a session.
 */

define("SESSION_EXISTS_KEY", "FECSESSIONKEY");

function LoadSession()
{
    $bRetval = false;
    session_start();
    $mSessionKey = LoadSessionData(SESSION_EXISTS_KEY);

    if (isset($mSessionKey) && !empty($mSessionKey)
       )
    {
        // We've got a session. Let's let them know
        $bRetval = true;
    }
    else
    {
        // No session yet. We should make one for them. Leave the retval, though.
        WriteSessionData(SESSION_EXISTS_KEY, "foo");
    }
    return $bRetval;
}

function WriteSessionData($strKey, $strVal)
{
    $_SESSION[$strKey] = $strVal;
}

function LoadSessionData($strKey)
{
    $mRetval = null;
    if (isset($_SESSION[$strKey]))
    {
        $mRetval = $_SESSION[$strKey];
    }
    return $mRetval;
}