<?php
class Coupon extends BaseClass
{
    // Pull in our objects

    // Pull in our scalars
    protected $iCouponId;
    protected $iStartDate;
    protected $iEndDate;
    protected $strName;
    protected $strCode;
    /**
     * The remaining uses for this coupon. Use -1 for unlimited.
     * @var int
     */
    protected $iRemaining;

    public function __construct()
    {
        
    }
    
    public function GetValuesArray()
    {
        
    }
}