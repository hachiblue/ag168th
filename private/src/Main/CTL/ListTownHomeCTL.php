<?php
/**
 * Created by PhpStorm.
 * User: bbillboy
 * Date: 19/6/2558
 * Time: 11:35
 */
namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\ThirdParty\Xcrud\Xcrud;
/**
 * @Restful
 * @uri /townhome
 */
class ListTownHomeCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
        return new HtmlView('/listTownHome');
    }

    /**
     * @uri /test
     * @GET
     */

    /*public function test () {
        $a = array();
        $a['name'] = "testtttt";
        $a['email'] = "jsonnnnnnn";
        $a['total'] = 2;
        $a['type'] = "json";
        return new JsonView($a);
    }*/
}