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
 * @uri /api/owner
 */
class ApiOwnerCTL extends BaseCTL
{

    /**
     * @GET
     */
    public function getList()
    {
        $db          = MedooFactory::getInstance();
        $params      = $this->reqInfo->params();
        $params['q'] = isset($params['q']) ? '%' . $params['q'] . '%' : '%%';
        $sth         = $db->pdo->prepare('SELECT id, lcase(owner) as value, owner as display FROM owners WHERE owner like :q order by owner limit 100');
        $sth->bindParam(':q', $params['q']);
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

        if ('new' == $params['id'])
        {
            $id = $db->insert('owners', array('owner' => $params['owner']));
        }
        else
        {
            $id = $db->update('owners', array('owner' => $params['owner']), array('id' => $params['id']));
            $id = $params['id'];
        }

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
        $id = $db->delete('owners', array('id' => $id));

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
        $sql     = "SELECT COLUMN_NAME AS cols FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='mng_Owner'";
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

        $accId             = $_SESSION['login']['id'];
        $set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');

        $where = array('id' => $id);

        $updated = $db->update('mng_Owner', $set, $where);

        if ( ! $updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }

        return array('success' => true);
    }

    /**
     * @GET
     * @uri /edit/[:id]
     */
    public function index()
    {
        $db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam('id');

        //$r = $db->query("SELECT * FROM mng_Owner WHERE id = '".$id."' ");
        //$row = $r->fetch(\PDO::FETCH_ASSOC);

        return $row;
    }
}
