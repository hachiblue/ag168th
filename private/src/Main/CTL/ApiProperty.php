<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 7/4/2558
 * Time: 16:32
 */

namespace Main\CTL;
use FileUpload\FileUpload;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;
use Main\Helper\ImageHelper;

/**
 * @Restful
 * @uri /api/property
 */

class ApiProperty extends BaseCTL {
    private $table = "property";
    /**
     * @GET
     */
    public function index () {
        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)",
            "zone.name(zone_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]zone"=> ["zone_id"=> "id"]
        ];
        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $where = ["AND"=> []];

        $params = $this->reqInfo->params();
        if(!empty($params['property_type_id'])){
            $where["AND"]['property.property_type_id'] = $params['property_type_id'];
        }
        if(!empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0'){
            if($params['bedrooms'] == "4+") {
              $where["AND"]['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else {
              $where["AND"]['property.bedrooms'] = $params['bedrooms'];
            }
        }
        if(!empty($params['requirement_id'])){
            if(in_array($params['requirement_id'], [1,2,4])) {
              $where["AND"]['property.requirement_id'] = [$params['requirement_id'], 3];
            }
            else {
              $where["AND"]['property.requirement_id'] = $params['requirement_id'];
            }
        }
        if(!empty($params['project_id'])){
            $where["AND"]['property.project_id'] = $params['project_id'];
        }
        if(!empty($params['web_status'])){
            $where["AND"]['property.web_status'] = $params['web_status'];
        }
        if(!empty($params['property_highlight_id'])){
            $where["AND"]['property.property_highlight_id'] = $params['property_highlight_id'];
        }
        if(!empty($params['feature_unit_id'])){
            $where["AND"]['property.feature_unit_id'] = $params['feature_unit_id'];
        }

        if(!empty($params['bts_id'])){
            $where["AND"]['property.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])){
            $where["AND"]['property.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['airport_link_id'])){
            $where["AND"]['property.airport_link_id'] = $params['airport_link_id'];
        }


        // new
        if(!empty($params['web_status'])){
            $where["AND"]['property.web_status'] = $params['web_status'];
        }
        if(!empty($params['reference_id'])){
            $where["AND"]['property.reference_id'] = $params['reference_id'];
        }
        if(!empty($params['owner'])){
            $where["AND"]['property.owner[~]'] = $params['owner'];
        }
        if((!empty($params['size_start']) || !empty($params['size_end'])) && !empty($params['size_unit_id'])){
            $where["AND"]['property.size_unit_id'] = $params['size_unit_id'];

            if(!empty($params['size_start'])) {
              $where["AND"]['property.size[>=]'] = $params['size_start'];
            }
            if(!empty($params['size_end'])) {
              $where["AND"]['property.size[<=]'] = $params['size_end'];
            }
        }

        // sell price
        if(!empty($params['sell_price_start'])) {
          $where["AND"]['property.sell_price[>=]'] = $params['sell_price_start'];
        }
        if(!empty($params['sell_price_end'])) {
          $where["AND"]['property.sell_price[<=]'] = $params['sell_price_end'];
        }

        // rent price
        if(!empty($params['rent_price_start'])) {
          $where["AND"]['property.rent_price[>=]'] = $params['rent_price_start'];
        }
        if(!empty($params['rent_price_end'])) {
          $where["AND"]['property.rent_price[<=]'] = $params['rent_price_end'];
        }

        // vat
        if(!empty($params['inc_vat'])) {
          $where["AND"]['property.inc_vat'] = $params['inc_vat'];
        }

        // address_no
        if(!empty($params['address_no'])) {
          $where["AND"]['property.address_no[~]'] = $params['address_no'];
        }

        // status
        if(!empty($params['property_status_id'])) {
          $where["AND"]['property.property_status_id'] = $params['property_status_id'];

          // 99 is empty
          if($params['property_status_id'] == 99) {
            $where["AND"]['property.property_status_id'] = null;
          }
        }

        if(!empty($params['province_id'])) {
          $where["AND"]['property.province_id'] = $params['province_id'];
        }
        if(!empty($params['district_id'])) {
          $where["AND"]['property.district_id'] = $params['district_id'];
        }
        if(!empty($params['sub_district_id'])) {
          $where["AND"]['property.sub_district_id'] = $params['sub_district_id'];
        }

        // zone
        if(!empty($params['zone_id'])) {
          $where["AND"]['property.zone_id'] = $params['zone_id'];
        }

        // web url searh
        if(!empty($params['web_url_search'])) {
          $where["AND"]['property.web_url_search[~]'] = $params['web_url_search'];
        }

        $page = !empty($params['page'])? $params['page']: 1;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";

        if(count($where["AND"]) > 0){
            $where['ORDER'] = $order;
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                "page"=> $page,
                'where'=> ["ORDER"=> $order],
                "limit"=> $limit
            ]);
        }

        $this->_builds($list['data']);

        return $list;
    }

    /**
     * @POST
     */
    public function add () {
        $db = MedooFactory::getInstance();
        $params = $this->reqInfo->params();
        $insert = ArrayHelper::filterKey([
          "property_type_id", "project_id", "address_no", "floors", "size", "size_unit_id", "bedrooms", "bathrooms",
          "requirement_id", "contract_price", "sell_price", "net_sell_price", "rent_price", "net_rent_price", "owner",
          "key_location_id", "zone_id", "road", "province_id", "district_id", "sub_district_id", "bts_id", "mrt_id",
          "airport_link_id", "property_status_id", "contract_expire", "web_status", "property_highlight_id",
          "feature_unit_id", "rented_expire", "inc_vat", "transfer_status_id", "owner", "web_url_search", "room_type_id"
        ], $params);

        $insert = array_map(function($item) {
          if(is_string($item)) {
            $item = trim($item);
          }
          return $item;
        }, $insert);

        if(empty($params['comment'])) {
          return ResposenHelper::error("require comment");
        }
        if(!isset($insert['property_type_id'])) {
          return ResponseHelper::error("require property_type_id");
        }
        if(!empty($insert['project_id']) && !empty($insert['address_no'])) {
          if($db->count("property", "*", [
            "AND"=> [
              "project_id"=> $insert["project_id"],
              "address_no"=> $insert["address_no"]
              ]])  > 0) {
              return ResponseHelper::error("Property ซ้ำ");
          }
        }

        $insert['reference_id'] = $this->_generateReferenceId($insert['property_type_id']);
        if(!$insert['reference_id']) {
          return ResponseHelper::error("property_type_id '{$insert['property_type_id']}' is invalid");
        }

        if(isset($set['contract_expire']) && trim($set['contract_expire']) == "") $set['contract_expire'] = null;
        if(isset($set['contract_expire']) && trim($set['rented_expire']) == "") $set['rented_expire'] = null;

        $now = date('Y-m-d H:i:s');
        $insert['created_at'] = $now;
        $insert['updated_at'] = $now;

        $db->pdo->beginTransaction();
        $id = $db->insert($this->table, $insert);

        if(!$id) {
            return ResponseHelper::error("Error can't add property.");
        }

        $accId = $_SESSION['login']['id'];
        $commentInsert = [
          "property_id"=> $id,
          "comment"=> $params["comment"],
          "comment_by"=> $accId,
          "updated_at"=> $now
        ];

        $db->insert("property_comment", $commentInsert);
        $db->pdo->commit();

        $item = $db->get($this->table, "*", ["id"=> $id]);

        $acc = $db->get("account", "*", ["id"=> $accId]);
        $url = URL::absolute("/admin/properties#/edit/".$id);
        $mailContent = <<<MAILCONTENT
        Property: <a href="{$url}">{$item["reference_id"]}</a> has added by {$acc["name"]}. please check property.
MAILCONTENT;

        $mailHeader = "From: system@agent168th.com\r\n";
        $mailHeader = "To: admin@agent168th.com\r\n";
        $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
        @mail("admin@agent168th.com", "Added property: ".$item["reference_id"], $mailContent, $mailHeader);


        return $item;
    }

    /**
     * @POST
     * @uri /edit/[:id]
     */
    public function edit () {
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
        // $insert = ArrayHelper::filterKey([
        //
        // ], $params);
        $set = $params;
        $set = ArrayHelper::filterKey([
          "property_type_id", "project_id", "address_no", "floors", "size", "size_unit_id", "bedrooms", "bathrooms",
          "requirement_id", "contract_price", "sell_price", "net_sell_price", "rent_price", "net_rent_price", "owner",
          "key_location_id", "zone_id", "road", "province_id", "district_id", "sub_district_id", "bts_id", "mrt_id",
          "airport_link_id", "property_status_id", "contract_expire", "web_status", "property_highlight_id",
          "feature_unit_id", "rented_expire", "inc_vat", "transfer_status_id", "owner", "web_url_search", "room_type_id", "contract_chk_key"
        ], $set);

        $set = array_map(function($item) {
          if(is_string($item)) {
            $item = trim($item);
          }
          return $item;
        }, $set);
        $set['updated_at'] = date('Y-m-d H:i:s');
        if(isset($set['contract_expire']) && trim($set['contract_expire']) == "") $set['contract_expire'] = null;
        if(isset($set['contract_expire']) && trim($set['rented_expire']) == "") $set['rented_expire'] = null;

        if(isset($set['comment'])) {
          unset($set['comment']);
        }

        $where = ["id"=> $id];

        $db = MedooFactory::getInstance();

        if(!(@$_SESSION['login']['level_id'] <= 2 && @$_SESSION['login']['level_id'] > 0)) {
          $set = [
            'updated_at'=> date('Y-m-d H:i:s')
          ];
        }

        $old = $db->get($this->table, "*", $where);
        $updated = $db->update($this->table, $set, $where);

        if(!$updated){
            return ResponseHelper::error("Error can't update property.");
        }

        $commentStr = trim($params['comment']);
        $accId = $_SESSION['login']['id'];
        $db->insert("property_comment",
          [
            "property_id"=> $id,
            "comment"=> $commentStr,
            "comment_by"=> $accId,
            "updated_at"=> date('Y-m-d H:i:s')
            ]);

        // mail when comment
        $acc = $db->get("account", "*", ["id"=> $accId]);
        $url = URL::absolute("/admin/properties#/edit/".$id);
        $mailContent = <<<MAILCONTENT
        Property: <a href="{$url}">{$old["reference_id"]}</a> has comment by {$acc["name"]}. please check property.
MAILCONTENT;

        $mailHeader = "From: system@agent168th.com\r\n";
        $mailHeader = "To: admin@agent168th.com\r\n";
        $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
        @mail("admin@agent168th.com", "Comment property: ".$old["reference_id"], $mailContent, $mailHeader);

        $db->update("request_contact", ["commented"=> 1], [
          "AND"=> [
            "property_id"=> $id,
            "account_id"=> $accId
            ]
          ]);

        return ["success"=> true];
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
            return ResponseHelper::error("Error can't remove property.");
        }

        return ["success"=> true];
    }

    /**
     * @GET
     * @uri /[i:id]/gallery
     */
    public function getGallery(){
        $id = $this->reqInfo->urlParam("id");

        $list = ListDAO::gets("property_image", [
            "limit"=> 100,
            "where"=> [
                "property_id"=> $id
            ]
        ]);

        $this->_buildImages($list["data"]);

        return $list;
    }

    /**
     * @POST
     * @uri /[i:id]/gallery
     */
    public function postGallery(){
        $id = $this->reqInfo->urlParam("id");

        $validator = new \FileUpload\Validator\Simple(1024 * 1024 * 4, ['image/png', 'image/jpg', 'image/jpeg']);
        $pathresolver = new \FileUpload\PathResolver\Simple('public/prop_pic');
        $filesystem = new \FileUpload\FileSystem\Simple();
        $filenamegenerator = new \FileUpload\FileNameGenerator\Random();

        $fileupload = new \FileUpload\FileUpload($_FILES['images'], $_SERVER);
        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);

        $fileupload->setFileNameGenerator($filenamegenerator);

        list($files, $headers) = $fileupload->processAll();

        $db = MedooFactory::getInstance();
        // $ffff = [];
        foreach($files as $file){
            if($file->error == 0){
                $db->insert("property_image", ["property_id"=> $id, "name"=> $file->name]);
                // $ffff[] = $file;
                ImageHelper::makeResizeWatermark($file->path);
            }
        }

        return ["success"=> true];
    }

    /**
     * @GET
     * @uri /[i:id]
     */
    public function get() {
      $id = $this->reqInfo->urlParam("id");
      $db = MedooFactory::getInstance();
      if($this->reqInfo->param("build", false)) {
        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"]
        ];
        $item = $db->get("property", $join, $field, ["property.id"=> $id]);
      }
      else {
        $item = $db->get("property", "*", ["id"=> $id]);
      }
      $this->_build($item);
      return $item;
    }

    public function _builds(&$items)
    {
      foreach($items as &$item) {
        $this->_build($item);
      }
    }

    public function _build(&$item)
    {
      if(@$_SESSION['login']['level_id'] > 2) {
        $item['owner'] = "";
      }
    }

    /**
     * @DELETE
     * @uri /[i:id]/gallery
     */
    public function deleteGallery(){
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->inputs();

        if(!is_array($params['id'])){
            $params['id'] = [$params['id']];
        }

        $db = MedooFactory::getInstance();
        foreach($params['id'] as $imgId){
            $where = ["AND"=> ["property_id"=> $id, "id"=> $imgId]];
            $img = $db->get("property_image", "*", $where);
            $path = "public/prop_pic/".$img["name"];
            @unlink($path);
            $db->delete("property_image", $where);
        }

        return ["success"=> true];
    }

    /**
     * @GET
     * @uri /[i:id]/for_match
     */
    public function getForMatch () {
        $field = [
          "enquiry.*",
          "enquiry_type.name(enquiry_type_name)",
          "enquiry_status.name(enquiry_status_name)",
          "enquiry.id"
      ];
        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]enquiry_type"=> ["enquiry_type_id"=> "id"],
            "[>]enquiry_status"=> ["enquiry_status_id"=> "id"]
        ];
        $where = ["AND"=> []];

        if(@$_SESSION["login"]["level_id"] == 3) {
          $where["AND"]["enquiry.assign_manager_id"] = $_SESSION["login"]["id"];
        }
        else if(@$_SESSION["login"]["level_id"] == 4) {
          $where["AND"]["enquiry.assign_sale_id"] = $_SESSION["login"]["id"];
        }

        $where["ORDER"] = "updated_at DESC";
        $list = ListDAO::gets("enquiry", [
            "field"=> $field,
            "join"=> $join,
            "where"=> $where,
            "limit"=> 100
        ]);

        return $list;
    }

    /**
     * @GET
     * @uri /[i:id]/matched
     */
    public function getMatched () {
      $id = $this->reqInfo->urlParam("id");
      $db = MedooFactory::getInstance();
      // get prop
        $item = $db->get("property", "*", ["id"=> $id]);
        // get enquiry
        $field = [
          "enquiry.*",
          "enquiry_type.name(enquiry_type_name)",
          "enquiry_status.name(enquiry_status_name)",
          "requirement.name_for_enquiry(requirement_name)",
          "enquiry.id"
      ];
        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]enquiry_type"=> ["enquiry_type_id"=> "id"],
            "[>]enquiry_status"=> ["enquiry_status_id"=> "id"]
        ];
        $where = ["AND"=> []];
        $where["AND"]["enquiry.id"] = $item["match_enquiry_id"];
        $where["LIMIT"] = "1";
        $enq = $db->select("enquiry", $join, $field, $where);
        if(!$enq[0]) {
          return ResponseHelper::error("Not found match");
        }

        return $enq[0];
    }

    /**
     * @POST
     * @uri /[i:id]/match
     */
    public function matchEnquiry()
    {
        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $matchId = $this->reqInfo->param("match_enquiry_id");
        if(empty($matchId)) {
          return ResponseHelper::error("require match_enquiry_id");
        }
        $db->update($this->table, ["match_enquiry_id"=> $matchId], ["id"=> $id]);
        return ['success'=> true];
    }

    /**
     * @POST
     * @uri /[i:id]/match/cancle
     */
    public function matchEnquiryCancle()
    {
        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $db->update($this->table, ["match_enquiry_id"=> NULL], ["id"=> $id]);
        return ['success'=> true];
    }

    /**
    * @GET
    * @uri /[i:id]/comment
    */
    public function getComments()
    {
      $id = $this->reqInfo->urlParam("id");
      $list = ListDAO::gets("property_comment", [
          "field"=> [
            "property_comment.*", "account.id(account_id)", "account.name", "account.email",
          ],
          "join"=> [
            "[>]account"=> ["comment_by"=> "id"]
          ],
          "limit"=> 100,
          "where"=> [
              "property_id"=> $id,
              "ORDER"=> "updated_at DESC"
          ]
      ]);

      foreach($list['data'] as &$item) {
        if(is_null($item['account_id'])) {
          $item['name'] = "System";
        }
      }

      return $list;
    }

    /**
     * @GET
     * @uri /project/[i:id]
     */
    public function getProject() {
      $id = $this->reqInfo->urlParam("id");
      $db = MedooFactory::getInstance();

      $item = $db->get("project", "*", ["id"=> $id]);
      $item['province'] = $db->get("province", "*", ["id"=> $item["province_id"]]);
      $item['district'] = $db->get("district", "*", ["id"=> $item["district_id"]]);
      $item['sub_district'] = $db->get("sub_district", "*", ["id"=> $item["sub_district_id"]]);

      $item['bts'] = $db->get("bts", "*", ["id"=> $item["bts_id"]]);
      $item['mrt'] = $db->get("mrt", "*", ["id"=> $item["mrt_id"]]);
      $item['airport_link'] = $db->get("airport_link", "*", ["id"=> $item["airport_link_id"]]);

      $item['zone'] = $db->get("zone", "*", ["id"=> $item["zone_id"]]);
      $item['image_url'] = URL::absolute("/public/project_pic/".$item["image_path"]);

      return $item;
    }


    public function _buildImage(&$item){
        $item['url'] = URL::absolute("/public/prop_pic/".$item['name']);
    }

    public function _buildImages(&$items){
        foreach($items as $key=> $value){
            $this->_buildImage($items[$key]);
        }
    }

    public function _generateReferenceId($propTypeId)
    {
      $db = MedooFactory::getInstance();
      $propType = $db->get("property_type", "*", ["id"=> $propTypeId]);
      if(!$propType) {
        return false;
      }

      $code = "A".$propType["code"];
      $dt = new \DateTime();
      return $this->_generateReferenceId2($code, $dt);
    }

    public function _generateReferenceId2($code, $dt) {
      $dtStr = $code.$dt->format('dmy');

      $db = MedooFactory::getInstance();
      $sql = "SELECT reference_id FROM property WHERE SUBSTRING(reference_id, 1, 8) = '{$dtStr}' ORDER BY reference_id DESC LIMIT 1";
      $r = $db->query($sql);
      $row = $r->fetch(\PDO::FETCH_ASSOC);
      if(!empty($row)) {
        $n = substr($row['reference_id'], -2);
        if($n == '99') {
          $dt->add(new \DateInterval('P1D'));
          return $this->_generateReferenceId2($code, $dt);
        }
        else {
          $n = intval($n) + 1;
          return $code.$dt->format("dmy").sprintf("%02d", $n);
        }
      }
      else {
        return $code.$dt->format("dmy")."00";
      }
    }
}
