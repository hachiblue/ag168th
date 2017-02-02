<?php

namespace Main\CTL;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /api/webmanage
 */
class ApiWebManageCTL extends BaseCTL {

    private $table = "wm_topic";

    /**
     * @GET
     */
    public function index () 
	{
		
		echo json_encode($_GET);

    }

}
