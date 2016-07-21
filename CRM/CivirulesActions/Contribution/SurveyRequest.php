<?php


Class CRM_CivirulesActions_Contribution_SurveyRequest extends CRM_Civirules_Action {


    public static $contributionData;
    public static $params;


    public function getExtraDataInputUrl($ruleActionId) {
        return FALSE;
    }

    /**
     * method used to collect the data from the entity and stores in the $contributionDetail property
     * @param CRM_Civirules_TriggerData_TriggerData $triggerData
     *
     */

    public function processAction(CRM_Civirules_TriggerData_TriggerData $triggerData){

       $contributionDetails = $triggerData->getEntityData('Contribution');

//        we see the object content at debug mode
//
//        CRM_Core_Error::debug('this is what the object has', $contributionDetails);
//        exit();

        // we now have to make an api call to have the email and contact info of the contact id in contribution data
        // display_name and email

        $displayName = civicrm_api3('Contact', 'getsingle', array(
            'id' => $contributionDetails['contact_id'],
            'return' => 'display_name'));

        $email = civicrm_api3('Contact', 'getsingle', array(
            'id' => $contributionDetails['contact_id'],
            'return' => 'email'));

        //We now constitute the array to hold the contribution data

        self::$contributionData =  array(

            'id' => $contributionDetails['id'],
            'contact_id ' => $contributionDetails['contact_id'],
            'total_amount' => $contributionDetails['total_amount'],
            'receive_date' => $contributionDetails['receive_date'],
            'currency' => $contributionDetails['currency'],
            'display_name' => $displayName,
            'email' => $email

        );


        //we have to format the data and then call the api submit method of the Zapier entity
        // like so civicrm_api3('Zapier', 'submit', $yourData)


        /**
         * Remember that the $contributionData will hold the data we want to send ....
         */

    }

    // we now return the contribution details for usage by the generic Zapier class

    /**
     * @return $contributionData
     */
    public static function getContributionData()
    {
        return self::$contributionData;
    }


}
