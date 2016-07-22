<?php

require('/CRM/CivicrmZapier/Zapier.php');

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

        public static $hookUrl = "https://zapier.com/hooks/catch/1212097/u90dpo/";
        public static $userAuth ='api_key';
        public static $action ="POST";
        public static $userAuthValue="T3KxLDWdkJtND3P9";
        public static $timeOut=30;

        public static $requestContent;



    /**
     *  Sends a survey which is a request
     *
     */

    public function sendSurvey(){

        //we set the request content before we do the configuration

        self::$requestContent = CRM_CivirulesActions_Contribution_SurveyRequest::getContributionData();

        // we call the parent config function to configure webhook

        parent::config(self::$hookUrl,self::$userAuth , self::$userAuthValue , self::$timeOut , self::$action , self::$requestContent);


        //we send the request by calling the Zapier funtion sendRequest which uses curl

       // parent::sendRequest();



    }



}


