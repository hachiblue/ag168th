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
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();

		$item = array();
		$sth = $db->pdo->prepare('select w.*, GROUP_CONCAT(wp.property_reference_id) as ref, GROUP_CONCAT(wp.id) as ref_id from wm_topic w left join wm_property wp on w.id = wp.wm_topic_id GROUP BY w.id');
		$sth->execute(); 

		$item = $sth->fetchAll(\PDO::FETCH_ASSOC);

		echo json_encode($item);
	}


    /**
     * @POST
     */
    public function save () 
	{
		$params = $this->reqInfo->params();

		$db = MedooFactory::getInstance();

        $item = array();
		$item['success'] = false;
		
		$props = substr($params['props'], 0, -3);
		$props_id = substr($params['props_id'], 0, -3);

		if( $params['topic_id'] == 'new' )
		{
			$last_id = $db->insert("wm_topic", [
				"name" => $params['topic']
			]);

			$item['success'] = true;
			$item['last_id'] = $last_id;

			$pp = explode('#|#', $props);
			foreach( $pp as $ref )
			{
				$db->insert("wm_property", [
					"wm_topic_id" => $last_id,
					"property_reference_id" => $ref
				]);
			}
		}
		else
		{
			$sth = $db->pdo->prepare('UPDATE wm_topic SET name = :name WHERE id = :id');
			 
			$sth->bindParam(':name', $params['topic'], \PDO::PARAM_STR);
			$sth->bindParam(':id', $params['topic_id'], \PDO::PARAM_INT);
			 
			if( $sth->execute() )
			{
				$db->delete("wm_property", [ "wm_topic_id" => $params['topic_id'] ]);

				$pp = explode('#|#', $props);
				foreach( $pp as $ref )
				{
					$db->insert("wm_property", [
						"wm_topic_id" => $params['topic_id'],
						"property_reference_id" => $ref
					]);
				}

				$item['success'] = true;
			}
		}

		//$item = $sth->fetchAll(\PDO::FETCH_ASSOC);

		echo json_encode($item);
    }


	/**
     * @POST
     * @uri /delete
     */
	public function delete () 
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();	

		$db->delete("wm_topic", [ "id" => $params['id'] ]);
		$db->delete("wm_property", [ "wm_topic_id" => $params['id'] ]);

		print_r($params);
	}

}
