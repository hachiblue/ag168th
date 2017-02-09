<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:27 AM
 */

namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\Helper\ArrayHelper;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ResponseHelper;

/**
 * @Restful
 * @uri /member
 */
class memberCTL extends BaseCTL {
	
	private static $table = "member";

    /**
     * @GET
     */
    public function index () 
	{
        $params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pItems = array('page' => 'member', 'act8' => 'act');

        return new HtmlView('/template/layout', $pItems);
    }

	/**
     * @POST
	 * @uri /register
     */
    public function register () 
	{
        $params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();

		$res = array( 'success' => true );

		if (!filter_var($params['form-reg-email'], FILTER_VALIDATE_EMAIL) === false) 
		{
			$res['success'] = true; 
		} 
		else 
		{
			$res['error'] = 'Please ensure your email address is correct'; 
			$res['success'] = false; 
		}

		$count = $db->count('member', ['email'=>$params['form-reg-email']]);
		
		if( $count > 0 )
		{
			$res['error'] = 'Your email address is already registered with us';
			$res['success'] = false; 
		}

		if( strlen($params['form-reg-password']) < 5 )
		{
			$res['error'] = 'Password required minimum 5 characters'; 
			$res['success'] = false; 
		}

		if( $params['form-reg-password'] !== $params['form-reg-rpassword'] )
		{
			$res['error'] = 're-password incorrect'; 
			$res['success'] = false; 
		}

		if( $res['success'] === true )
		{
			$id = $db->insert("member", [
				"email"=> $params['form-reg-email'],
				"password"=> $params['form-reg-password'],
				"status"=>"active"
			]);

			$_SESSION['member'] = $db->get('member', '*', ['id'=>$id]);
		}

		//$res['log'] = $db->log();

		echo json_encode($res);

        //return new HtmlView('/template/layout', $pItems);
    }

	/**
     * @POST
	 * @uri /login
     */
    public function login () 
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}

		$res = array( 'success' => true );

		$sth = $db->pdo->prepare('SELECT * FROM member WHERE password=:pass AND (username=:username OR email=:email)');
	
		$sth->bindParam(':pass', $params['form-password'], \PDO::PARAM_STR);
		$sth->bindParam(':username', $params['form-username'], \PDO::PARAM_STR);
		$sth->bindParam(':email', $params['form-username'], \PDO::PARAM_STR);

		$sth->execute();
		$row = $sth->fetch(\PDO::FETCH_ASSOC); 
		
		if( isset($row['email']) && !empty($row['email']) )
		{
			$_SESSION['member'] = $row;

			$db->update('member', ['last_login' => date('Y-m-d h:i:s')], ['id'=>$row['id']]);
		}
		else
		{
			$res['success'] = false;
			$res['error'] = 'Username/Email or Password incorrect';
		}

		echo json_encode($res);
	}

	/**
     * @GET
	 * @uri /logout
     */
    public function logout () 
	{
		unset($_SESSION['member']);
		header('location: /');
	}
	
	/**
     * @POST
	 * @uri /chk
     */
	public function chk ()
	{
		$params = $this->reqInfo->params();

		if( isset($_SESSION['member']) )
		{
			$this->update_fav( $params );
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	/**
     * @POST
	 * @uri /chklist
     */
	public function chklist ()
	{
		$db = MedooFactory::getInstance();
			
		if( isset($_SESSION['member']) )
		{
			$fav = explode(',', $_SESSION['member']['fav_property']);

			$property = $db->select('property', [ "[><]project" => ["project_id" => "id"] ], ['property.id', 'project.name(project_name)'], ['property.id'=>$fav]);

			echo json_encode($property);
		}
		else
		{
			echo json_encode(array());
		}
	}

	/**
     * @GET
	 * @uri /profile
     */
	public function profile ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pf = $db->get('member', '*', ['id'=>$_SESSION['member']['id']]);

		$pItems = array('page' => 'profile', 'profile' => $pf);

        return new HtmlView('/template/layout', $pItems);
	}

	/**
     * @POST
	 * @uri /update_profile
     */
	public function update_profile ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$res = array();
		$res['success'] = false;

		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}

		if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL) === false) 
		{
			$res['success'] = true; 
		} 
		
		$update = ArrayHelper::filterKey([
			'name', 'surname', 'email', 'line', 'phone', 'address'
		], $params);

		$update = array_map(function($item) 
		{
			if(is_string($item)) 
			{
				$item = trim($item);
			}
			return $item;
		}, $update);

		if( $db->update('member', $update, ['id'=>$_SESSION['member']['id']]) )
		{
			$res['success'] = true; 

			$_SESSION['member']['name'] = $params['name'];
			$_SESSION['member']['surname'] = $params['surname'];
			$_SESSION['member']['email'] = $params['email'];
			$_SESSION['member']['line'] = $params['line'];
			$_SESSION['member']['phone'] = $params['phone'];
			$_SESSION['member']['address'] = $params['address'];
		}
		else
		{
			$res['success'] = false; 
			$res['error'] = 'cannot update';
			//$res['log'] = $db->log();
		}

        echo json_encode($res);
	}

	/** 
	 * @POST
	 * @uri /change_password
	 */
	public function change_password ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$res = array();
		$res['success'] = true;

		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}
		
		$old_pass = $db->get('member', 'password', ['id'=>$_SESSION['member']['id']]);

		if( $old_pass != $params['old_password'] )
		{
			$res['error'] = 'Wrong Password'; 
			$res['success'] = false; 
		}

		if( strlen($params['new_password']) < 5 )
		{
			$res['error'] = 'Password required minimum 5 characters'; 
			$res['success'] = false; 
		}

		if( $params['new_password'] !== $params['re_password'] )
		{
			$res['error'] = 're-password incorrect'; 
			$res['success'] = false; 
		}

		if( $res['success'] === true )
		{
			$db->update('member', ['password'=>$params['re_password']], ['id'=>$_SESSION['member']['id']]);
		}

		echo json_encode($res);
	}

	/**
     * @POST
	 * @uri /upload_picture
     */
	public function save_picture ()
	{
		$validator = new \FileUpload\Validator\Simple(1024 * 1024 * 4, ['image/png', 'image/jpg', 'image/jpeg']);
		$pathresolver = new \FileUpload\PathResolver\Simple('public/member_pics');
		$filesystem = new \FileUpload\FileSystem\Simple();
		$filenamegenerator = new \FileUpload\FileNameGenerator\Random();

		$fileupload = new \FileUpload\FileUpload($_FILES['pf-picture'], $_SERVER);
		$fileupload->setPathResolver($pathresolver);
		$fileupload->setFileSystem($filesystem);
		$fileupload->addValidator($validator);

		$fileupload->setFileNameGenerator($filenamegenerator);

		list($files, $headers) = $fileupload->processAll();

		$slides = self::_get("picture");
		$slides = json_decode($slides);

		$db = MedooFactory::getInstance();
		foreach($files as $file)
		{
			if($file->completed)
			{
				$pic = $db->get("member", "picture", ["id"=> $_SESSION['member']['id']]);

				if( isset($pic) && !empty($pic) )
				{
					if( is_file( 'public/member_pics/' . $pic ) )
					{
						unlink( 'public/member_pics/' . $pic );
					}
				}

				$db->update("member", ["picture"=> $file->name], ["id"=> $_SESSION['member']['id']]);

				$_SESSION['member']['picture'] = $file->name;
				// $ffff[] = $file;
				//$slides[] = $file->name;
				// ImageHelper::makeResizeWatermark($file->path);
			}
		}

		header("Location: /member/profile");
	}

	/**
     * @GET
	 * @uri /enquiry
     */
	public function enquiry ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pf = $db->get('member', '*', ['id'=>$_SESSION['member']['id']]);

		$pItems = array('page' => 'post_enquiry', 'profile' => $pf);

        return new HtmlView('/template/layout', $pItems);
	}

	/**
     * @GET
	 * @uri /property
     */
	public function property ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pf = $db->get('member', '*', ['id'=>$_SESSION['member']['id']]);

		$pItems = array('page' => 'post_property', 'profile' => $pf);

        return new HtmlView('/template/layout', $pItems);
	}

	/**
     * @POST
	 * @uri /post_enquiry
     */
    public function post_enquiry () 
	{
        $params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();

		$res = array( 'success' => true );

		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}
		
		if( isset($params['daterequest']) )
		{
			$comment = ' จาก website นัดชมห้อง วันที่' . $params['daterequest'];
		}
		else
		{
			$comment = $params['comment'];
		}


		if( $res['success'] === true )
		{
			$insert = ArrayHelper::filterKey([
			  "enquiry_type_id", "customer", "requirement_id", "property_type_id", "province_id", "project_id",
			  "buy_budget_start", "buy_budget_end", "rent_budget_start", "rent_budget_end", "zone_id",
			  "desicion_maker", "bedroom", "is_studio", "size", "size_unit_id", "bts_id", "mrt_id",
			  "airport_link_id", "enquiry_status_id", "ex_location", "ptime_to_pol", "sq_furnish",
			  "sq_hospital", "sq_school", "sq_park", "sq_bts", "sq_shopmall", "sq_airport", "sq_mainroad",
			  "sq_other", "contact_type_id", "chk1", "chk2", "chk3", "contact_method", "website"
			], $params);

			$insert = array_map(function($item) 
			{
			  if(is_string($item)) 
			  {
				$item = trim($item);
			  }
			  return $item;
			}, $insert);

			if( empty($comment) ) 
			{
				return \ResposenHelper::error("require comment");
			}

			$now = date('Y-m-d H:i:s');

			$insert["enquiry_status_id"] = 1;
			$insert["customer"] = $_SESSION['member']['name'];
			$insert["enquiry_type_id"] = 1;
			$insert['created_at'] = $now;
			$insert['updated_at'] = $now;
			$insert['enquiry_no'] = $this->_generateReferenceId($insert["enquiry_type_id"]);
			$insert['contact_method'] = 'website';

			$db->pdo->beginTransaction();
			$id = $db->insert('enquiry', $insert);
			if(!$id) {
			   return ResponseHelper::error("Error can't add enquiry.".$db->error()[2]);
			}

			$accId = $_SESSION['member']['id'];
			$commentInsert = [
			  "enquiry_id"=> $id,
			  "comment"=> $comment,
			  "comment_by"=> '999',
			  "updated_at"=> $now  
			];

			$db->insert("enquiry_comment", $commentInsert);
			$db->pdo->commit();

			//$item = $db->get('enquiry', "*", ["id"=> $id]);
			//return $item;
		}

		//$res['log'] = $db->log();

		echo json_encode($res);

        //return new HtmlView('/template/layout', $pItems);
    }

	public function update_fav ( $params )
	{
		$db = MedooFactory::getInstance();
		
		$member_id = $_SESSION['member']['id'];

		$member = $db->get('member', '*', ['id'=>$member_id]);

		$fav = explode(',', $member['fav_property']);

		if( ! in_array($params['prop'], $fav) )
		{
			if( $params['status'] == 'true' )
			{
				array_push($fav, $params['prop']);
			}
		}
		else
		{
			if( $params['status'] == 'false' )
			{
				if(($key = array_search($params['prop'], $fav)) !== false) 
				{
					unset($fav[$key]);
				}
			}
			
		}
		
		$new_fav = implode(',', $fav);
		$db->update('member', ['fav_property'=>$new_fav], ['id'=>$member_id]);
		$_SESSION['member']['fav_property'] = $new_fav;
	}

	public function _generateReferenceId($propTypeId)
    {
		$db = MedooFactory::getInstance();
		$propType = $db->get("enquiry_type", "*", ["id"=> $propTypeId]);
		if(!$propType) 
		{
			return false;
		}

		$code = "E".$propType["code"];
		$dt = new \DateTime();
		return $this->_generateReferenceId2($code, $dt);
	}

	public function _generateReferenceId2($code, $dt) 
	{
		$dtStr = $code.$dt->format('dmy');

		$db = MedooFactory::getInstance();
		$sql = "SELECT enquiry_no FROM enquiry WHERE SUBSTRING(enquiry_no, 1, 8) = '{$dtStr}' ORDER BY enquiry_no DESC LIMIT 1";
		$r = $db->query($sql);
		$row = $r->fetch(\PDO::FETCH_ASSOC);

		if(!empty($row)) 
		{
			$n = substr($row['enquiry_no'], -2);
			if($n == '99') 
			{
				$dt->add(new \DateInterval('P1D'));
				return $this->_generateReferenceId2($code, $dt);
			}
			else 
			{
				$n = intval($n) + 1;
				return $code.$dt->format("dmy").sprintf("%02d", $n);
			}
		}
		else 
		{
			return $code.$dt->format("dmy")."00";
		}
	}

}
