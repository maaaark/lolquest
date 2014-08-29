<?php
class PaypalPaymentController extends BaseController {

    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    /**
     * Set the ClientId and the ClientSecret.
     * @param 
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId='AYAAcRBK6Fivpn4zJDjuG0bBCNe4KdxkF4ujv-lvr3re9sJ18S_fY3QbjG3v';
    private $_ClientSecret='EEiKGBDatUIVS5OTIlHD3f3D1TD539vIxFalUY_snRDOApS1acqEkXo6KWXS';

    /*
     *   These construct set the SDK configuration dynamiclly, 
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {
        // ### Api Context
        // Pass in a `ApiContext` object to authenticate 
        // the call. You can also send a unique request id 
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly. 

        $this->_apiContext = Paypalpayment:: ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );

        // dynamic configuration instead of using sdk_config.ini

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path().'/logs/PayPal.log',
            'log.LogLevel' => 'FINE'
        ));

    }
	
	
	 /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::Address();
        $addr->setLine1("3909 Witmer Road");
        $addr->setLine2("Niagara Falls");
        $addr->setCity("Niagara Falls");
        $addr->setState("NY");
        $addr->setPostal_code("14305");
        $addr->setCountry_code("US");
        $addr->setPhone("716-298-1822");

        // ### CreditCard
        // A resource representing a credit card that can be
        // used to fund a payment.
        $card = Paypalpayment::CreditCard();
        $card->setType("visa");
        $card->setNumber("4417119669820331");
        $card->setExpire_month("11");
        $card->setExpire_year("2019");
        $card->setCvv2("012");
        $card->setFirst_name("Anouar");
        $card->setLast_name("Abdessalam");
        $card->setBilling_address($addr);

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::FundingInstrument();
        $fi->setCredit_card($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("credit_card");
        $payer->setFunding_instruments(array($fi));

        // ### Amount
        // Let's you specify a payment amount.
        $amount = Paypalpayment:: Amount();
        $amount->setCurrency("USD");
        $amount->setTotal("1.00");

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types
        $transaction = Paypalpayment:: Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("This is the payment description.");

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        $payment = Paypalpayment:: Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        // ### Create Payment
        // Create a payment by posting to the APIService
        // using a valid ApiContext
        // The return object contains the status;
        try {
            $payment->create($this->_apiContext);
        } catch (\PPConnectionException $ex) {
            return "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());
            exit(1);
        }

        $response=$payment->toArray();

        echo"<pre>";
        print_r($response);

        //var_dump($payment->getId());

        //print_r($payment->toArray());//$payment->toJson();
    }  
	
	
	
	
	/*
        Use this call to get a list of payments. 
        url:payment/
    */
    public function Index(){
			
		$cred = Paypalpayment::OAuthTokenCredential('AYAAcRBK6Fivpn4zJDjuG0bBCNe4KdxkF4ujv-lvr3re9sJ18S_fY3QbjG3v','EEiKGBDatUIVS5OTIlHD3f3D1TD539vIxFalUY_snRDOApS1acqEkXo6KWXS');
			
        // ### Payer
        // A resource representing a Payer that funds a payment

        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("paypal");

        // ### Amount
        // Let's you specify a payment amount.
        $amount = Paypalpayment::Amount();
        $amount->setCurrency("USD");
        $amount->setTotal("1.00");

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types
        $transaction = Paypalpayment::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("This is the payment description.");

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        $baseUrl = "/payment";
        $redirectUrls = Paypalpayment::RedirectUrls();
        $redirectUrls->setReturn_url("$baseUrl/executepaymentsuccess");
        $redirectUrls->setCancel_url("$baseUrl/executepaymentcancel");

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        $payment = Paypalpayment::Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setRedirect_urls($redirectUrls);
        $payment->setTransactions(array($transaction));

        // ### Api Context
        // Pass in a `ApiContext` object to authenticate 
        // the call and to send a unique request id 
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly. 
        $apiContext = Paypalpayment::ApiContext($cred, 'Request' . time());

        // ### Create Payment
        // Create a payment by posting to the APIService
        // using a valid apiContext
        // The return object contains the status and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($apiContext);
        } catch (\PPConnectionException $ex) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());    
            exit(1);
        }

        // ### Redirect buyer to paypal
        // Retrieve buyer approval url from the `payment` object.
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
            }
        }
        // It is not really a great idea to store the payment id
        // in the session. In a real world app, please store the
        // payment id in a database.
        $_SESSION['paymentId'] = $payment->getId();
            if(isset($redirectUrl)) {
                header("Location: $redirectUrl");
                exit;
            }
    }
	
	
	/*
        Use this call to get details about payments that have not completed, 
        such as payments that are created and approved, or if a payment has failed.
        url:payment/PAY-3B7201824D767003LKHZSVOA
    */

    public function show($payment_id)
    {
       $payment = Paypalpayment::get($payment_id,$this->_apiContext);

       echo "<pre>";

       print_r($payment);
    }
	
	public function ExecutePaymentSuccess(){

    // ### Api Context
    // Pass in a `ApiContext` object to authenticate 
    // the call and to send a unique request id 
    // (that ensures idempotency). The SDK generates
    // a request id if you do not pass one explicitly. 
    $apiContext = Paypalpayment:: ApiContext($cred);
    
    // Get the payment Object by passing paymentId
    // payment id was previously stored in session
    $paymentId = $_SESSION['paymentId'];
    $payment = Paypalpayment::getPayment($paymentId);
    
    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = Paypalpayment:: PaymentExecution();
    $execution->setPayer_id($_GET['PayerID']);
    
    //Execute the payment
    $payment->execute($execution, $apiContext);

    echo "<pre>";
    var_dump($payment->toArray());
    }
	
	
	public function ExecutePaymentCancel(){
        return "User cancelled payment.";
    }
	

}