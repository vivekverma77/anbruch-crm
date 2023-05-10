<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Base.php';
require_once  APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Proposal extends Base
{
	public function __construct()
	{
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("ActivitiesModel");
		$this->load->model("ModuleModel");
		$this->load->model("BookingModel");
		$this->load->model("UserModel");
		$this->load->model("EmailtemplatesModel");
		$this->load->model("LogsModel");
		$this->load->model("App_model");
		$this->load->library('email');
		//$smtpconfig = $this->config->item('email');
		//~ print_r($smtpconfig);die;
		//$this->email->initialize($smtpconfig);

		$this->email->set_mailtype("html");
	}

	function send_proposal(){
			
		$post=$this->input->post();
   	
   	    if($post['is_create_pdf']){
   	    	echo $this->create_proposal_pdf($post['proposal_record_id'],$post);
   	    	die();		
   	    }
		
		//die('comming soon');	

		$curl = curl_init();

		$array['fileUrls']=['http://softgetix.com/projects/crm-anbruch/proposal/preview/'.$post['proposal_record_id'].'doc.pdf'];
		$array['fileNames']=[$post['proposal_record_id'].'doc.pdf'];
		$array['processTextTags']=true;
		$array['sendNow']=true;
		$array['fields']=[array(
					"type"=>"text",
					"x"=>52,
					"y"=>609,
					"width"=>200,
					"height"=>26,
					"documentNumber"=>1,
					"pageNumber"=>5,
					"party"=>1,
					"fontSize"=>14,
					"required"=>true
				),array(
					"type"=>"signature",
					"x"=>52,
					"y"=>559,
					"width"=>200,
					"height"=>26,
					"documentNumber"=>1,
					"pageNumber"=>5,
			 		"party"=>1
		        ),array(
		        	"type"=>"signature",
					"x"=>306,
					"y"=>559,
					"width"=>200,
					"height"=>26,
					"documentNumber"=>1,
					"pageNumber"=>5,
			 		"party"=>2),
		            array(
		            "type"=>"date",
					"x"=>52,
					"y"=>664,
					"width"=>200,
					"height"=>26,
					"documentNumber"=>1,
					"pageNumber"=>5,
					"party"=>1,
					"fontSize"=>14,
					"dateFormat"=> "MM/DD/YYYY",
					"required"=>true),
					array(
					"type"=>"date",
					"x"=>306,
					"y"=>664,
					"width"=>200,
					"height"=>26,
					"documentNumber"=>1,
					"pageNumber"=>5,
					"party"=>2,
					"fontSize"=>14,
					"dateFormat"=> "MM/DD/YYYY",
					"required"=>true
				)];

		$array["folderName"]=$post['proposal_name'];
		
		$array["parties"]=array(array(
					"firstName"=>$post['proposal_fname'],
					"lastName"=>$post['proposal_lname'],
					"emailId"=>$post['proposal_email'],
					"permission"=>"FILL_FIELDS_AND_SIGN",
					"sequence"=>1,
			 ),array(
					"firstName"=>'Andrew',
					"lastName"=>'Aauger',
					"emailId"=>'aauger@anbruch.com',
					"permission"=>"FILL_FIELDS_AND_SIGN",
					"sequence"=>1,
			 ));

		$array["signInSequence"]=false;
		$array["fixDocuments"]=true;
		$array["createEmbeddedSigningSession"]=false;
		$array["createEmbeddedSigningSessionForAllParties"]=false;
		$array["signSuccessUrl"]="YOUR_PAGE_TO_REDIRECT_USER_FROM_EMBEDDED_SESSION";
		$array["signDeclineUrl"]="YOUR_PAGE_TO_REDIRECT_USER_FROM_EMBEDDED_SESSION";
		$array["signLaterUrl"]="YOUR_PAGE_TO_REDIRECT_USER_FROM_EMBEDDED_SESSION";
		$array["signErrorUrl"]="YOUR_PAGE_TO_REDIRECT_USER_FROM_EMBEDDED_SESSION";
		$array["themeColor"]="ANY_CSS_COLOR_TO_MATCH_YOUR_APPLICATION";

		$object=json_encode($array);

		//print_r($object);die();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.esigngenie.com/esign/api/folders/createfolder",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $object,
		  
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: Bearer ".ESIGN_ACCESS_TOKEN,
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {

			$res=json_decode($response);

			$data=['record_id'=>$post['proposal_record_id'],
					'folder_id'=>$res->folder->folderId,
					'name'=>$post['proposal_name'],
					'created_at'=>time(),
					'status'=>$res->folder->folderStatus,
					'client_party_id'=>$res->folder->folderRecipientParties[0]->partyId,
					'admin_party_id'=>$res->folder->folderRecipientParties[1]->partyId,
					'file'=>$this->download_document($post['proposal_record_id'],$res->folder->folderId),
					'created_by'=>$this->getUserId(),
				 ];
			
			$this->db->insert('proposal_document',$data);

			$this->LogsModel->addLogs('Proposal', 'Proposal Sent',$post['proposal_record_id'],'Clients',$this->getUserId(),'Proposed');

			$this->session->set_flashdata('success','Proposal Sent successfully');
		    
		    echo $response; 
		}
	}

	function connect_esign(){
		  
		  $curl = curl_init();	
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.esigngenie.com/esign/api/oauth2/access_token",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=219779aac98745ac9b0f84cbf34922b9&client_secret=a4538249a3e2428ebb238c27398ae356&scope=read-write",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/x-www-form-urlencoded"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		   return $err;
		} else {
		  return  $response;
		}
	}

	function get_all_templates(){
	  
	  $curl = curl_init();
	
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://www.esigngenie.com/esign/api/templates/list",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: Bearer ".ESIGN_ACCESS_TOKEN,
	    "cache-control: no-cache",
	    "content-type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}

}

function get_folder_detail($folder_id='',$record_id=''){

	  $post=$this->input->post();	

	  $curl = curl_init();
	
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://www.esigngenie.com/esign/api/folders/myfolder?folderId=$folder_id",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: Bearer ".ESIGN_ACCESS_TOKEN,
	    "cache-control: no-cache",
	    "content-type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {

	  $array=json_decode($response);		
	  
	  if(($array->folder->folderStatus=='PARTIALLY SIGNED' && $post['status']!='PARTIALLY SIGNED') or 
	  	$array->folder->folderStatus=='EXECUTED'){
	  		
	  	$this->download_document($record_id,$folder_id);

	  	foreach ($array->{'Folder History'} as $key => $value) {
	  		
	  		if($value->action=='Signed'){

			  	$execute_date=substr($value->dateChanged, 0, -3);

		  		if($post['admin_party_id']==$value->changeDoneByParty)
		  			$col_date='admin_sign_date';	
		  		else
		  		    $col_date='client_sign_date';	
		  		

			  	$this->db->update('proposal_document',['status'=>$array->folder->folderStatus,$col_date=>$execute_date],['record_id'=>$record_id,'folder_id'=>$folder_id]);
	  		}
		}
	}
	
	  echo $response;
	}	

}

function download_document($record_id='',$folder_id=''){

	  $curl = curl_init();
      
      curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://www.esigngenie.com/esign/api/folders/document/download?folderId=$folder_id&docNumber=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: Bearer ".ESIGN_ACCESS_TOKEN,
	    "cache-control: no-cache",
	    "content-type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return  false;
	} else {
	   		
	   $fileName=$record_id.$folder_id.'doc.pdf';		

	   $file=$_SERVER['DOCUMENT_ROOT'].'/projects/crm-anbruch/proposal/'.$fileName;
	   file_put_contents($file, $response);
	   return $fileName;
	}

}

function create_proposal_pdf($record_id='',$data=[]){
	
	/*$data['proposal_record_id']='41959';
	$data['proposal_fname']='vikas';
	$data['proposal_lname']='choudhary';
	$data['proposal_company']='1 vikas';
	$data['proposal_address']='manhatton road ny';
	$data['is_create_pdf']= 1;
	$data['proposal_name']='Proposal 1';
	$data['proposal_emai']='pwngoud@gmail.com';
	$data['proposal_service']=[' Sales Tax (CA)','Sales Tax (US)','Customs Duty/Drawback (CA)','Customs Duty/Drawback (US)'];*/

	$html=$this->load->view('proposal/proposal_pdf',$data,true);
   //echo $html;die();
    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf->loadHtml($html);
    $dompdf->set_option('enable_html5_parser', TRUE);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
         //$dompdf->stream("Event");
    //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));die();
	$output = $dompdf->output();
	$fileName=$record_id.'doc.pdf';		
	$file=$_SERVER['DOCUMENT_ROOT'].'/projects/crm-anbruch/proposal/preview/'.$fileName;
    file_put_contents($file, $output);
    return $fileName;	
}


}