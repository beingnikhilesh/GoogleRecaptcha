<?php
namespace beingnikhilesh\GoogleRecaptcha;

use beingnikhilesh\GoogleRecaptcha\Config;
/*
 * Google Recaptcha Library
 */

//Guzzle Http for WebCalls
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class GoogleRecaptcha
{

    //https://stevencotterill.com/articles/adding-google-recaptcha-v3-to-a-php-form
    //https://code.tutsplus.com/tutorials/example-of-how-to-add-google-recaptcha-v3-to-a-php-form--cms-33752
    //Login: https://www.google.com/u/8/recaptcha/admin/site/
    //https://developers.google.com/recaptcha/docs/verify
    //https://developers.google.com/recaptcha/docs/v3
    //https://www.google.com/recaptcha/about/

    const CLASSNAME = 'beingnikhilesh\GoogleRecaptcha';

    #############################################################################################
    #   Global Variables
    #############################################################################################

    # Google Recaptcha URL
    private static $googleCaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    # Config Instance
    private static Config $config;

    /** Public Static function to set the Google Credentials Manually */
    public static function credentials(string $googleSecret = '', string $googleKey = '', string|float $thresholdScore = '')
    {
        self::$config = new Config($googleSecret, $googleKey, $thresholdScore);
    }

    static function _validate(string $token = '', string $action = '')
    {
        if (empty(self::$config))
            self::$config = new Config();

        //Check if Library is Enabled
        if (!self::$config->is_enabled())
            return false;
        //Check if the Google Secret and Key are set
         if (empty($googleSecret) || empty($googleKey)) {
            return \beingnikhilesh\error\Error::set_error('Google Recaptcha: Secret key or Site key is missing. Please check your configuration.', self::CLASSNAME);
            }
    
        # Check if the required inputs are present
        if (empty($token) or empty($action))
            return \beingnikhilesh\error\Error::set_error('Google Recaptcha: Invalid Recaptcha Validation Inputs Set', self::CLASSNAME);

        # Make a Call to Google Recaptcha, Get the Guzzle Instance
        $httpClient = new Client();
        try {
            $response = $httpClient->post(self::$googleCaptchaUrl, ['form_params' => ['secret' => self::$config->getGoogleSecret(), 'response' => $token]]);
            if (200 == $response->getStatusCode()) {
                //Verify the Captcha
                $arrResponse = json_decode($response->getBody()->getContents(), true);
                if ($arrResponse["success"] == 1) {
                    # Its a successfull response, check the Score
                    if ($arrResponse["action"] == $action and $arrResponse["score"] >= self::$config->getThresholdScore())
                     return TRUE;
                }

                # There is some Error in the Response, return Error
                return \beingnikhilesh\error\Error::set_error('Google Recaptcha: We think you\'re a Spam. Contact the Administrator if you think this is Wrong.', self::CLASSNAME);
            }
        } catch (RequestException $e) {
            return \beingnikhilesh\error\Error::set_error('Google Recaptcha: We were not Able to Verify your Authenticity on Google Recaptcha. Pls Try Again.<br />Contact the Administrator if the Error Persists for a long time.', self::CLASSNAME);
        }
    }
}
