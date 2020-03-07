<?php
/** set your paypal credential **/

// Sandbox
// $config['client_id'] = 'AVRr0N1oCGmpZc7ond_yAzYdwyJWnAFOU2aWtIbNz2N5L9_POrDfmCbYxAqJi7RRuLEVgQ8yULMDspbP';
// $config['secret'] = 'ENRSkmZ9BV6YNfRolxOIbU3YWVckK9N6pJ22UreFo7ix74qkDVnyD1C5ZCa22aZE3Reg5sltatGbTFVR';

$config['client_id'] = 'ARqQGM8C0CLqYsHnACoJJ-RhsCvmSXm1OUdbMuSXqDyrVYtoX8rE7GZEnrJcRBFVIKNawaHKTWW3mQYR';
$config['secret'] = 'EAHfGHrMGX8m8UNhIIIQBsYUUltxDa_6RWs-BNP5NhwMo7iNL9DzaiO1tiAwyz3qWdPqMdvT9jHTTEmG';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    // 'mode' => 'sandbox',
    'mode' => 'live',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);

// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------

// PayPal environment, Sandbox or Live
$config['sandbox'] = FALSE; // FALSE for live environment

// PayPal business email
$config['business'] = 'maheshmukati07@gmail.com';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';

// Where is the button located at?
$config['paypal_lib_button_path'] = 'assets/images/';

// If (and where) to log ipn response in a file
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';