<?php

declare(strict_types=1);

namespace WDB\WdbRest\Api;

use Nng\Nnrestapi\Annotations as Api;
use Psr\Http\Message\ResponseInterface;
use WDB\WdbRest\Annotations as WdbRestApi;
use WDB\WdbRest\Domain\Repository\PageRepository;
use WDB\WdbRest\Domain\Model\Page as PageModel;

/**
 * This annotation registers this class as an Endpoint!
 *  
 * @Api\Endpoint()
 */
class Page extends \Nng\Nnrestapi\Api\AbstractApi 
{
	/**
	 * @var pageRepository
	 */
	private $pageRepository = null;

	/**
	 * Constructor
	 * Inject the PageRepository. 
	 * Ignore storagePid.
	 * 
	 * @return void
	 */
	public function __construct() 
	{
		$this->pageRepository = \nn\t3::injectClass(PageRepository::class);
		\nn\t3::Db()->ignoreEnableFields( $this->pageRepository );
	}

	/**
	 * # Retrieve an existing Page
	 * 
	 * Send a simple GET request to retrieve an Page by its uid from the database.
	 * 
	 * Replace `{uid}` with the uid of the Page:
	 * ```
	 * https://www.mysite.com/api/page/{uid}
	 * ```
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * @Api\Label("/api/page/{uid}")
	 * 
	 * @param PageModel $page
	 * @param int $uid
	 * @return array
	 */
	public function getIndexAction( PageModel $page = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/page/{uid}`");
		}
		if (!$page) {
			return $this->response->notFound("Page with uid [{$uid}] was not found.");
		}
		return $page;
	}

	/**
	 * # Retrieve ALL Pages 
	 * 
	 * Send a GET request to this endpoint to retrieve ALL Pages from the database.
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * 
	 * @return array
	 */
	public function getAllAction() //: ResponseInterface
	{	
		$result = $this->pageRepository->findAll();
		return $result;
	}

	/**
	 * # Create a new Page
	 * 
	 * Send a POST request to this endpoint including a JSON to create a
	 * new Page in the database. You can also upload file(s).
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @WdbRestApi\Page("{'title':'Page', 'files':['UPLOAD:/file-0']}");
	 * 
	 * @param PageModel $page
	 * @return array
	 */
	public function postIndexAction( PageModel $page = null ) //: ResponseInterface
	{	
		$this->pageRepository->add( $page );
		\nn\t3::Db()->persistAll();
		return $page;
	}

	/**
	 * # Update an existing Page
	 * 
	 * Send a PUT request to this endpoint including a JSON to update an
	 * existing Page in the database.
	 * 
	 * You only need to set the fields in the JSON that should be updated.
	 * The data from the JSON will be merged with the data from the persisted Page.
	 *
	 * Replace `{uid}` with the uid of the Page you want to update:
	 * ```
	 * https://www.mysite.com/api/page/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @Api\Label("/api/page/{uid}")
	 * 
	 * @param PageModel $page
	 * @param int $uid
	 * @return array
	 */
	public function putIndexAction( PageModel $page = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/page/{uid}`");
		}
		if (!$page) {
			return $this->response->notFound("Page with uid [{$uid}] was not found.");
		}
	
		$this->pageRepository->update( $page );
		\nn\t3::Db()->persistAll();

		return $page;
	}
	
	/**
	 * # Delete an Page
	 * 
	 * Send a DELETE request to this endpoint to delete an existing page.
	 * The method will return a list of all remaining Entries.
	 * 
	 * Replace `{uid}` with the uid of the Page you want to update:
	 * ```
	 * https://www.mysite.com/api/page/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * 
	 * @param PageModel $page
	 * @param int $uid
	 * @return array
	 */
	public function deleteIndexAction( PageModel $page = null, int $uid = null ) //: ResponseInterface
	{	
		if (!$page) {
			return $this->response->notFound("Page with uid [{$uid}] was not found.");
		}
		
		$this->pageRepository->remove( $page );
		\nn\t3::Db()->persistAll();

		$result = $this->pageRepository->findAll();
		return $result;
	}

}
