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
     * Segpay billing URL
     *
     * @var string
     */
    protected $billingURL = 'https://secure2.segpay.com/billing/poset.cgi?';

    /**
     * Segpay srs customer support URL
     *
     * @var string
     */
    protected $srsCustomerURL = 'https://srs.segpay.com/ADM.asmx/';
    /**
     * Segpay reports URL
     *
     * @var string
     */
    protected $srsReportsURL = 'https://srs.segpay.com/MWS.asmx/';

    /**
     * Segpay One Click URL
     *
     * @var string
     */
    protected $oneClickURL = 'https://secure2.segpay.com/billing/OneClick.aspx?';

    /**
     * The PaxumPayment constructor
     */
    public function __construct()
    {
        $this->package = config('segpay.segpay_package');
        $this->user_id = config('segpay.segpay_user_id');
        $this->user_access_key = config('segpay.segpay_user_access_key');
        $this->url_id = config('segpay.segpay_url_id');
    }

    /***********************************************************
     *
     *  PAYMENTS
     *
     ***********************************************************/


    /**
     * Subscription link
     * @param $price_point_id
     * @param $buyer_email
     * @param $buyer_username
     * @param $merchant_partner_username
     * @param string $currency
     * @param null $x_auth_link
     * @param null $x_auth_text
     * @param null $x_decl_link
     * @param null $x_decl_text
     * @param null $ref_1
     * @param null $ref_2
     * @param null $ref_3
     * @return string
     */
    public function generateSignUpPayment($price_point_id, $buyer_email, $buyer_username, $merchant_partner_username,
        $currency = 'USD', $x_auth_link=null, $x_auth_text=null,$x_decl_link=null,$x_decl_text=null,
        $ref_1=null, $ref_2=null, $ref_3 = null)
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
        if(!is_null($x_auth_link)) {
            $return_url .= sprintf("&x-auth-link=%s", urlencode($x_auth_link));
        }
        if(!is_null($x_auth_text)) {
            $return_url .= sprintf("&x-auth-text=%s", urlencode($x_auth_text));
        }
        if(!is_null($x_decl_link)) {
            $return_url .= sprintf("&x-decl-link=%s", urlencode($x_decl_link));
        }
        if(!is_null($x_decl_text)) {
            $return_url .= sprintf("&x-decl-text=%s", urlencode($x_decl_text));
        }

        return $return_url;
    }

    /**
     * One Click Pricing Link
     * @param $price_point_id
     * @param $oc_token
     * @param null $x_auth_link
     * @param null $x_auth_text
     * @param null $x_decl_link
     * @param null $x_decl_text
     * @return string
     */
    public function generateOneClickPricing($price_point_id,$oc_token,$x_auth_link=null, $x_auth_text=null,$x_decl_link=null,$x_decl_text=null)
    {
        $return_url = $this->oneClickURL;
        $return_url .= sprintf("x-eticketid=%s:%s", urlencode($this->package), urlencode($price_point_id));
        $return_url .= sprintf("&OCToken=%s", urlencode($oc_token));
        if(!is_null($x_auth_link)) {
            $return_url .= sprintf("&x-auth-link=%s", urlencode($x_auth_link));
        }
        if(!is_null($x_auth_text)) {
            $return_url .= sprintf("&x-auth-text=%s", urlencode($x_auth_text));
        }
        if(!is_null($x_decl_link)) {
            $return_url .= sprintf("&x-decl-link=%s", urlencode($x_decl_link));
        }
        if(!is_null($x_decl_text)) {
            $return_url .= sprintf("&x-decl-text=%s", urlencode($x_decl_text));
        }

        return $return_url;
    }

    /***********************************************************
     *
     *  CUSTOMER SUPPORT TASKS
     *
     ***********************************************************/

    /**
     * Cancel subscription link
     * @param $purchase_id
     * @param null $cancel_reason
     * @return string
     */
    public function generateCancelSubscription($purchase_id,$cancel_reason=null)
    {
        $return_url = $this->srsCustomerURL.'CancelMembership?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&CancelReason=%s", urlencode($cancel_reason));
        return $return_url;
    }

    /**
     * Expire an Account
     * @param $purchase_id
     * @param null $cancel_reason
     * @return string
     */
    public function generateExpireMembership($purchase_id,$cancel_reason=null)
    {
        $return_url = $this->srsCustomerURL.'ExpireMembership?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&CancelReason=%s", urlencode($cancel_reason));
        return $return_url;
    }

    /**
     * Refund a Payment
     * @param $trans_id
     * @param null $refund_reason
     * @return string
     */
    public function generateRefundPayment($trans_id,$refund_reason=null)
    {
        $return_url = $this->srsCustomerURL.'RefundTransaction?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($trans_id));
        $return_url .= sprintf("&RefundReason=%s", urlencode($refund_reason));
        return $return_url;
    }

    /**
     * Update a Consumer’s Login Info
     * @param $purchase_id
     * @param $new_username
     * @param $new_password
     * @return string
     */
    public function generateUpdateCustomerLoginInfo($purchase_id,$new_username,$new_password)
    {
        $return_url = $this->srsCustomerURL.'UpdateUserNamePswd?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&Username=%s", urlencode($new_username));
        $return_url .= sprintf("&Password=%s", urlencode($new_password));
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
        $return_url = $this->srsCustomerURL.'ModifyRebillAmount?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&RecurringAmount=%s", urlencode($new_price));
        $return_url .= sprintf("&Comments=%s", urlencode($comment));
        return $return_url;
    }

    /**
     * Change a Recurring Bill Date
     * @param $purchase_id
     * @param $days
     * @return string
     */
    public function generateChangeRecurringBillDate($purchase_id,$days = 0)
    {
        $return_url = $this->srsCustomerURL.'ExtendMembership?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&Days=%s", urlencode($days));
        return $return_url;
    }

    /**
     * Insert Consumer Note
     * @param $purchase_id
     * @param null $note
     * @return string
     */
    public function generateInsertConsumerNote($purchase_id,$note=null)
    {
        $return_url = $this->srsCustomerURL.'InsertConsumerNote?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&Note=%s", urlencode($note));
        return $return_url;
    }

    /**
     * Get Postback IP List
     * @return string
     */
    public function generateGetPostbackIPList()
    {
        $return_url = $this->srsCustomerURL.'GetPostbackIPList?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        return $return_url;
    }

    /**
     * Blacklist an IP address (for a specific site)
     * @param $ip_address
     * @param $reason_code
     * @param null $comment
     * @return string
     */
    public function generateBlacklistIpAddress($ip_address,$reason_code, $comment=null)
    {
        $return_url = $this->srsCustomerURL.'InsertMerchantFraudIPAddress?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&IPAddress=%s", urlencode($ip_address));
        $return_url .= sprintf("&ReasonCode=%s", urlencode($reason_code));
        $return_url .= sprintf("&Comment=%s", urlencode($comment));
        return $return_url;
    }

    /**
     * Blacklist an Email address (for a specific site)
     * @param $email_address
     * @param $reason_code
     * @param null $comment
     * @return string
     */
    public function generateBlacklistEmailAddress($email_address,$reason_code,$comment=null)
    {
        $return_url = $this->srsCustomerURL.'CancelMembership?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&EmailAddress=%s", urlencode($email_address));
        $return_url .= sprintf("&ReasonCode=%s", urlencode($reason_code));
        $return_url .= sprintf("&Comment=%s", urlencode($comment));
        return $return_url;
    }


    /***********************************************************
     *
     *  REPORTS
     *
     ***********************************************************/

    /**
     * Transactions Purchases By URL
     * @param $transaction_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateTransactionsPurchasesByURL($transaction_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'TransactionsPurchasesByURL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($transaction_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Assets Active Subscriptions By URL
     * @param $purchase_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateAssetsActiveSubscriptionsByURL($purchase_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'AssetsActiveSubscriptionsByURL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Assets Active Subscriptions By URL and Rebill Date
     * @param $purchase_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateAssetsActiveSubscriptionsByURL_RebillDate($purchase_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'AssetsActiveSubscriptionsByURL_RebillDate?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Assets Cancelled Subscriptions By URL
     * @param $purchase_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateAssetsCancelledSubscriptionsByURL($purchase_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'AssetsCancelledSubscriptionsByURL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&PurchaseID=%s", urlencode($purchase_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Pay Page Stats Hits By URL
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generatePayPageStatsHitsByURL($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'PayPageStatsHitsByURL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Pay Page Stats Hits By URL & Browser
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generatePayPageStatsHitsByURL_Browser($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'PayPageStatsHitsByURL_Browser?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Pay Page Stats Hits By URL & Country
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generatePayPageStatsHitsByURL_Country($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'PayPageStatsHitsByURL_Country?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Pay Page Stats Hits By URL & Region
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generatePayPageStatsHitsByURL_Region($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'PayPageStatsHitsByURL_Region?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Revenue Daily Summary
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateGetListOfDeclinedPayment($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'RevenueDailySummary?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        return $return_url;
    }

    /**
     * Revenue Hourly Signup Counts by URL
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateRevenueHourlySignupCounts_URL($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'RevenueHourlySignupCounts_URL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Revenue Hourly Signup by URL
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateRevenueHourlySignup_URL($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'RevenueHourlySignup_URL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Revenue Summary by Source and URL
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function RevenueSummaryBySource_URL($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'RevenueSummaryBySource_URL?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Revenue Summary by URL
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateRevenueSummaryByURL($start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'TransactionsList_Declined?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }

    /**
     * Transaction by Purchase ID
     * @param $purchase_id
     * @return string
     */
    public function generateTransactionByPurchaseID($purchase_id)
    {
        $return_url = $this->srsReportsURL.'TransactionByPurchaseID?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&purchaseid=%s", urlencode($purchase_id));
        return $return_url;
    }

    /**
     * Transaction by Transaction ID
     * @param $transaction_id
     * @return string
     */
    public function generateTransactionByTransID($transaction_id)
    {
        $return_url = $this->srsReportsURL.'TransactionByTransID?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($transaction_id));
        return $return_url;
    }

    /**
     * Transactions List
     * @param $transaction_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateTransactionsList($transaction_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'TransactionsList?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($transaction_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }


    /**
     * Get list of all declined payments between two days
     * @param $transaction_id
     * @param null $start_date
     * @param null $end_date
     * @return string
     */
    public function generateTransactionsListDeclined($transaction_id,$start_date = null, $end_date = null)
    {
        $return_url = $this->srsReportsURL.'TransactionsList_Declined?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        $return_url .= sprintf("&TransID=%s", urlencode($transaction_id));
        $return_url .= sprintf("&BegDate=%s", urlencode($start_date));
        $return_url .= sprintf("&EndDate=%s", urlencode($end_date));
        $return_url .= sprintf("&URLID=%s", urlencode($this->url_id));
        return $return_url;
    }


    /**
     * Get Merchant Fraud Emails
     * @return string
     */
    public function generateGetMerchantFraudEmails()
    {
        $return_url = $this->srsReportsURL.'GetMerchantFraudEmails?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        return $return_url;
    }


    /**
     * Get Merchant Fraud IP Address
     * @return string
     */
    public function generateGetMerchantFraudIPAddress()
    {
        $return_url = $this->srsReportsURL.'GetMerchantFraudIPAddress?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        return $return_url;
    }

    /**
     * URL Listing
     * @return string
     */
    public function generateURLListing()
    {
        $return_url = $this->srsReportsURL.'URL_Listing?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        return $return_url;
    }

    /**
     * Validate User Access
     * @return string
     */
    public function generateValidateUserAccess()
    {
        $return_url = $this->srsReportsURL.'ValidateUserAccess?';
        $return_url .= sprintf("Userid=%s", urlencode($this->user_id));
        $return_url .= sprintf("&UserAccessKey=%s", urlencode($this->user_access_key));
        return $return_url;
    }

}

?>