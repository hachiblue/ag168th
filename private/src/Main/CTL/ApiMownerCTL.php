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
 * @uri /api/mowner
 */
class ApiMownerCTL extends BaseCTL
{

    /**
     * @GET
     * @uri /[i:id]
     */
    public function getList()
    {
        $db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam('id');

        $r = $db->query("SELECT lcase(owner) as owner FROM owners WHERE id = '".$id."' ");
        $mrow = $r->fetch(\PDO::FETCH_ASSOC);

        $sth = $db->pdo->prepare('SELECT id, lcase(owner) as value, owner as title FROM owners WHERE id != :q order by owner');
        $sth->bindParam(':q', $id);
        $sth->execute();
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        $rows = $sth->fetchALl();

        $simtext = array();
        foreach( $rows as $row )
        {
            similar_text($mrow['owner'], $row['title'], $percent); 
            if( $percent > 75 )
            {
                $simtext[] = $row;
            }
        }

        return $simtext;
    }

    /**
     * @POST
     */
    public function update()
    {
        $db     = MedooFactory::getInstance();
        $params = $this->reqInfo->params();

        $db->pdo->beginTransaction();

        $toid = $params['toid'];
        $fromid = $params['fromid'];

        $r = $db->query("SELECT lcase(owner) as owner FROM owners WHERE id = '".$toid."' ");
        $mrow = $r->fetch(\PDO::FETCH_ASSOC);

        foreach( $fromid as $ow )
        {
            if( $toid != $ow['id'] )
            {
                $id = $db->update('property', array('owner_id' => $toid, 'owner' => $mrow['owner']), array('owner_id' => $ow['id']));
                $db->delete('owners', array('id' => $ow['id']));
            }
        }

        /*. print_r($db->log(), true)*/

        $db->pdo->commit();

        return true;
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
