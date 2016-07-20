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
	public static function sendRequest(){

	    // this is where the request is sent using curl


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

