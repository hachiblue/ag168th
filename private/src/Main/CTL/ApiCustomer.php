<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 7/4/2558
 * Time: 16:32
 */

namespace Main\CTL;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ResponseHelper;

/**
 * @Restful
 * @uri /api/customer
 */

class ApiCustomer extends BaseCTL {
    private $table = "customer";
    /**
     * @GET
     */
    public function index () {
        $list = ListDAO::gets($this->table, [
            "limit"=> 100
        ]);

        return $list;
    }

    /**
     * @POST
     */
    public function add () {
        $params = $this->reqInfo->params();
        $insert = ArrayHelper::filterKey(["id_card", "firstname", "lastname", "sex", "birth_date", "address", "religion"], $params);

        $db = MedooFactory::getInstance();
        $id = $db->insert($this->table, $insert);

        if(!$id){
            return ResponseHelper::error("Error can't add customer.");
        }

        $db->insert("enquiry", [
            "customer_id"=> $id
        ]);

        $item = $db->get($this->table, "*", ["id"=> $id]);
        return $item;
    }

    /**
     * @DELETE
     * @uri /[i:id]
     */
    public function delete() {
        $id = $this->reqInfo->urlParam("id");

        $db = MedooFactory::getInstance();
        $id = $db->delete($this->table, ["id"=> $id]);

        if(!$id){
            return ResponseHelper::error("Error can't remove customer.");
        }
        $db->delete("enquiry", ["account_id"=> $id]);

        return ["success"=> true];
    }
}