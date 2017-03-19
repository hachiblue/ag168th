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
 * @uri /api/member/image
 */

class ApiMemberImage extends BaseCTL {

    /**
     * @GET
     */
    public function getGallery()
	{
		$id = $this->reqInfo->param("member_id");

        $list = ListDAO::gets("member", [
            "limit"=> 1,
            "where"=> [
                "id"=> $id
            ]
        ]);

        $this->_buildImages($list["data"]);

        return $list;
    }

    /**
     * @POST
     */
    public function postGallery()
	{
        $id = $this->reqInfo->param("member_id");

        $validator = new \FileUpload\Validator\Simple(1024 * 1024 * 4, ['image/png', 'image/jpg', 'image/jpeg']);
        $pathresolver = new \FileUpload\PathResolver\Simple('public/member_pics');
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
        foreach($files as $file)
		{
            if( $file->completed )
			{
                $db->update("member", ["picture"=> $file->name], ["id"=>$id]);
                ImageHelper::makeResizeWatermark($file->path);
            }
        }

        return ["success"=> true];
    }

    /**
     * @POST
     * @uri /delete
     */
    public function deleteGallery()
	{
        $id = $this->reqInfo->param("member_id");

        $db = MedooFactory::getInstance();
        $where = ["id"=>$id];
		$img = $db->get("member", "*", $where);
		$path = "public/member_pics/".$img["picture"];
		@unlink($path);

		$db->update("member", ["picture"=> ''], ["id"=>$id]);

        return ["success"=> true];
    }

    public function _buildImage(&$item)
	{
        $item['image_url'] = URL::absolute("/public/member_pics/".$item['picture']);
    }

    public function _buildImages(&$items)
	{
        foreach($items as $key=> $value)
		{
            $this->_buildImage($items[$key]);
        }
    }

}
