<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:27 AM
 */

namespace Main\CTL;


use Main\Context\Context;
use Main\Helper\URL;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\View\RedirectView;
use Main\DB\Medoo\MedooFactory;
use Main\ControllerFollow;
/**
 * @Restful
 * @uri /
 */
class indexCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
        return new RedirectView(URL::absolute("/home"));
//        return new HtmlView('/index');
    }
	
	
	/**
     * @GET
	 * @uri %E0%B9%80%E0%B8%8A%E0%B9%88%E0%B8%B2%E0%B8%84%E0%B8%AD%E0%B8%99%E0%B9%82%E0%B8%94
     */
    public function r () {
       return new ControllerFollow('/list','GET');
    }
	
}