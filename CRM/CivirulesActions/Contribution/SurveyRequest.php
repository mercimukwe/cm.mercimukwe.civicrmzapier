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

        // we now have to make an api call to have the email and contact info of the contact id in contribution data
        // display_name and email

        try {

            $contact = civicrm_api3('Contact', 'getsingle', array(
                'id' => $contributionDetails['contact_id']));

        } catch (CiviCRM_API3_Exception $ex) {

            throw new Exception('Could not obtain the contact details display_name and email '.__METHOD__
            .', contact your system administrator. Error message from API Contact getsingle: '.$ex->getMessage());
        }


        //We now constitute the array to hold the contribution data

        $contributoinInfo =  array(

            'id' => $contributionDetails['id'],
            'contact_id ' => $contributionDetails['contact_id'],
            'total_amount' => $contributionDetails['total_amount'],
            'receive_date' => $contributionDetails['receive_date'],
            'currency' => $contributionDetails['currency'],
            'display_name' => $contact['display_name'],
            'email' => $contact['email']

        );

        //we have to format the data and then call the api submit method of the Zapier entity
        // like so civicrm_api3('Zapier', 'submit',$contributionData )

        try{

            civicrm_api3('Civicrmzapier', 'submit', $contributoinInfo);

        }catch (CiviCRM_API3_Exception $ex){


            throw new Exception('Request Not sent to Zap on Zapier, check that '.__METHOD__.' works and 
            check extension API function Civicrmzapier-Submit works ' .$ex->getMessage());
        }

        return self::$zapierApiCallResult;
    }


}
