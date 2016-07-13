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
 * @uri /api/project/image
 */

class ApiProjectImage extends BaseCTL {
    /**
     * @GET
     */
    public function getGallery(){
        $id = $this->reqInfo->param("project_id");

        $list = ListDAO::gets("project_image", [
            "limit"=> 100,
            "where"=> [
                "project_id"=> $id
            ]
        ]);

        $this->_buildImages($list["data"]);

        return $list;
    }

    /**
     * @POST
     */
    public function postGallery(){
        $id = $this->reqInfo->param("project_id");

        $validator = new \FileUpload\Validator\Simple(1024 * 1024 * 4, ['image/png', 'image/jpg', 'image/jpeg']);
        $pathresolver = new \FileUpload\PathResolver\Simple('public/project_pics');
        $filesystem = new \FileUpload\FileSystem\Simple();
        $filenamegenerator = new \FileUpload\FileNameGenerator\Random();

        $fileupload = new \FileUpload\FileUpload($_FILES['image'], $_SERVER);
        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);

        $fileupload->setFileNameGenerator($filenamegenerator);

        list($files, $headers) = $fileupload->processAll();

        $db = MedooFactory::getInstance();
        // $ffff = [];
        $res = [];
        foreach($files as $file){
            if($file->completed){
                $db->insert("project_image", ["project_id"=> $id, "image_path"=> $file->name]);
                // $ffff[] = $file;
                ImageHelper::makeResizeWatermark($file->path);
            }
        }

        return ["success"=> true];
    }

    /**
     * @POST
     * @uri /delete
     */
    public function deleteGallery(){
        $id = $this->reqInfo->param("project_id");
        $listId = $this->reqInfo->param("list_id");

        if(!is_array($listId)){
            $listId = [$listId];
        }

        $db = MedooFactory::getInstance();
        foreach($listId as $imgId){
            $where = ["AND"=> ["project_id"=> $id, "id"=> $imgId]];
            $img = $db->get("project_image", "*", $where);
            $path = "public/project_pics/".$img["image_path"];
            @unlink($path);
            $db->delete("project_image", $where);
        }

        return ["success"=> true];
    }

    public function _buildImage(&$item){
        $item['image_url'] = URL::absolute("/public/project_pics/".$item['image_path']);
    }

    public function _buildImages(&$items){
        foreach($items as $key=> $value){
            $this->_buildImage($items[$key]);
        }
    }

}
