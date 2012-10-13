<?php
require_once (dirname(__FILE__) . "/../Models/CouponDataObject.php");
require_once (dirname(__FILE__) . "/../Models/FamilyDataObject.php");
require_once (dirname(__FILE__) . "/../Models/FamilyMemberDataObject.php");
require_once (dirname(__FILE__) . "/../Models/PaymentDataObject.php");
require_once (dirname(__FILE__) . "/../Models/RegistrationDataObject.php");

abstract class BaseClass
{
    abstract function GetValuesArray();
}