<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:27 AM
 */

namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\URL;



/**
 * @Restful
 * @uri /editorial
 */
class EditorialCTL extends BaseCTL {

    private $projects = [];

    /**
     * @GET
     */
    public function index ()
    {
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}
		
		$where = ["AND"=> []];
		$where["AND"]["name[!]"] = '';

		if( isset($params['searchBy']) && !empty($params['searchBy']) ) 
		{
			$where["AND"]['description[~]'] = $params['searchBy'];
		}

		if( isset($params['topic_id']) && !empty($params['topic_id']) ) 
		{
			$where["AND"]['topic_id'] = ( $params['topic_id'] == 1 )? array(1, 3) : $params['topic_id'];
		}
		
		$where["ORDER"] = 'created_at DESC';

		$article = $db->select('article', '*', $where);
		//print_r($db->log());

		$article_idxs = array();
		foreach( $article as &$topic )
		{
			switch( $topic['topic_id'] )
			{
				case '1' : $topic['icon'] = 'post_editorial_icon'; break;
				case '2' : $topic['icon'] = 'post_topic_icon'; break;
				case '3' : $topic['icon'] = 'post_editorial_icon'; break;
				case '4' : $topic['icon'] = 'post_investment_icon'; break;
			}
			
			$topic['total_comment'] = $db->count("article_comment", [
				"article_id" => $topic['id']
			]);

			$topic['date_post'] = date('d M Y', strtotime($topic['created_at']));

			$article_idxs[$topic['id']] = $topic;
		}
		
		$pItems = array('page' => 'editorial', 'act6' => 'act', 'article' => $article_idxs);

		return new HtmlView('/template/layout', $pItems);
    }
	
	/**
     * @GET
	 * @uri /article
     */
    public function article ()
    {
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}
				
		$article = $db->get('article', '*', ['id' => $params['id']]);

		$article['icon'] = 'post_editorial_icon';
		$article['date_post'] = date('d M Y', strtotime($article['created_at']));

		$pItems = array('page' => 'article', 'act6' => 'act', 'article' => $article);

		return new HtmlView('/template/layout', $pItems);
    }

	/**
     * @POST
	 * @uri /feedback
     */
	public function feedback ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$res = array( 'success' => false );

		foreach( $params as &$va )
		{
			$va = filter_var($va, FILTER_SANITIZE_STRING);
		}

		if( empty($_SESSION['member']['name']) || empty($_SESSION['member']['email']) )
		{
			$res['error'] = 'please complete your profile';
			echo json_encode($res);
			return false;
		}

		if( isset($_SESSION['member']) && $params['comment'] != '' && !empty($_SESSION['member']['name']) && !empty($_SESSION['member']['email']) )
		{
			$sth = $db->pdo->prepare('INSERT INTO article_comment SET article_id=:article_id, comment=:comment, comment_by=:comment_by');
		
			$sth->bindParam(':article_id', $params['article_id'], \PDO::PARAM_STR);
			$sth->bindParam(':comment', $params['comment'], \PDO::PARAM_STR);
			$sth->bindParam(':comment_by', $_SESSION['member']['id'], \PDO::PARAM_STR);

			if( $sth->execute() )
			{
				$res['success'] = true;
			}
			else
			{
				$res['success'] = false;
				$res['error'] = 'cannot process';
			}
		}
		else
		{
			$res['error'] = 'empty string';
		}

		echo json_encode($res);
	}

	/**
     * @POST
	 * @uri /getcomment
     */
	public function getcomment ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$sth = $db->pdo->prepare("SELECT 
		  IF(
			TIMESTAMPDIFF(MINUTE, ar.updated_at, NOW()) >= 60,
			CONCAT(
			  TIMESTAMPDIFF(HOUR, ar.updated_at, NOW()),
			  ' hour ago'
			),
			CONCAT(
			  TIMESTAMPDIFF(MINUTE, ar.updated_at, NOW()),
			  ' minute ago'
			)
		  ) AS diff,
		  ar.*,
		  m.name AS comment_byname 
		FROM
		  article_comment ar,
		  member m 
		WHERE ar.comment_by = m.id 
		  AND ar.article_id = :artId
		ORDER BY ar.updated_at DESC ");
		 
		$sth->bindParam(':artId', $params['id'], \PDO::PARAM_INT);
		//$sth->bindParam(':colour', $colour, PDO::PARAM_STR, 12);
		 
		$sth->execute();

		$comment = $sth->fetchAll(\PDO::FETCH_ASSOC); 

		echo json_encode($comment);
	}

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}
}
