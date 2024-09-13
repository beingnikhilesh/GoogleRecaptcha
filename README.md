# GoogleRecaptcha, beingnikhilesh/GoogleRecaptcha
A PHP Library to seamlessly make API Calls to the Google Recaptcha Service and verify if the User is a human or a Bot.


# What is Google Recaptcha
Google reCAPTCHA is a service that helps protect websites from spam and abuse by verifying whether a user is a human or a bot. It does this through a series of challenges that are easy for humans to solve but difficult for bots

# Features

- **Google reCAPTCHA v3 integration**
- **Configurable threshold score** for spam detection
- **Modular structure** for easy integration and customization

## Requirements

- PHP 7.4 or higher
- Composer
- Google reCAPTCHA API Keys (Secret & Site Key)
- Guzzle HTTP Client
## Installation

The recommended way to install this Library is through Composer

```bash
  composer require beingnikhilesh\GoogleRecaptcha
```
    
## Library Usage/Examples

1. Open the config.php file and Edit the Google Key and Google Secret as recieved from Google Recaptcha Site.

2. Use the following code to get Veridy if is Human or Robot
```php
use beingnikhilesh\GoogleRecaptcha\GoogleRecaptcha;

/**
* Pass the $token and $action to the Validate Function
* @$token Token received from POST Request
* @$action passed in View page and received via POST Request
*
* @ response    TRUE  - If request is Human
*               FALSE - If the request is ROBOT
*/  
$isValid = GoogleRecaptcha::_validate($token, $action);

/*
* Additionally if you want to Pass the Google Secret and Google Key Manually Everytime, you can do so as below
* @$googleSecret    Google Secret recieved from Google Recaptcha Site 
* @$googleKey       Google Key recieved from Google Recaptcha Site
*
* @return           NULL
*/
GoogleRecaptcha::credentials($googleSecret, $googleKey);
```

## How to Implement Google Recaptcha
For More Details how to implement Google Recaptcha

https://stevencotterill.com/articles/adding-google-recaptcha-v3-to-a-php-form
https://code.tutsplus.com/tutorials/example-of-how-to-add-google-recaptcha-v3-to-a-php-form--cms-33752 https://www.google.com/u/8/recaptcha/admin/site/
https://developers.google.com/recaptcha/docs/verify
https://developers.google.com/recaptcha/docs/v3
https://www.google.com/recaptcha/about/
## License

GoogleRecaptcha is made available under the MIT License ([MIT](https://choosealicense.com/licenses/mit/))

