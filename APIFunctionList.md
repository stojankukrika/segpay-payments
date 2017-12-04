##PAYMENTS URLs

- Subscription Link

generateSignUpPayment($price_point_id, $buyer_email, $buyer_username, $merchant_partner_username, $currency = 'USD', $x_auth_link=null, $x_auth_text=null,$x_decl_link=null,$x_decl_text=null, $ref_1=null, $ref_2=null, $ref_3 = null)

- One Click Pricing Link

generateOneClickPricing($price_point_id,$oc_token,$x_auth_link=null, $x_auth_text=null,$x_decl_link=null,$x_decl_text=null)

##CUSTOMER SUPPORT TASKS URLs
     
- Cancel subscription link

generateCancelSubscription($purchase_id,$cancel_reason=null)

- Expire an Account

generateExpireMembership($purchase_id,$cancel_reason=null)

- Refund a Payment

generateRefundPayment($trans_id,$refund_reason=null)

- Update a Consumer’s Login Info

generateUpdateCustomerLoginInfo($purchase_id,$new_username,$new_password)

- Change amount for some purchase

generateChangeAmountPayment($purchase_id, $new_price, $comment=null)

- Change a Recurring Bill Date

generateChangeRecurringBillDate($purchase_id,$days = 0)

- Insert Consumer Note

generateInsertConsumerNote($purchase_id,$note=null)

- Get Postback IP List

generateGetPostbackIPList()

- Blacklist an IP address (for a specific site)

generateBlacklistIpAddress($ip_address,$reason_code, $comment=null)

- Blacklist an Email address (for a specific site)

generateBlacklistEmailAddress($email_address,$reason_code,$comment=null)



##REPORTS URLs

- Transactions Purchases By URL

generateTransactionsPurchasesByURL($transaction_id,$start_date = null, $end_date = null)

- Assets Active Subscriptions By URL

generateAssetsActiveSubscriptionsByURL($purchase_id,$start_date = null, $end_date = null)

- Assets Active Subscriptions By URL and Rebill Date

generateAssetsActiveSubscriptionsByURL_RebillDate($purchase_id,$start_date = null, $end_date = null)

- Assets Cancelled Subscriptions By URL

generateAssetsCancelledSubscriptionsByURL($purchase_id,$start_date = null, $end_date = null)

- Pay Page Stats Hits By URL

generatePayPageStatsHitsByURL($start_date = null, $end_date = null)

- Pay Page Stats Hits By URL & Browser

generatePayPageStatsHitsByURL_Browser($start_date = null, $end_date = null)

- Pay Page Stats Hits By URL & Country

generatePayPageStatsHitsByURL_Country($start_date = null, $end_date = null)

- Pay Page Stats Hits By URL & Region

generatePayPageStatsHitsByURL_Region($start_date = null, $end_date = null)

- Revenue Daily Summary

generateGetListOfDeclinedPayment($start_date = null, $end_date = null)

- Revenue Hourly Signup Counts by URL

generateRevenueHourlySignupCounts_URL($start_date = null, $end_date = null)

- Revenue Hourly Signup by URL

generateRevenueHourlySignup_URL($start_date = null, $end_date = null)

- Revenue Summary by Source and URL

RevenueSummaryBySource_URL($start_date = null, $end_date = null)

- Revenue Summary by URL

generateRevenueSummaryByURL($start_date = null, $end_date = null)

- Transaction by Purchase ID

generateTransactionByPurchaseID($purchase_id)

- Transaction by Transaction ID

generateTransactionByTransID($transaction_id)

- Transactions List

generateTransactionsList($transaction_id,$start_date = null, $end_date = null)

- Get list of all declined payments between two days

generateTransactionsListDeclined($transaction_id,$start_date = null, $end_date = null)

- Get Merchant Fraud Emails

generateGetMerchantFraudEmails()

- Get Merchant Fraud IP Address

generateGetMerchantFraudIPAddress()

- URL Listing

generateURLListing()

- Validate User Access

generateValidateUserAccess()
 