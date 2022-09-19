<?php
 
// Initialize composer
require_once 'vendor/autoload.php';
 
// Composer autoloads Stripe library when first referenced.
 
// Set Stripe API key
 
 
// TODO: set these to your secret and publishable keys
 
$Config = [
	// Test Keys
// 	'secret_key' => 'sk_test_51Jpi3JJGWTrnqoGCJjNvo9ogubYtcQ6L2PMkrvjOzScnkkweB8K4bMCSUU4V862n5F2Jdne8ZXNXI15ML4bsYqcK0016XXRuYY',
// 	'publishable_key' => 'pk_test_51Jpi3JJGWTrnqoGCOmWFYMu1aYwMIibPPc9AHSu91Bf7v1HB0tGe18OVl21faG9ZiBGXLN1cAbNzxlRk6JydgQAu00J97DFGmp',

    // Live Keys	
 	'secret_key'=> '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',
 	'publishable_key'=> 'pk_live_51I988WH7Ga8GBcdemZMrmqS6KwWJDwazpRgO8Q39DMzOAxM8D16Js4yclgSnedDdt4CnMcIn92oZfcgOyE9KmvAU00znv7XLpS',
	'DB_HOST'=> 'localhost', 
	'DB_USERNAME'=> 'bfdhpzvq_sketchiconic' ,
	'DB_PASSWORD'=> 'M!mRa8M%eQlV' ,
	'DB_NAME'=> 'bfdhpzvq_sketchiconic',
];
 





function config($key) {
    global $Config;
    if (!isset($Config[$key])) die("Unknown configuration item '$key'");
    return $Config[$key];
}
 
\Stripe\Stripe::setApiKey(config('secret_key'));