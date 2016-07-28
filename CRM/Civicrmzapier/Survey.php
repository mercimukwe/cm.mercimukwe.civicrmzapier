<?php

require('Zapier.php');

/**
*  $this -> userAuth = "api_key";
$this -> $userAuthValue = "T3KxLDWdkJtND3P9";
$this -> timeOut  = 30;

// we set the default action to post unless otherwise specified then we reconfigure the action with the others

$this -> action = "POST";
*/

class CRM_Zapiercivicrm_Survey extends CRM_Zapiercivicrm_Zapier{

    /** Sets all the parent fields which we have to use for our request
     *
     * CRM_Zapiercivicrm_Survey constructor.
     */

        protected $hookUrl = "https://zapier.com/hooks/catch/1212097/u90dpo/";
        protected $userAuth ='api_key';
        protected $action ="POST";
        protected $userAuthValue="T3KxLDWdkJtND3P9";
        protected $timeOut=30;


    /**
     *  Sends a survey which is a request
     *
     */

    public static function sendSurvey($parameters){

        //we set the request content before we do the configuration

       // self::$requestContent = CRM_CivirulesActions_Contribution_SurveyRequest::getContributionData();

        // we call the parent config function to configure webhook



//        //we send the request by calling the Zapier funtion sendRequest which uses curl
//
        parent::sendRequest($parameters);


        //we mow get the respomse of the request

    //    parent::receiveResponse();


        // we will returnt the request content to the calling API method
       // return self::$requestContent;

        return $parameters;

    }



}


