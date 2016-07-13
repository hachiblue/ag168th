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
use Main\Helper\ResponseHelper;

/**
 * @Restful
 * @uri /listprops
 */
class listpropsCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
        return new HtmlView('/listyourproperty');
    }

    /**
     * @POST
     */
    public function post () {
      try {
        $contentMail = "";
        $contentMail .= "requirement: ".$_POST['requirement']."<br />";
        $contentMail .= "province: ".$_POST['province']."<br />";
        $contentMail .= "selling price: ".$_POST['sell_price']."<br />";
        $contentMail .= "rental price: ".$_POST['rent_price']."<br />";
        $contentMail .= "project: ".$_POST['project']."<br />";
        $contentMail .= "unit no: ".$_POST['unit_no']."<br />";
        $contentMail .= "size: ".$_POST['size']."<br />";
        $contentMail .= "floor: ".$_POST['floor']."<br />";
        $contentMail .= "bedroom: ".$_POST['bedroom']."<br />";
        $contentMail .= "bathroom: ".$_POST['bathroom']."<br />";
        $contentMail .= "description: ".$_POST['description']."<br />";
        $contentMail .= "title: ".$_POST['title']."<br />";
        $contentMail .= "first name: ".$_POST['first_name']."<br />";
        $contentMail .= "last name: ".$_POST['last_name']."<br />";
        $contentMail .= "email: ".$_POST['email']."<br />";
        $contentMail .= "mobile no: ".$_POST['mobile_no']."<br />";
        $contentMail .= "phone: ".$_POST['phone']."<br />";
        $contentMail .= "how know company: ".$_POST['how_know_company']."<br />";

        $mail = new \PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('system@agent168th.com');
        $mail->addAddress('admin@agent168th.com');
        $mail->Subject = 'Send property from list your property page';
        $mail->msgHTML($contentMail);

        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
          $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['image']['name']));
          move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
          $mail->addAttachment($uploadfile, $_FILES['image']['name']);
        }

        if($mail->send()) {
          return ["success"=> true];
        }
        else {
          return ResponseHelper::error($mail->ErrorInfo);
        }

      }
      catch (\Exception $e) {
        return ResponseHelper::error($e->getMessage());
      }
    }
}
