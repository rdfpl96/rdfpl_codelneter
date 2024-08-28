<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
// $globle = get_instance(); 
/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| WARNING: You MUST set this value!
|
| If it is not set, then CodeIgniter will try to guess the protocol and
| path to your installation, but due to security concerns the hostname will
| be set to $_SERVER['SERVER_ADDR'] if available, or localhost otherwise.
| The auto-detection mechanism exists only for convenience during
| development and MUST NOT be used in production!
|
| If you need to allow multiple domains, remember that this file is still
| a PHP script and you can easily do that on your own.
|
*/
// $config['base_url'] = 'http://localhost:8081/royalDryfruit/';

//$config['base_url'] = 'http://localhost/rdfpl/';
$config['base_url'] = 'http://rdfpl.com/';

$config['mailUsername']='krishna009300@gmail.com';
$config['mailPassword']='bcsi ktsf hflg vogf';

//$config['mailUsername']='aarti25695@gmail.com';
//$config['mailPassword']='bcsi ktsf hflg vogf';

// $config['setFrom']='krishna009300@gmail.com';
$config['setFrom']='krishna009300@gmail.com'; // Ricever mail Id
$config['setFrom_bcc']='';


$config['rdfpl']='uat.rdfpl.com';
$config['googleLogin_ClientId']='1056734660196-3e4307l5grth3ga1uq6g8pcuflobir5o.apps.googleusercontent.com';
$config['googleLogin_ClientSecret']='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';
$config['googleLogin_RedirectUri']=$config['base_url'].'google-login-process';

// $config['sms_sender_id']='KLRHXA';
// define(KALEYRA_URL, 'https://api.kaleyra.io');
// define(KALEYRA_SID, 'HXIN1753249964IN');
// define(KALEYRA_SENDER_ID, 'MHLXMI');
// define(KALEYRA_API_KEY_ID, 'A9f51c41fa8133efa09a965803072a791');
// define(KALEYRA_TYPE, 'TXN');

// $config['KALEYRA_URL']='https://api.kaleyra.io';
// $config['KALEYRA_SID']='HXIN1753249964IN';
// $config['KALEYRA_SENDER_ID']='MHLXMI';
// $config['KALEYRA_API_KEY_ID']='A9f51c41fa8133efa09a965803072a791';
// $config['KALEYRA_TYPE']='TXN';

$config['KALEYRA_SMS_LOGIN_OTP']="Dear Customer, %OTP_VALUE% is your login OTP for Mahalaxmi website.";
$config['KALEYRA_SMS_SIGNUP']="Dear %CUSTOMER_NAME%, You have successfully registered in mahalaxmi foods.";
$config['KALEYRA_SMS_RECEIVED']="Hello %CUSTOMER_NAME%, Thank you, Your order %ORDER_NUMBER% has been received successfully from mahalaxmifoods website.";
$config['KALEYRA_SMS_CANCELLED']="Hello Customer, your order %ORDER_NUMBER% has been cancelled from mahalaxmifoods website.";

$config['KALEYRA_SMS_READY_TO_SHIP']="Hello %CUSTOMER_NAME%, Your order %ORDER_NUMBER% has been ready to ship successfully from mahalaxmifoods website.";

// $config['KALEYRA_SMS_SHIPPTED']="Hello %CUSTOMER_NAME%, Your order %ORDER_NUMBER% has been shipped successfully from mahalaxmifoods website.";

$config['KALEYRA_SMS_SHIPPTED']="Dear Patron, Your order %ORDER_NUMBER% has been shipped successfully from mahalaxmifoods website. Track Order %TRACK_ORDER_URL%";



$config['KALEYRA_SMS_DELIVERED']="Hello %CUSTOMER_NAME%, Your order %ORDER_NUMBER% has been delivered from mahalaxmifoods website.";

$config['KALEYRA_SMS_ONHOLD']="Hello %CUSTOMER_NAME%, Your order %ORDER_NUMBER% has been on hold from mahalaxmifoods website.";

// $massage='OTP Send '.$otp;

// ============Facebook Login====================================
$config['facebook_app_id']              = '2635361159962581';
$config['facebook_app_secret']          = 'f0da7080095324830f0ddeb2229d612b';
$config['facebook_graph_version']       = 'v2.10';


// $config['facebook_login_type']          = 'web';
// $config['facebook_login_redirect_url']  = 'facebook-login';
// $config['facebook_logout_redirect_url'] = 'facebook-login/logout';
// $config['facebook_permissions']         = array('email');
// // $config['facebook_graph_version']       = 'v2.6';
// $config['facebook_auth_on_load']        = TRUE;
// ============End Facebook Login====================================

// $this->config->item('orderFailedpayment_email_subject');

$config['orderReceived_email_subject']='Your order has been Received successfully';
$config['orderReceived_email_body_message']='Your order has been Received successfully';

$config['orderConfirm_email_subject']='Your order has been confirm successfully';
$config['orderConfirm_email_body_message']='Your order has been confirm successfully';

$config['orderReadytoship_email_subject']='Your order has been ready to ship successfully';
$config['orderReadytoship_email_body_message']='Your order has been ready to ship successfully';

$config['orderProcess_email_subject']='Your order has been processed';
$config['orderProcess_email_body_message']='Your order has been processed';

$config['ordershipped_email_subject']='Your order has been shipped';
$config['ordershipped_email_body_message']='Your order has been shipped';

$config['orderDelivered_email_subject']='Your order has been Delivered';
$config['orderDelivered_email_body_message']='Your order has been Delivered';

$config['orderOnHold_email_subject']='Your order has been on hold';
$config['orderOnHold_email_body_message']='Your order has been on hold';

$config['orderCanceled_email_subject']='Your order has been Canceled';
$config['orderCanceled_email_body_message']='Your order has been Canceled';

$config['orderFailedpayment_email_subject']='Your order has been Failed payment';
$config['orderFailedpayment_email_body_message']='Your order has been Failed payment';

$config['orderPending_email_subject']='Your order has been Pending successfully';
$config['orderPending_email_body_message']='Your order has been Pending successfully';

$config['orderPlaceFailed_subject']='Your order has been place failed';
$config['orderPlaceSuccess_subject']='Your order has been place successfully';



$config['YOUR_SALT_INSTAMOJO']='7d7bdc1d32514db0a44486aca5279aa7';



$config['pincode_not_found']='Sorry, we do not currently deliver to your area. Please enter a
different pincode or check back later.';

$config['not_found_customer_with_mobile']='Hey! We couldn\'t find an account with this phone number. Please sign up to create a new account and start shopping.';

$config['not_found_customer_with_email']='Hey! We couldn\'t find an account with this email. Please sign up to create a new account and start shopping.';

$config['account_has_not_activated']='<strong>Whoops!</strong> Your account has not activated. Please contact to administrator.';

$config['account_has_not_activated_api']='Whoops! Your account has not activated. Please contact to administrator.';

$config['customer_registering']='Thank you for registering. Your account has been created successfully.';

$config['email_already_register']='An account with this email address already exists. Please log in or use a different email address.';

$config['login_success']='Welcome back! You have been logged in successfully.';

$config['logout_success']='You have been logged out. Thank you for visiting our website.';

$config['added_cart_success']='The item has been added to your cart.';

$config['update_cart_success']='Your cart has been updated.';

$config['out_of_stock']='The item you selected is currently out of stock. Please check back late';

$config['invalid_coupon']='The coupon code you entered is invalid. Please enter a valid coupon code.';

$config['account_updated_success']='Your account information has been updated successfully.';

// $config['reset_password']='A link to reset your password has been sent to your email.';

// $this->config->item('reset_password');
/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'REQUEST_URI' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
| 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
| 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
|
| WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
*/
$config['uri_protocol']	= 'REQUEST_URI';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| https://codeigniter.com/userguide3/general/urls.html
|
| Note: This option is ignored for CLI requests.
*/
$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
| See http://php.net/htmlspecialchars for a list of supported charsets.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| https://codeigniter.com/userguide3/general/core_classes.html
| https://codeigniter.com/userguide3/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'MY_';

/*
|--------------------------------------------------------------------------
| Composer auto-loading
|--------------------------------------------------------------------------
|
| Enabling this setting will tell CodeIgniter to look for a Composer
| package auto-loader script in application/vendor/autoload.php.
|
|	$config['composer_autoload'] = TRUE;
|
| Or if you have your vendor/ directory located somewhere else, you
| can opt to set a specific path as well:
|
|	$config['composer_autoload'] = '/path/to/vendor/autoload.php';
|
| For more information about Composer, please visit http://getcomposer.org/
|
| Note: This will NOT disable or override the CodeIgniter-specific
|	autoloading (application/config/autoload.php)
*/
$config['composer_autoload'] = FALSE;

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| The configured value is actually a regular expression character group
| and it will be executed as: ! preg_match('/^[<permitted_uri_chars>]+$/i
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

/*
|--------------------------------------------------------------------------
| Allow $_GET array
|--------------------------------------------------------------------------
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['allow_get_array'] = TRUE;

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| You can also pass an array with threshold levels to show individual error types
|
| 	array(2) = Debug Messages, without Error Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 0;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ directory. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Log File Extension
|--------------------------------------------------------------------------
|
| The default filename extension for log files. The default 'php' allows for
| protecting the log files via basic scripting, when they are to be stored
| under a publicly accessible directory.
|
| Note: Leaving it blank will default to 'php'.
|
*/
$config['log_file_extension'] = '';

/*
|--------------------------------------------------------------------------
| Log File Permissions
|--------------------------------------------------------------------------
|
| The file system permissions to be applied on newly created log files.
|
| IMPORTANT: This MUST be an integer (no quotes) and you MUST use octal
|            integer notation (i.e. 0700, 0644, etc.)
*/
$config['log_file_permissions'] = 0644;

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Error Views Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/views/errors/ directory.  Use a full server path with trailing slash.
|
*/
$config['error_views_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/cache/ directory.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Include Query String
|--------------------------------------------------------------------------
|
| Whether to take the URL query string into consideration when generating
| output cache files. Valid options are:
|
|	FALSE      = Disabled
|	TRUE       = Enabled, take all query parameters into account.
|	             Please be aware that this may result in numerous cache
|	             files generated for the same page over and over again.
|	array('q') = Enabled, but only take into account the specified list
|	             of query parameters.
|
*/
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class, you must set an encryption key.
| See the user guide for more info.
|
| https://codeigniter.com/userguide3/libraries/encryption.html
|
*/
$config['encryption_key'] = '';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_driver'
|
|	The storage driver to use: files, database, redis, memcached
|
| 'sess_cookie_name'
|
|	The session cookie name, must contain only [0-9a-z_-] characters
|
| 'sess_samesite'
|
|	Session cookie SameSite attribute: Lax (default), Strict or None
|
| 'sess_expiration'
|
|	The number of SECONDS you want the session to last.
|	Setting to 0 (zero) means expire when the browser is closed.
|
| 'sess_save_path'
|
|	The location to save sessions to, driver dependent.
|
|	For the 'files' driver, it's a path to a writable directory.
|	WARNING: Only absolute paths are supported!
|
|	For the 'database' driver, it's a table name.
|	Please read up the manual for the format with other session drivers.
|
|	IMPORTANT: You are REQUIRED to set a valid save path!
|
| 'sess_match_ip'
|
|	Whether to match the user's IP address when reading the session data.
|
|	WARNING: If you're using the database driver, don't forget to update
|	         your session table's PRIMARY KEY when changing this setting.
|
| 'sess_time_to_update'
|
|	How many seconds between CI regenerating the session ID.
|
| 'sess_regenerate_destroy'
|
|	Whether to destroy session data associated with the old session ID
|	when auto-regenerating the session ID. When set to FALSE, the data
|	will be later deleted by the garbage collector.
|
| Other session cookie settings are shared with the rest of the application,
| except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
|
*/
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_samesite'] = 'Lax';
$config['sess_expiration'] = 32140800;
// $config['sess_expiration'] = 2700;

 $config['sess_save_path'] = NULL;
$config['sess_save_path'] = FCPATH.'ci_sessions';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix'   = Set a cookie name prefix if you need to avoid collisions
| 'cookie_domain'   = Set to .your-domain.com for site-wide cookies
| 'cookie_path'     = Typically will be a forward slash
| 'cookie_secure'   = Cookie will only be set if a secure HTTPS connection exists.
| 'cookie_httponly' = Cookie will only be accessible via HTTP(S) (no javascript)
| 'cookie_samesite' = Cookie's samesite attribute (Lax, Strict or None)
|
| Note: These settings (with the exception of 'cookie_prefix' and
|       'cookie_httponly') will also affect sessions.
|
*/
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;
$config['cookie_samesite'] 	= 'Lax';

/*
|--------------------------------------------------------------------------
| Standardize newlines
|--------------------------------------------------------------------------
|
| Determines whether to standardize newline characters in input data,
| meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['standardize_newlines'] = FALSE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['global_xss_filtering'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
| 'csrf_regenerate' = Regenerate token on every submission
| 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| Only used if zlib.output_compression is turned off in your php.ini.
| Please do not use it together with httpd-level output compression.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or any PHP supported timezone. This preference tells
| the system whether to use your server's local time as the master 'now'
| reference, or convert it to the configured one timezone. See the 'date
| helper' page of the user guide for information regarding date handling.
|
*/
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
| Note: You need to have eval() enabled for this to work.
|
*/
$config['rewrite_short_tags'] = FALSE;

/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy
| IP addresses from which CodeIgniter should trust headers such as
| HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
| the visitor's IP address.
|
| You can use both an array or a comma-separated list of proxy addresses,
| as well as specifying whole subnets. Here are a few examples:
|
| Comma-separated:	'10.0.1.200,192.168.5.0/24'
| Array:		array('10.0.1.200', '192.168.5.0/24')
*/
$config['proxy_ips'] = '';
// PDF Using
require('vendor/autoload.php');

// Razorpay Api
//require('razorpay-php/Razorpay.php');

//Google login API USING
include_once APPPATH . "libraries/vendor/autoload.php";

// Facebook 
require_once APPPATH . '/libraries/vendor/facebook/graph-sdk/src/Facebook/autoload.php';