<?php

namespace Main\CTL;

use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ImageHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;

/**
 * @Restful
 * @uri /api/timetable
 */
class ApiTimetableCTL extends BaseCTL
{

    /**
     * @GET
     */
    public function getList()
    {
        $accId  = $_SESSION['login']['id'];
        $db     = MedooFactory::getInstance();
        $params = $this->reqInfo->params();

        if (4 == $_SESSION['login']['level_id'])
        {
            $sth = $db->pdo->prepare('select t.*, p.name as project from timetables t left join project p on t.project_id = p.id where t.sale_id=:sid');
            $sth->bindParam(':sid', $accId);
        }

        if (8 == $_SESSION['login']['level_id'])
        {
            $sth = $db->pdo->prepare('select t.*, p.name as project from timetables t left join project p on t.project_id = p.id order by t.id');
        }

        $sth->execute();
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        $rows = $sth->fetchALl();

        return $rows;
    }

    /**
     * @POST
     */
    public function add()
    {
        $db     = MedooFactory::getInstance();
        $params = $this->reqInfo->params();

        $db->pdo->beginTransaction();

        unset($params['project']);

        $accId                = $_SESSION['login']['id'];
        $accName              = $_SESSION['login']['name'];
        $params['updated_at'] = date('Y-m-d H:i:s');
        $params['sale_id']    = $accId;
        $params['sale']       = $accName;

        $id = $db->insert('timetables', $params);
        // print_r($db->log());
        if ( ! $id)
        {
            return ResponseHelper::error("Error can't add form.");
        }

        $db->pdo->commit();

        return $id;
    }

    /**
     * @POST
     * @uri /delete/[i:id]
     */
    public function delete()
    {
        $id = $this->reqInfo->urlParam('id');

        $db = MedooFactory::getInstance();
        $id = $db->delete('Timetables', array('id' => $id));

        if ( ! $id)
        {
            return ResponseHelper::error("Error can't remove property.");
        }

        return array('success' => true);
    }

    /**
     * @POST
     * @uri /edit/[:id]
     */
    public function edit()
    {
        $db      = MedooFactory::getInstance();
        $id      = $this->reqInfo->urlParam('id');
        $params  = $this->reqInfo->params();
        $sql     = "SELECT COLUMN_NAME AS cols FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='timetables'";
        $r       = $db->query($sql);
        $rows    = $r->fetchAll(\PDO::FETCH_ASSOC);
        $columns = array();

        foreach ($rows as $row)
        {
            $columns[] = $row['cols'];
        }

        $set = ArrayHelper::filterKey($columns, $params);

        $set = array_map(function ($item)
        {
            if (is_string($item))
            {
                $item = trim($item);
            }
            return $item;
        }, $set);

        unset($set['id']);
        unset($set['project']);
        unset($set['created_at']);
        unset($set['updated_at']);

        $accId             = $_SESSION['login']['id'];
        $set['updated_at'] = date('Y-m-d H:i:s');
        //$set['sale_id'] = $accId;

        $where = array('id' => $id);

        $updated = $db->update('timetables', $set, $where);

        if ( ! $updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }

        return array('success' => true);
    }

    /**
     * @GET
     * @uri /project/[:id]
     */
    public function getProjectByRef()
    {
        $db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam('id');


        $sth = $db->pdo->prepare('SELECT j.name AS project, j.id as project_id FROM property p, project j WHERE p.project_id = j.id AND p.reference_id = :ref');
        $sth->bindParam(':ref', $id);
        $sth->execute();
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $sth->fetch();

        return $row;
    }
}
