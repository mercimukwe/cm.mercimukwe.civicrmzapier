<?php


Class CRM_CivirulesActions_Contribution_SurveyRequest extends CRM_Civirules_Action {



    public static $params;
    public static $zapierApiCallResult;


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
//--------------------   DEBUG ---------------------------------
      // CRM_Core_Error::debug('this is what the object has', $contributionDetails);


        // we now have to make an api call to have the email and contact info of the contact id in contribution data
        // display_name and email

        try {

            $contact = civicrm_api3('Contact', 'getsingle', array(
                'id' => $contributionDetails['contact_id']));
            //-------------DEBUG----------------------------------------
           // CRM_Core_Error::debug('the contat info is ', $contact);
           // exit();

        } catch (CiviCRM_API3_Exception $ex) {

            throw new Exception('Could not obtain the contact details display_name and email '.__METHOD__
            .', contact your system administrator. Error message from API Contact getsingle: '.$ex->getMessage());
        }


        //We now constitute the array to hold the contribution data

        $contibutoinInfo =  array(

            'id' => $contributionDetails['id'],
            'contact_id ' => $contributionDetails['contact_id'],
            'total_amount' => $contributionDetails['total_amount'],
            'receive_date' => $contributionDetails['receive_date'],
            'currency' => $contributionDetails['currency'],
            'display_name' => $contact['display_name'],
            'email' => $contact['email']

        );

        //--------------------- DEBUG ----------------------------------
       // CRM_Core_Error::debug('this is what the object has', self::$contributionData);
       // exit();



        //we have to format the data and then call the api submit method of the Zapier entity
        // like so civicrm_api3('Zapier', 'submit',$contributionData )

        try{

//            CRM_Core_Error::debug('this is what the object has ', $contibutoinInfo);
//            exit();

            civicrm_api3('Civicrmzapier', 'submit', $contibutoinInfo);

             //-------------------------DEBUG--------------------------------
//            CRM_Core_Error::debug('this is what the object has', self::$zapierApiCallResult);
//            exit();

        }catch (CiviCRM_API3_Exception $ex){

//            ---------   DEBUG  -----------------------------
//            CRM_Core_Error::debug('this is what the contribution info has', $contibutoinInfo);
//            exit();

            throw new Exception('Could not submit request to Zapier through API ' .__METHOD__ .'
            check extension API method ' .$ex->getMessage());
        }

        // we debug to see what we have as response
//         CRM_Core_Error::debug('this is what the object has', $zapier_api_call);
//         exit();

        return self::$zapierApiCallResult;
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
