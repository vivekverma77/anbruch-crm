<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Faisal Ahme
 * Date: 2/12/2018
 * Time: 3:16 PM
 */

if (strpos($_SERVER['SERVER_NAME'], "localhost") !== false) { 
    $config['base_url'] = 'http://localhost/crm.anbruch.com/';
    define("COMPANY_NOREPLY_EMAIL", "no-reply@anbruch.com");

} else {
    $config['base_url'] = 'https://crm.anbruch.com/';
    define("COMPANY_NOREPLY_EMAIL", "no-reply@anbruch.com");

}

//anb_crm_is_#1
define("COMPANY_NAME", "Anbruch Recovery Consultants");
//~ define("COMPANY_NOREPLY_EMAIL", "noreply@anbruch.com");
//define("COMPANY_NOREPLY_EMAIL", "clerisytest2@gmail.com");
define("LEAD_FIRST_NAME_META_ID", 1);
define("LEAD_LAST_NAME_META_ID", 2);
define("LEAD_PHONE_NUMBER_META_ID", 32);
define("LEAD_STATUS_META_ID", 6);
define("LEAD_SERVICE_TYPE_META_ID", 9);
define("LEAD_COMPANY_NAME_META_ID", 31);
define("LEAD_COUNTRY_META_ID", 37);
define("MULTIPLE_OPTION_SEPARATOR", "____");
define("RECORD_LIMIT_IN_EACH_PAGE", 200);
define("LEADS", 1);
define("CLIENTS", 2);
define("CONTRACTS", 3);
define("LEADS_PLURAL_NAME", "Leads");
define("CLIENTS_PLURAL_NAME", "Clients");
define("CONTRACTS_PLURAL_NAME", "Contracts");
define("ACTIVE_USERS", 1);
define("INACTIVE_USERS", 0);
define("ACTIVE_TEAMS", 1);
define("INACTIVE_TEAMS", 0);
define("PROFILE_PICTURE", "profile_picture");
define("RECORD_ATTACHMENT", "record_attachment");
define("ACTIVITY_ATTACHMENT", "activity_attachment");
define("SENDGRID_API_KEY", "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");


define("CLIENTS_CLIENT_NAME_META_ID", 84);
define("CLIENTS_FIRST_NAME_META_ID", 184);
define("CLIENTS_LAST_NAME_META_ID", 183);
define("CLIENTS_STATUS_META_ID", 87);
define("CLIENTS_PHONE_NUMBER_META_ID", 109);
define("CLIENTS_EMAIL_META_ID", 85);
define("CLIENTS_COMPANY_NAME_META_ID", 108);
define("CLIENTS_COUNTRY_META_ID", 114);


global $AUTOMATION_META_IDS;

//Automation meta id => Automation affect meta id

$AUTOMATION_META_IDS = array(
    '26' => '25', //"Company Information Video Validity",
    '28' => '29', //"COMPANY INFORMATION VIDEO VALIDITY (USA)",
);

global $SUPER_ADMIN_LIST;

$SUPER_ADMIN_LIST = array(
    1
);

global $MAJOR_META_IDS_LIST;

$MAJOR_META_IDS_LIST = array(
    LEADS => array(1, 2),
    CLIENTS => array(84),
    CONTRACTS => array(160),
);

global $ADMIN_PREV;

$ADMIN_PREV = array(
    "usermanagement",
    "modulemanagement",
);

global $SENDGRID_TEMPLATE_IDS;

$SENDGRID_TEMPLATE_IDS = array(
    "usa_recovery_options" => "f9a5b39f-a3da-4e59-be66-4fd3f5250396"
);

global $COMMON_WRITABLE;

$COMMON_WRITABLE = array(
    "activities",
    "dashboard",
    "booking",
);

global $RECORD_STATUS;

$RECORD_STATUS = array(
    "READ_ONLY" => 1,
    "DELETED" => 2,
    "CYCLE_RUNNING" => 3, //Default DB Entry in anb_crm_record
    "CYCLE_COMPLETED" => 4,
);

global $FIELD_TYPE;

$FIELD_TYPE = array(
    "Single Line" => "text_",
    "Multi Line" => "textarea_",
    "Integer" => "number_",
    "Number" => "number_", // Double
    "Percent" => "number_",
    "Long Integer" => "number_",
    "Currency" => "text_double_",
    "Email" => "email_",
    "Phone" => "tel_",
    "Date" => "date_",
    "Datetime" => "datetime-local_",
    "Checkbox" => "checkbox_",
    "Lookup" => "_",
    "URL" => "url_",
    "Drop-Down" => "select_",
    "Multiple Drop-Down" => "select_multiple",
);

global $VALIDATION_RULES;

$VALIDATION_RULES = array(
    "Email" => "email",
    "Date" => "date",
    "Datetime" => "datetime",
    "Number" => "double",
    "Integer" => "int",
    "URL" => "[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)",
    "HTTP-URL" => "https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)",
);

global $BOOKING_STATUS;

$BOOKING_STATUS = array(
    "new",
    "confirmed",
    "cancelled",
    "completed",
);

global $EMAIL_NOTIFICATION_PROCESS;

$EMAIL_NOTIFICATION_PROCESS = [
		'recovery_opportunities'=>'Recovery Opportunities',
		'merry_christmas'=>'Merry Christmas',
		'birthday_wish'=>'Birthday Wish',
		'admin_to_opener'=>'Lead Admin To Opener',
		'opener_to_closer'=>'Lead Opener To Closer',
		'closer_to_admin_success'=>'Lead Closer To Admin (Success),Opener (Success)',
		'closer_to_admin_failure'=>'Lead Closer To Admin (Failure), Opener (Failure)',
		'admin_to_technician'=>'Lead Admin To Technician',
		'technician_to_accounting'=>'Lead Technician To Accounting',
		'accounting_to_closer'=>'Lead Accounting To Closer, Technician, Admin'
];

global $CONTRACT_STAGE;

$CONTRACT_STAGE = array(
    "Waiting for Technical Assignment",
    "Assigned to Technical Consultants",
    "Assigned to Accounting Department",
    "Recovery Cycle Completed",
    "Abandoned",
);

