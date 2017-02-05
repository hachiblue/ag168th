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
use Main\ThirdParty\Xcrud\Xcrud;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ResponseHelper;

/**
 * @Restful
 * @uri /member
 */
class memberCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () 
	{
        $params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pItems = array('page' => 'member', 'act5' => 'act');

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

			$property = $db->select('property', '*', ['id'=>$fav]);

			echo json_encode($property);
		}
		else
		{
			echo json_encode(array());
		}
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
}
