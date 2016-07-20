<?php

/**
*  $this -> userAuth = "api_key";
$this -> $userAuthValue = "T3KxLDWdkJtND3P9";
$this -> timeOut  = 30;

// we set the default action to post unless otherwise specified then we reconfigure the action with the others

$this -> action = "POST";
*/

class CRM_Zapiercivicrm_Survey extends CRM_Zapiercivicrm_Zapier{


//    public static $tresholdAmount;
//    public $receiverEmail;
//    public static $surveyData;
//    public $surveyName;
    public static $hookUrl = "";
    public $surveyName;


    /**
     * Method setup the webhook url
     *
     * @param  $
     * @return string $zapierUrlKey
     * @access public
     * @static
     */
    public static function setUpWebhook($url){

        // this function makes available the data for CURL to use for requests

        self::$hookUrl = $url;


    }


    //we will get the con tribution details here!!





}


