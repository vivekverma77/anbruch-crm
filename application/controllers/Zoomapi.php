<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once './vendor/autoload.php';
require_once 'Base.php';

class Zoomapi extends Base {

	   public function __construct()
		{
		     parent::__construct();
		}
	
// Zoom functionality start	
		public function login_with_zoom()
		{
		   $this->configg();
			$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;
			echo "<a href=".$url.">Login with Zoom</a>";
		}
		public function configg(){
			define('CLIENT_ID', 'LeVVOrQTICJ0iMuBsBBVQ');
			define('CLIENT_SECRET', 'XalUkp7MurHmv4Vw1hm2nbp6yfeBtbKf');
			define('REDIRECT_URI', 'https://softgetix.com/projects/crm-anbruch/booking/callback');
		}

		public function create_meeting($topic,$starttime) {
	  			$this->configg();

		    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		    $db = $this->load->database();
		    $arr_token = $this->get_access_token();
		    $accessToken = $arr_token->access_token;


		    try {
		        $response = $client->request('POST', '/v2/users/me/meetings', [
		            "headers" => [
		                "Authorization" => "Bearer $accessToken"
		            ],
		            'json' => [
		                "topic" => "$topic",
		                "type" => 2,
		                "start_time" => "$starttime",
		                "duration" => "60", // 30 mins
		                "password" => "$topic"
		            ],
		        ]);
		 	
		 
		        $data = json_decode($response->getBody());
		       
		        $url_main = $data->join_url;
		        $url = explode("/",$url_main);
		        $x = $url[4];
		        $m_id = explode("?",$x);
		        $id = $m_id[0];

		      $qu="insert into zoom_meeting(topic_name,start_time,duration,password,meeting_id,link) values('$topic','$starttime',30,'$topic',$id,'$url_main')";

		      $sql=$this->db->query($qu);
		      if($sql){
		         $insert_id = $this->db->insert_id();
                  return  $insert_id;    
		      }else{
		        echo "not ";
		      }
		    } catch(Exception $e) {
		        if( 401 == $e->getCode() ) {
		            $refresh_token = $this->get_refersh_token();
		            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
		            $response = $client->request('POST', '/oauth/token', [
		                "headers" => [
		                    "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
		                ],
		                'form_params' => [
		                    "grant_type" => "refresh_token",
		                    "refresh_token" => $refresh_token
		                ],
		            ]);	
		            $this->update_access_token($response->getBody());
		 
		            $this->create_meeting($topic,$starttime);
		        } else {
		            echo $e->getMessage();
		        }
		    }
		}

    public function is_table_empty() {
        $result = $this->db->query("SELECT id FROM token");
        if($result->num_rows) {
            return false;
        }
        return true;
    }
  
    public function get_access_token() {
        $sql = $this->db->query("SELECT access_token FROM token");
        $result = $sql->result_array();
        return json_decode($result[0]['access_token']);
    }
  
    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    public function update_access_token($token) {
        if($this->is_table_empty()) {
        	$this->db->query("DELETE FROM token");
            $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");
        }
    }

    public function callback(){
    	$this->configg();
    	try {
		    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
		 
		    $response = $client->request('POST', '/oauth/token', [
		        "headers" => [
		            "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
		        ],
		        'form_params' => [
		            "grant_type" => "authorization_code",
		            "code" => $_GET['code'],
		            "redirect_uri" => REDIRECT_URI
		        ],
		    ]);
		 
		    $token = json_decode($response->getBody()->getContents(), true);
		 	
		    $db = $this->load->database();

		 	
		    if($this->is_table_empty()) {
		        $this->update_access_token(json_encode($token));
		        echo "Access token inserted successfully.";
		    }
		} catch(Exception $e) {
		    echo $e->getMessage();
		}
    }

// Zoom functionality end


}
