<?php
/**
 *  AdminCTL.php
 *  Project : bc
 *
 *  Created by Issarapong Wongyai on 17/3/2558 16:15
 *  Copyright 2015 Issarapong Wongyai. All rights reserved.
 */

namespace Main\CTL;

use Main\Context\Context;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\View\RedirectView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\Helper\URL;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /admin
 */
class AdminCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
      if(empty($_SESSION['login'])) {
        return new RedirectView(URL::absolute('/admin/login'));
      }
      // return new HtmlView('/admin/index');
      return new RedirectView(URL::absolute('/admin/enquiries'));
    }

    /**
     * @GET
     * @uri /login
     */
    public function getLogin () {
      unset($_SESSION['login']);
        return new HtmlView('/admin/login');
    }

    /**
     * @GET
     * @uri /project/[:id]/images
     */
    public function projectImages () {
        if(empty($_SESSION['login'])) {
          return new RedirectView(URL::absolute('/admin/login'));
        }
        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);
        return new HtmlView('/admin/index', array("view"=> 'project_images', "project_id"=> $id, "pqCount"=> $pqCount));
    }

    /**
     * @GET
     * @uri /[a:view]
     */
    public function indexView () {
        if(empty($_SESSION['login'])) {
          return new RedirectView(URL::absolute('/admin/login'));
        }
        $view = $this->reqInfo->urlParam("view");
        $db = MedooFactory::getInstance();

        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);

        $where = array();

        /*
        $where["AND"] = array(
          "OR" => array( 
            "web_status" => 1,
            "AND" => array(
              "web_status" => 0, 
              "property_status_id" => 1 
            )
          )
        );*/

        //$where["AND"]['rented_expire[>]'] = "0000-00-00";
        $where["AND"]['property_status_id[!]'] = "4";
        $where["AND"]['rented_expire[<]'] = date("Y-m-d H:i:s", strtotime("+7 days"));
        $where["AND"]['requirement_id[!]'] = "1";

        $exCount = $db->count("property", "*", $where);
        //$exCount = $db->last_query();

        return new HtmlView('/admin/index', array("view"=>$view, "pqCount"=> $pqCount, "exCount"=> $exCount));
    }

	   /**
     * @GET
     * @uri /gen
     */
    public function genView () {
        return new HtmlView('/admin/gen');
    }

    /**
     * @POST
     * @uri /login
     */
    public function postLogin () {
        $db = MedooFactory::getInstance();

        $username = $this->reqInfo->param('username');
        $password = $this->reqInfo->param('password');

        $account = $db->get("account", "*", ["username"=> $username]);

        if(!$account) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "Not found username"]]);
        }
        else if($account['password'] != $password) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "Wrong password"]]);
        }
        else if($account['account_status_id'] != 1) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "This account is not active."]]);
        }
        else {
          $now = date('Y-m-d H:i:s');
          $db->update("account", ['last_login'=> $now], ['id'=> $account['id']]);
          $level = $db->get("level", "*", ["id"=> $account['level_id']]);
          $account['last_login'] = $now;
          $account['level'] = $level;
          $_SESSION['login'] = $account;
          return new JsonView(["success"=> true]);
        }
    }
}
