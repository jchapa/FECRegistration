<?php
require_once (dirname(__FILE__) . "/session.func.inc");

define("FORM_SESSION_KEY", "FORM");

function GetFormSessionData($strFormKey)
{
    $aFormSession = LoadSessionData(FORM_SESSION_KEY);

    $aRetval = array();

    if (isset($aFormSession[$strFormKey]))
    {
        foreach ($aFormSession[$strFormKey] as $strKey => $mVal)
        {
            $aRetval[$strKey] = $mVal;
        }
    }

    return $aRetval;
}

function WriteFormSessionData($strFormKey, $aFormData)
{
    // Probably a more generic way to do this (calling the session.func.inc)
    $_SESSION[FORM_SESSION_KEY][$strFormKey] = $aFormData;
}