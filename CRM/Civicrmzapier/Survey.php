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
    function __construct()
    {
        parent::$hookUrl = "https://zapier.com/hooks/catch/1212097/u90dpo/";
        parent::$action ="POST";
        parent::$userAuthValue="T3KxLDWdkJtND3P9";
        parent::$timeOut=30;
        parent::$requestContent = CRM_CivirulesActions_Contribution_SurveyRequest::getContributionDetails();

    }

    /**
     *  Sends a survey which is a request
     *
     */

    public function sendSurvey(){

        // we call the parent config function to configure webhook


        //we send the request





    }



}


