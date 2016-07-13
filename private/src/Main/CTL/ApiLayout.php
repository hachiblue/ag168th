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
use Main\Helper\LastAssignManagerHelper;
use Main\Helper\ImageHelper;

/**
 * @Restful
 * @uri /api/layout
 */
class ApiLayout extends BaseCTL
{
    private static $table = "layout";
    /**
     * @GET
     */
    public function index()
    {
      return self::_index();
    }

    /**
     * @POST
     */
    public function set()
    {
      $params = $this->reqInfo->params();
      return self::_set($params['key'], $params['val']);
    }

    /**
     * @POST
     * @uri /slide1
     */
    public function addSlide1()
    {
      $validator = new \FileUpload\Validator\Simple(1024 * 1024 * 4, ['image/png', 'image/jpg', 'image/jpeg']);
      $pathresolver = new \FileUpload\PathResolver\Simple('public/slide_1');
      $filesystem = new \FileUpload\FileSystem\Simple();
      $filenamegenerator = new \FileUpload\FileNameGenerator\Random();

      $fileupload = new \FileUpload\FileUpload($_FILES['image'], $_SERVER);
      $fileupload->setPathResolver($pathresolver);
      $fileupload->setFileSystem($filesystem);
      $fileupload->addValidator($validator);

      $fileupload->setFileNameGenerator($filenamegenerator);

      list($files, $headers) = $fileupload->processAll();

      $slides = self::_get("slide_1");
      $slides = json_decode($slides);

      $db = MedooFactory::getInstance();
      foreach($files as $file){
          if($file->completed){
              // $db->insert("project_image", ["project_id"=> $id, "image_path"=> $file->name]);
              // $ffff[] = $file;
              $slides[] = $file->name;
              // ImageHelper::makeResizeWatermark($file->path);
          }
      }

      self::_set("slide_1", json_encode($slides));

      return ["success"=> true];
    }

    /**
     * @POST
     * @uri /slide1/delete
     */
    public function deleteSlide1()
    {
      $params = $this->reqInfo->params();
      $delItems = json_decode($params["images"]);

      $slides = self::_get("slide_1");
      $slides = json_decode($slides);


      foreach($delItems as $val) {
        if(($key = array_search($val, $slides)) !== false) {
          unset($slides[$key]);
          if(is_file('public/slide_1/'.$val))
            @unlink('public/slide_1/'.$val);
        }
      }

      $newSlides = [];
      foreach($slides as $key=> $val) { $newSlides[] = $val; }

      self::_set("slide_1", json_encode($newSlides));

      return ['success'=> true];
    }

    public static function _index()
    {
      $db = MedooFactory::getInstance();
      $items = $db->select(self::$table, "*");
      $json = [];
      foreach($items as $key=> $val) {
        $json[$val['key']] = $val['val'];
      }
      return $json;
    }

    public static function _set($key, $val)
    {
      $db = MedooFactory::getInstance();
      if($db->count(self::$table, ['key'=> $key]) > 0) {
        $db->update(self::$table, ['val'=> $val], ['key'=> $key]);
      }
      else {
        $db->insert(self::$table, ['key'=> $key, 'val'=> $val]);
      }

      return ['success'=> true];
    }

    public static function _get($key)
    {
      $db = MedooFactory::getInstance();
      $item = $db->get(self::$table, "*", ['key'=> $key]);

      return isset($item['val'])? $item['val']: "";
    }
}
