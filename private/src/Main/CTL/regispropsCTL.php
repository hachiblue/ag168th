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
 * @uri /regisprops
 */
class regispropsCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {

		$this->chkLogin();

        $params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();

		$province = $db->select('province', '*');
		$requirement = $db->select('requirement', '*');
		$property_type = $db->select('property_type', '*');
		$size_unit = $db->select('size_unit', '*');
		
		$pItems = array('page' => 'registeryourproperty', 'act5' => 'act', 'province' => $province, 'requirement' => $requirement, 'property_type' => $property_type, 'size_unit' => $size_unit);

        return new HtmlView('/template/layout', $pItems);
    }

    /**
     * @POST
     */
    public function post () 
	{
		try {

			$contentMail = "";
			foreach( $_POST as $name => $value )
			{
				$contentMail .= $name . ": " . $value . "<br />";
			}

			$mail = new \PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->setFrom('system@agent168th.com');
			//$mail->addAddress('info@agent168th.com; agent168th@yahoo.com');
			$mail->addAddress('info@agent168th.com');
			$mail->addAddress('agent168th@yahoo.com');
			//$mail->addAddress('oom34299@gmail.com');

			$mail->Subject = 'Send property from list your property page';
			$mail->msgHTML($contentMail);

			$i = 1;
			$mx = 9;

			foreach( $_FILES['image']['name'] as $i => $img )
			{
				if( isset($_FILES['image'][$i]['tmp_name']) )
				{
					$uploadfile = tempnam(sys_get_temp_dir(), sha1($img));
					move_uploaded_file($_FILES['image'][$i]['tmp_name'], $uploadfile);
					$mail->addAttachment($uploadfile, $img);
				}

			}

			
			if( $mail->send() ) 
			{ 
				header("location: http://agent168th.com/");
				return ["success"=> true];
			}
			else 
			{
				return ResponseHelper::error($mail->ErrorInfo);
			}
		}
		catch (\Exception $e) 
		{
			return ResponseHelper::error($e->getMessage());
		}
    }

	public function chkLogin()
	{
		if( !isset($_SESSION['member']) )
		{
			header('location: /member');
		}
	}
}
