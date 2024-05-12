<?php

declare(strict_types=1);

namespace WDB\WdbRest\Api;

use Nng\Nnrestapi\Annotations as Api;
use Psr\Http\Message\ResponseInterface;
use WDB\WdbRest\Annotations as WdbRestApi;
// use WDB\WdbRest\Annotations\Content
use WDB\WdbRest\Domain\Repository\ContentRepository;
use WDB\WdbRest\Domain\Model\Content as ContentModel;

/**
 * This annotation registers this class as an Endpoint!
 *  
 * @Api\Endpoint()
 */
class Content extends \Nng\Nnrestapi\Api\AbstractApi 
{
	/**
	 * @var contentRepository
	 */
	private $contentRepository = null;

	/**
	 * Constructor
	 * Inject the ContentRepository. 
	 * Ignore storagePid.
	 * 
	 * @return void
	 */
	public function __construct() 
	{
		$this->contentRepository = \nn\t3::injectClass(ContentRepository::class);
		\nn\t3::Db()->ignoreEnableFields( $this->contentRepository );
	}

	/**
	 * # Retrieve an existing Content
	 * 
	 * Send a simple GET request to retrieve a Content by its uid from the database.
	 * 
	 * Replace `{uid}` with the uid of the Content:
	 * ```
	 * https://www.mysite.com/api/content/{uid}
	 * ```
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * @Api\Label("/api/content/{uid}")
	 * 
	 * @param ContentModel $content
	 * @param int $uid
	 * @return array
	 */
	public function getIndexAction( ContentModel $content = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/content/{uid}`");
		}
		if (!$content) {
			return $this->response->notFound("Content with uid [{$uid}] was not found.");
		}
		return $content;
	}

	/**
	 * # Retrieve ALL Entries 
	 * 
	 * Send a GET request to this endpoint to retrieve ALL Entries from the database.
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * 
	 * @return array
	 */
	public function getAllAction() //: ResponseInterface
	{	
		$result = $this->contentRepository->findAll();
		// debug($result);
		return $result;
	}

	/**
	 * # Create a new Content
	 * 
	 * Send a POST request to this endpoint including a JSON to create a
	 * new Content in the database. You can also upload file(s).
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[tx_wdbrest]")
	 * @WdbRestApi\Content("{'pid':1, 'colPos':0, 'header':'Test', 'assets':['UPLOAD:/file-0']}")
	 * 
	 * @param ContentModel $content
	 * @return array
	 */
	public function postIndexAction( ContentModel $content = null ) //: ResponseInterface
	{	
		$this->contentRepository->add( $content );
		\nn\t3::Db()->persistAll();
		return $content;
	}

	/**
	 * # Update an existing Content
	 * 
	 * Send a PUT request to this endpoint including a JSON to update an
	 * existing Content in the database.
	 * 
	 * You only need to set the fields in the JSON that should be updated.
	 * The data from the JSON will be merged with the data from the persisted Content.
	 *
	 * Replace `{uid}` with the uid of the Content you want to update:
	 * ```
	 * https://www.mysite.com/api/content/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @Api\Label("/api/content/{uid}")
	 * 
	 * @param ContentModel $content
	 * @param int $uid
	 * @return array
	 */
	public function putIndexAction( ContentModel $content = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/content/{uid}`");
		}
		if (!$content) {
			return $this->response->notFound("Content with uid [{$uid}] was not found.");
		}
	
		$this->contentRepository->update( $content );
		\nn\t3::Db()->persistAll();

		return $content;
	}
	
	/**
	 * # Delete a Content
	 * 
	 * Send a DELETE request to this endpoint to delete an existing content.
	 * The method will return a list of all remaining Entries.
	 * 
	 * Replace `{uid}` with the uid of the Content you want to update:
	 * ```
	 * https://www.mysite.com/api/content/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * 
	 * @param ContentModel $content
	 * @param int $uid
	 * @return array
	 */
	public function deleteIndexAction( ContentModel $content = null, int $uid = null ) //: ResponseInterface
	{	
		if (!$content) {
			return $this->response->notFound("Content with uid [{$uid}] was not found.");
		}
		
		$this->contentRepository->remove( $content );
		\nn\t3::Db()->persistAll();

		$result = $this->contentRepository->findAll();
		return $result;
	}

}
