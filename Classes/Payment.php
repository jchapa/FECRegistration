<?php
class Payment extends BaseClass
{
    // Pull in our objects
    protected $oFamily;

    // Pull in our scalars
    protected $iPaymentId;
    protected $dAmount;
    protected $iPaymentStatus;

    const PAYMENT_STATUS_PENDING = -1;
    const PAYMENT_STATUS_DECLINED = 0;
    const PAYMENT_STATUS_SUCCESS = 1;

    public function __construct()
    {
        
    }
}