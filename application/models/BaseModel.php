<?php
/**
 * Created by PhpStorm.
 * User: mohammadfaisalahmed
 * Date: 2/17/16
 * Time: 7:32 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH . "../application/libraries/utilities.php";

class BaseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function debug($debugArray)
    {
        echo "<pre>";
        print_r($debugArray);
        echo "</pre>";
    }

    function checkACL($role_id, $controller, $action){
        $this->db->select("*");
        $this->db->join('anb_crm_actions', 'anb_crm_actions.controller_id = anb_crm_controllers.id', 'left');
        $this->db->join('anb_crm_acl', 'anb_crm_acl.action_id = anb_crm_actions.id', 'left');
        $this->db->where('anb_crm_controllers.title', $controller);
        $this->db->where('anb_crm_actions.title', $action);
        $this->db->where('anb_crm_acl.role_id', $role_id);
        $res = $this->db->get('anb_crm_controllers');

        return ($res->num_rows() > 0) ? true : false;
    }

    function getPost($attr, $filter = true)
    {
        $return = $this->input->get_post($attr, $filter);
        $return = (!is_array($return)) ? trim($return) : $return;
        return $return;
    }

    function postGet($attr, $filter = true)
    {
        $return = $this->input->post_get($attr, $filter);
        $return = (!is_array($return)) ? trim($return) : $return;
        return $return;
    }

    function randomPassword($digit = 6)
    {
        return substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', $digit)), 0, $digit);
    }

    function sendTransactionalEmail($to, $subject, $view, $data)
    {
        $CI =& get_instance();
        //$config = Array();
        $message = $CI->load->view("$view", $data, TRUE);
        //$CI->load->library('email', $config);
        $CI->load->library('email');
        $CI->email->set_newline("\r\n");
        $CI->email->set_mailtype("html");
        $CI->email->from(COMPANY_NOREPLY_EMAIL, COMPANY_NAME);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        $CI->email->send();
        //$CI->email->send(FALSE);
        /*print_r($CI->email->print_debugger());
        die;*/
    }

    //TODO: Edit details
    function sendMarketingEmail($to_email, $to_name, $reply_to_email, $reply_to_name, $from_email, $from_name, $subject, $data, $template_id){
        require_once BASEPATH . "../application/third_party/sendgrid-php/sendgrid-php.php";

        $from = new SendGrid\Email($from_name, $from_email);
        $to = new SendGrid\Email($to_name, $to_email);
        $content = new SendGrid\Content("text/html", "<div></div>");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        $reply_to = new SendGrid\ReplyTo($reply_to_email, $reply_to_name);
        $mail->setReplyTo($reply_to);
        foreach ($data as $key => $value){
            $mail->personalization[0]->addSubstitution("$key", $value);
        }
        $mail->setTemplateId("$template_id");

        $sg = new \SendGrid(SENDGRID_API_KEY);

        try {
            $response = $sg->client->mail()->send()->post($mail);
        } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}