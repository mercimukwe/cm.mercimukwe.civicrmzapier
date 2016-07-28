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

     protected  $hookUrl ;
     protected  $userAuth;
     protected  $userAuthValue ;
     protected  $timeOut ;
     protected  $action ;    // this will vary based on the request
     protected  $requestContent;   // result from out api call will be placed here (json)

    // will hold the response of the curl request and the error

    protected  $overallResponse;
    protected  $requestError;

 /**
   * Method Do necessary Configurations
   *
   * @param   
   * @return object $_singleton
   * @access public
   * @static
   */

	public function config($hookURL ,$userAUTH , $userAuthVALUE , $timeOUT ){

        $this->hookUrl = $hookURL;
        $this->userAuth =$userAUTH;
        $this->userAuthValue = $userAuthVALUE;
        $this->timeOut = $timeOUT;

    }


	 /**
   * Method send Request to Zapier From CiviCRM
   *
   * @param  $params || array object 
   * @return string $message 
   * @access public
   * @static
   */
	public function sendRequest($requestCONT){

//	    // this is where the request is sent using curl
//
//        //we get the curl resource by initializing the request
//
        $curl = curl_init();


//
//        switch (self::$action){
//
//            case 'POST':
//                $requestType = 1;
//                break;
//
//            case 'GET':
//                break;
//
//            default:
//                $requestType = 1;
//                break;
//        }
        //Set some options - we are also passing the useragent string of the request here

        curl_setopt_array($curl ,array(

                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->hookUrl,
                CURLOPT_USERAGENT =>$this->userAuth,
                CURLOPT_POST => 1,
                CURLOPT_TIMEOUT => $this->timeOut,
                CURLOPT_USERPWD => $this->userAuthValue,
                CURLOPT_POSTFIELDS => $requestCONT

            )
        );


        // we send the request and save the response in $response to be used by receiveResponse function
        $response = curl_exec($curl);

        CRM_Core_Error::debug('return values in Zapier class ', $requestCONT);


        if(!curl_exec($curl)){

           $this->overallResponse = 'error';

        }else{

            $this->overallResponse = 'success';
        }

            $this->requestError = curl_error($curl);

       // CRM_Core_Error::debug('curl error in Zapier class ', $this->requestError);


        return $requestCONT;
	}

		 /**
   * Method to recieve response from Zapier webhook sent data
   *
   * @param   
   * @return string $returnStatus 
   * @access public
   * @static
   */
	public function receiveResponse(){

	    //here we receive the response and then we could make it available for confirmation

        $session = CRM_Core_Session::singleton();

        // depending on the nature of the curl response we output the response status

        switch ($this->overallResponse){

            case 'error':

                $session->setStatus('Request Failed Please Check extension Error ',$this->requestError. 'Zapier Request', 'error');
                break;

            case 'success':
                $session->setStatus('Request Sent To Zapier Successfully', 'Zapier Request', 'success');
                break;

            default:
                break;

        }

	}

    /**
     * @param mixed $hookUrl
     */
    public function setHookUrl($hookUrl)
    {
        $this->hookUrl = $hookUrl;
    }

    /**
     * @param mixed $userAuth
     */
    public function setUserAuth($userAuth)
    {
        $this->userAuth = $userAuth;
    }

    /**
     * @param mixed $userAuthValue
     */
    public  function setUserAuthValue($userAuthValue)
    {
        $this->userAuthValue = $userAuthValue;
    }

    /**
     * @param mixed $timeOut
     */
    public function setTimeOut($timeOut)
    {
        $this->$timeOut = $timeOut;
    }

    /**
     * @param mixed $action
     */
    public  function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param mixed $requestContent
     */
    public function setRequestContent($requestContent)
    {
        $this->requestContent = $requestContent;
    }

    /**
     * @param mixed $overallResponse
     */
    public function setOverallResponse($overallResponse)
    {
        $this->overallResponse = $overallResponse;
    }

    /**
     * @param mixed $requestError
     */
    public  function setRequestError($requestError)
    {
        $this->requestError = $requestError;
    }



}

