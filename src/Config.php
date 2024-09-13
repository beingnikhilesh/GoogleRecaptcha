<?php

namespace beingnikhilesh\GoogleRecaptcha;

class Config
{
    private $config = [
        # Is the Library Enabled
        'enabled' => TRUE,

        # Settings to store Google Authentications
        'settings' => [
            'google_secret' => '', # Insert Google Secret Here
            'google_key' => '', # Insert Google Key Here
        ],

        # Minimum Threshold Score
        'threshold_score' => 0.5
    ];

    /** Construct Function */
    public function __construct(string $googleSecret = '', string $googleKey = '', string|float $thresholdScore = '')
    {
        # Set the Credentials
        $this->set($googleSecret, $googleKey, $thresholdScore);
    }

    /** Public function to Set the Credentials and Settings Manually */
    public function set(string $googleSecret = '', string $googleKey = '', string|float $thresholdScore = '')
    {   //echoALl(func_get_args());
        # Set the Credentials, if passed
        if (!empty($googleSecret) and !empty($googleKey))
            $this->config['settings'] = [
                'google_secret' => $googleSecret,
                'google_key' => $googleKey,
            ];

        # Set the Threshold Score if Set and within bounds
        if (!empty($thresholdScore) and is_float($thresholdScore) and $thresholdScore > 0 and $thresholdScore <= 1)
            $this->config['threshold_score'] = $thresholdScore;
    }

    /** Public function to get all Google Credentials */
    public function get()
    {
        return $this->config['settings'];
    }

    /** Function to get the Google Key */
    public static function getGoogleKey()
    {
        return (new static())->config['settings']['google_key'];
    }

    /** Private static function to get the Google Secret String */
    public function getGoogleSecret()
    {
        return (new static())->config['settings']['google_secret'] ;
    }

    /** Public Static Function to get the Minimum Threshold Score */
    public static function getThresholdScore()
    {
        return (new static())->config['threshold_score'] ;
    }
    /** Public function to check if Library is enabled */
    public function is_enabled()
    {
        return $this->config['enabled'];
    }
}
