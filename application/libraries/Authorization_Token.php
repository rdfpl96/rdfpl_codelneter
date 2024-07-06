<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   Authorization_Token
* -------------------------------------------------------------------
* API Token Check and Generate
*
* @author: Jeevan Lal
* @version: 0.0.5
*/


require_once APPPATH . 'third_party/php-jwt/JWT.php';
require_once APPPATH . 'third_party/php-jwt/BeforeValidException.php';
require_once APPPATH . 'third_party/php-jwt/ExpiredException.php';
require_once APPPATH . 'third_party/php-jwt/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

class Authorization_Token 
{
    /**
     * Token Key
     */
    protected $token_key;

    /**
     * Token algorithm
     */
    protected $token_algorithm;

    /**
     * Request Header Name
     */
    protected $token_header = ['authorization','Authorization'];

    /**
     * Token Expire Time
     * ----------------------
     * ( 1 Day ) : 60 * 60 * 24 = 86400
     * ( 1 Hour ) : 60 * 60     = 3600
     */
    protected $token_expire_time = 86400; 


    public function __construct()
	{
        $this->CI =& get_instance();

        /** 
         * jwt config file load
         */
        $this->CI->load->config('jwt');

        /**
         * Load Config Items Values 
         */
        $this->token_key        = $this->CI->config->item('jwt_key');
        $this->token_algorithm  = $this->CI->config->item('jwt_algorithm');

        $this->CI->load->model('api/login_model','login');
    }

    /**
     * Generate Token
     * @param: user data
     */
    public function generateToken($data)
    {
        try {
            return JWT::encode($data, $this->token_key, $this->token_algorithm);
        }
        catch(Exception $e) {
            return 'Message: ' .$e->getMessage();
        }
    }

    /**
     * Validate Token with Header
     * @return : user informations
     */
    public function validateToken()
    {
        /**
         * Request All Headers
         */
        $headers = $this->CI->input->request_headers();

        
        /**
         * Authorization Header Exists
         */
        $token_data = $this->tokenIsExist($headers);
        
        if($token_data['status'] === 0)
        {   
           
            try
            {
                /**
                 * Token Decode
                 */
                try {
                    $token_decode = JWT::decode($headers[$token_data['key']], $this->token_key, array($this->token_algorithm));
                    
                    // print_r($headers[$token_data['key']]);
                    // exit();

                }
                catch(Exception $e) {

                    return ['status' => 1, 'message' => $e->getMessage()];
                }

                if(!empty($token_decode) AND is_object($token_decode))
                {
                    // Check User ID (exists and numeric)
                    //if(empty($token_decode->user_id) OR !is_numeric($token_decode->user_id))
                    if(empty($token_decode->customer_id) OR !ctype_alnum($token_decode->customer_id))  
                    {
                        return ['status' => 1, 'message' => 'User ID Not Define!'];

                    // Check Token Time
                    }
                    else if(!$this->CI->login->chkUserExist($token_decode->customer_id)) {
                        
                        return ['status' => -1, 'message' => 'Your are not registered.'];
                    }
                    else if(!$this->CI->login->chkUserActive($token_decode->customer_id)) {
                        
                        return ['status' => -1, 'message' => 'Your account is inactive. Please contact the support team.'];
                    }
                    else if(empty($token_decode->time OR !is_numeric($token_decode->time))) {
                        
                        return ['status' => 1, 'message' => 'Token Time Not Define!'];
                    }
                    else
                    {
                        /**
                         * Check Token Time Valid 
                         */
                        $time_difference = strtotime('now') - $token_decode->time;
                        
                        if( $time_difference >= $this->token_expire_time )
                        {
                            return ['status' => 1, 'message' => 'Token Time Expire.'];

                        }else
                        {
                            /**
                             * All Validation 1 Return Data
                             */
                            return ['status' => 0, 'data' => $token_decode];
                        }
                    }
                    
                }else{
                    return ['status' => 1, 'message' => 'Forbidden'];
                }
            }
            catch(Exception $e) {
                return ['status' => 1, 'message' => $e->getMessage()];
            }
        }else
        {

            // Authorization Header Not Found!
            return ['status' => 1, 'message' => $token_data['message'] ];
        }
    }

    /**
     * Validate Token with POST Request
     */
    public function validateTokenPost()
    {
        if(isset($_POST['token']))
        {
            $token = $this->CI->input->post('token', 0);
            if(!empty($token) AND is_string($token) AND !is_array($token))
            {
                try
                {
                    /**
                     * Token Decode
                     */
                    try {
                        $token_decode = JWT::decode($token, $this->token_key, array($this->token_algorithm));
                    }
                    catch(Exception $e) {
                        return ['status' => 1, 'message' => $e->getMessage()];
                    }
    
                    if(!empty($token_decode) AND is_object($token_decode))
                    {
                        // Check User ID (exists and numeric)
                        if(empty($token_decode->id) OR !is_numeric($token_decode->id)) 
                        {
                            return ['status' => 1, 'message' => 'User ID Not Define!'];
    
                        // Check Token Time
                        }else if(empty($token_decode->time OR !is_numeric($token_decode->time))) {
                            
                            return ['status' => 1, 'message' => 'Token Time Not Define!'];
                        }
                        else
                        {
                            /**
                             * Check Token Time Valid 
                             */
                            $time_difference = strtotime('now') - $token_decode->time;
                            if( $time_difference >= $this->token_expire_time )
                            {
                                return ['status' => 1, 'message' => 'Token Time Expire.'];
    
                            }else
                            {
                                /**
                                 * All Validation 1 Return Data
                                 */
                                return ['status' => 0, 'data' => $token_decode];
                            }
                        }
                        
                    }else{
                        return ['status' => 1, 'message' => 'Forbidden'];
                    }
                }
                catch(Exception $e) {
                    return ['status' => 1, 'message' => $e->getMessage()];
                }
            }else
            {
                return ['status' => 1, 'message' => 'Token is not defined.' ];
            }
        } else {
            return ['status' => 1, 'message' => 'Token is not defined.'];
        }
    }

    /**
     * Token Header Check
     * @param: request headers
     */
    public function tokenIsExist($headers)
    {
        if(!empty($headers) AND is_array($headers)) {
            foreach ($this->token_header as $key) {
                if (array_key_exists($key, $headers) AND !empty($key))
                    return ['status' => 0, 'key' => $key];
            }
        }
        return ['status' => 1, 'message' => 'Token is not defined.'];
    }

    /**
     * Fetch User Data
     * -----------------
     * @param: token
     * @return: user_data
     */
    public function userData()
    {
        /**
         * Request All Headers
         */
        $headers = $this->CI->input->request_headers();

        /**
         * Authorization Header Exists
         */
        $token_data = $this->tokenIsExist($headers);
        if($token_data['status'] === 0)
        {
            try
            {
                /**
                 * Token Decode
                 */
                try {
                    $token_decode = JWT::decode($headers[$token_data['key']], $this->token_key, array($this->token_algorithm));
                }
                catch(Exception $e) {
                    return ['status' => 1, 'message' => $e->getMessage()];
                }

                if(!empty($token_decode) AND is_object($token_decode))
                {
                    return $token_decode;
                }else{
                    return ['status' => 1, 'message' => 'Forbidden'];
                }
            }
            catch(Exception $e) {
                return ['status' => 1, 'message' => $e->getMessage()];
            }
        }else
        {
            // Authorization Header Not Found!
            return ['status' => 1, 'message' => $token_data['message'] ];
        }
    }
}