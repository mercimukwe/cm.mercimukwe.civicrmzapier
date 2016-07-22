<?php

/**
* Class Which deals with Zapier on a Generic Level
* @author Merci M.
* @license AGPL-V3.0
*/

class CRM_Zapiercivicrm_Zapier{

    /**
     * This class provides a generic level of allcommunications between CiviCRM and Zapier
     *  that is sending and receiving data using the webhook
     */

    public static $hookUrl ;
    public static $userAuth;
    public static $userAuthValue ;
    public static $timeOut ;
    public static $action ;    // this will vary based on the request
    public static $requestContent;   // result from out api call will be placed here (json)

    // will hold the response of the curl request and the error

    public static $overallResponse;
    public static $requestError;

 /**
   * Method Do necessary Configurations
   *
   * @param   
   * @return object $_singleton
   * @access public
   * @static
   */

	public static function config($hookUrl ,$userAuth , $userAuthValue , $timeOut , $action, $requestContent){

        self::setHookUrl($hookUrl);
        self::setUserAuth($userAuth);
        self::setUserAuthValue($userAuthValue);
        self::setTimeOut($timeOut);
        self::setAction($action);
        self::setRequestContent($requestContent);

    }


	 /**
   * Method send Request to Zapier From CiviCRM
   *
   * @param  $params || array object 
   * @return string $message 
   * @access public
   * @static
   */
	public static function sendRequest($requestType){

	    // this is where the request is sent using curl

        //we get the curl resource by initializing the request

        $curl = curl_init();

        switch (self::$action){

            case 'POST':
                $requestType = 1;
                break;

            case 'GET':
                break;

            default:
                $requestType = 1;
                break;
        }
        //Set some options - we are also passing the useragent string of the request here

        curl_setopt_array($curl ,array(

                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => self::$hookUrl,
                CURLOPT_USERAGENT =>self::$userAuth,
                CURLOPT_POST => $requestType,
                CURLOPT_TIMEOUT => self::$timeOut,
                CURLOPT_USERPWD => self::$userAuthValue,
                CURLOPT_POSTFIELDS => self::$requestContent

            )
        );

        // we send the request and save the response in $response to be used by receiveResponse function
        $response = curl_exec($curl);

        if(!curl_exec($curl)){

           self::$overallResponse = 'error';

        }else{

            self::$overallResponse = 'success';
        }

        self::$requestError = curl_error($curl);
	}

		 /**
   * Method to recieve response from Zapier webhook sent data
   *
   * @param   
   * @return string $returnStatus 
   * @access public
   * @static
   */
	public static function receiveResponse(){

	    //here we receive the response and then we could make it available for confirmation

        $session = CRM_Core_Session::singleton();

        switch (self::$overallResponse){

            case 'error':

                $session->setStatus('Request Failed Please Check extension Error ',self::$requestError. 'Zapier Request', 'error');
                break;

            case 'success':
                $session->setStatus('Request Sent Successfully', 'Zapier Request', 'success');
                break;

            default:
                break;

        }

	}


    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        self::$action = $action;
    }

    /**
     * @param mixed $hookUrl
     */
    public static function setHookUrl($hookUrl)
    {
        self::$hookUrl = $hookUrl;
    }

    /**
     * @param mixed $requestContent
     */
    public static function setRequestContent($requestContent)
    {
        // we get the contribution details from entity and set it

        self::$requestContent = $requestContent;

    }

    /**
     * @param mixed $timeOut
     */
    public static function setTimeOut($timeOut)
    {
        self::$timeOut = $timeOut;
    }

    /**
     * @param mixed $userAuth
     */
    public static function setUserAuth($userAuth)
    {
        self::$userAuth = $userAuth;
    }

    /**
     * @param mixed $userAuthValue
     */
    public static function setUserAuthValue($userAuthValue)
    {
        self::$userAuthValue = $userAuthValue;
    }


}

