<?php
require_once (dirname(__FILE__) . "/session.form.func.inc");
function ProcessPersonalForm($strFormKey)
{
    $aPostVars = $_REQUEST;
    $aPersonalVals = array();
    foreach ($aPostVars as $strKey => $strVal)
    {
        if (isset($aPersonalVals[$strKey]))
        {
            // Duplicate key!. Let's append
            $aPersonalVals[$strKey] .= $strVal;
        }
        else
        {
            $aPersonalVals[$strKey] = $strVal;
        }
    }
    WriteFormSessionData($strFormKey, $aPersonalVals);
}