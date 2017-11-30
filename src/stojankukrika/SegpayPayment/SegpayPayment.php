<?php

namespace stojankukrika\SegpayPayment;

/**
 * Segpay API main class
 *
 * @package stojankukrika\SegpayPayment
 * @author Stojan Kukrika <stojankukrika@gmail.com>
 */

class SegpayPayment
{

    /**
     * @var string
     */
    private $package = null;

    /**
     * @var string
     */
    private $user_id = null;

    /**
     * @var string
     */
    private $user_access_key = null;

    /**
     * @var string
     */
    private $url_id = null;

    /**
     * @var string
     */
    private $x_auth_link = null;

    /**
     * @var string
     */
    private $x_auth_text = null;

    /**
     * @var string
     */
    private $x_decl_link = null;

    /**
     * @var string
     */
    private $x_decl_text = null;

    /**
     * Segpay billing URL
     *
     * @var string
     */
    protected $billingURL = 'https://secure2.segpay.com/billing/poset.cgi?';

    /**
     * Segpay srs URL
     *
     * @var string
     */
    protected $srsURL = 'https://srs.segpay.com/ADM.asmx/';

    /**
     * The PaxumPayment constructor
     */
    public function __construct()
    {
        $this->package = config('segpay.segpay_package');
        $this->user_id = config('segpay.segpay_user_id');
        $this->user_access_key = config('segpay.segpay_user_access_key');
        $this->url_id = config('segpay.segpay_url_id');
        $this->x_auth_link = config('segpay.segpay_x_auth_link');
        $this->x_auth_text = config('segpay.segpay_x_auth_text');
        $this->x_decl_link = config('segpay.segpay_x_decl_link');
        $this->x_decl_text = config('segpay.segpay_x_decl_text');
    }

    /**
     * Subscription link
     * @param $price_point_id
     * @param $buyer_email
     * @param $merchant_partner_username
     * @param string $currency
     * @param null $buyer_username
     * @param null $ref_1
     * @param null $ref_2
     * @param null $ref_3
     * @return string
     */
    public function generateSignUpPaymentPage($price_point_id, $buyer_email, $merchant_partner_username,
        $currency = 'USD', $buyer_username=null, $ref_1=null, $ref_2=null, $ref_3 = null)
    {
        $return_url = $this->billingURL;
        $return_url .= sprintf("x-eticketid=%s:%s", urlencode($this->package), urlencode($price_point_id));
        $return_url .= sprintf("&x-billemail=%s", urlencode($buyer_email));
        $return_url .= sprintf("&username=%s", urlencode($buyer_username));
        $return_url .= sprintf("&dmcurrency=%s", urlencode($currency));
        $return_url .= sprintf("&merchantpartnerid=%s", urlencode($merchant_partner_username));
        $return_url .= sprintf("&pplist=%s", urlencode($price_point_id));
        $return_url .= sprintf("&REF1=%s", urlencode($ref_1));
        $return_url .= sprintf("&REF2=%s", urlencode($ref_2));
        $return_url .= sprintf("&REF3=%s", urlencode($ref_3));
        $return_url .= sprintf("&x-auth-link=%s", urlencode($this->x_auth_link));
        $return_url .= sprintf("&x-decl-text=%s", urlencode($this->x_auth_text));
        $return_url .= sprintf("&x-auth-link=%s", urlencode($this->x_decl_link));
        $return_url .= sprintf("&x-auth-text=%s", urlencode($this->x_decl_text));

        return $return_url;
    }

    /**
     * Cancel subscription link
     * @param $purchase_id
     * @param null $cancel_reason
     * @return string
     */
    public function generateCancelSubscription($purchase_id,$cancel_reason=null)
    {
        $return_url = $this->srsURL.'CancelMembership?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&CancelReason=%s", urlencode($cancel_reason));
        return $return_url;
    }

    /**
     * Get list of all declined payments between two days
     * @param $transaction_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateGetListOfDeclinedPayment($transaction_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsURL.'TransactionsList_Declined?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($transaction_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Change amount for some purchase
     * @param $purchase_id
     * @param $new_price
     * @param null $comment
     * @return string
     */

    public function generateChangeAmountPayment($purchase_id, $new_price, $comment=null)
    {
        $return_url = $this->srsURL.'ModifyRebillAmount?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&RecurringAmount=%s", urlencode($new_price));
        $return_url .= sprintf("&Comments=%s", urlencode($comment));
        return $return_url;
    }
}

?>