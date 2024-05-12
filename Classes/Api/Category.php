<?php

declare(strict_types=1);

namespace WDB\WdbRest\Api;

use Nng\Nnrestapi\Annotations as Api;
use Psr\Http\Message\ResponseInterface;
use WDB\WdbRest\Annotations as WdbRestApi;
use WDB\WdbRest\Domain\Repository\CategoryRepository;
use WDB\WdbRest\Domain\Model\Category as CategoryModel;

/**
 * This annotation registers this class as an Endpoint!
 *  
 * @Api\Endpoint()
 */
class Category extends \Nng\Nnrestapi\Api\AbstractApi 
{
	/**
	 * @var categoryRepository
	 */
	private $categoryRepository = null;

	/**
	 * Constructor
	 * Inject the categoryRepository. 
	 * Ignore storagePid.
	 * 
	 * @return void
	 */
	public function __construct() 
	{
		$this->categoryRepository = \nn\t3::injectClass(CategoryRepository::class);
		\nn\t3::Db()->ignoreEnableFields( $this->categoryRepository );
	}

	/**
	 * # Retrieve an existing Category
	 * 
	 * Send a simple GET request to retrieve a Category by its uid from the database.
	 * 
	 * Replace `{uid}` with the uid of the Category:
	 * ```
	 * https://www.mysite.com/api/category/{uid}
	 * ```
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * @Api\Label("/api/category/{uid}")
	 * 
	 * @param CategoryModel $category
	 * @param int $uid
	 * @return array
	 */
	public function getIndexAction( CategoryModel $category = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/category/{uid}`");
		}
		if (!$category) {
			return $this->response->notFound("Category with uid [{$uid}] was not found.");
		}
		return $category;
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
		$result = $this->categoryRepository->findAll();
		return $result;
	}

	/**
	 * # Create a new Category
	 * 
	 * Send a POST request to this endpoint including a JSON to create a
	 * new Category in the database. You can also upload file(s).
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @WdbRestApi\Category("{'title':'Category', 'files':['UPLOAD:/file-0']}");
	 * 
	 * @param CategoryModel $category
	 * @return array
	 */
	public function postIndexAction( CategoryModel $category = null ) //: ResponseInterface
	{	
		$this->categoryRepository->add( $category );
		\nn\t3::Db()->persistAll();
		return $category;
	}

	/**
	 * # Update an existing Category
	 * 
	 * Send a PUT request to this endpoint including a JSON to update an
	 * existing Category in the database.
	 * 
	 * You only need to set the fields in the JSON that should be updated.
	 * The data from the JSON will be merged with the data from the persisted Category.
	 *
	 * Replace `{uid}` with the uid of the Category you want to update:
	 * ```
	 * https://www.mysite.com/api/category/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @Api\Label("/api/category/{uid}")
	 * 
	 * @param CategoryModel $category
	 * @param int $uid
	 * @return array
	 */
	public function putIndexAction( CategoryModel $category = null, int $uid = null ) //: ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/category/{uid}`");
		}
		if (!$category) {
			return $this->response->notFound("Category with uid [{$uid}] was not found.");
		}
	
		$this->categoryRepository->update( $category );
		\nn\t3::Db()->persistAll();

		return $category;
	}
	
	/**
	 * # Delete a Category
	 * 
	 * Send a DELETE request to this endpoint to delete an existing category.
	 * The method will return a list of all remaining Entries.
	 * 
	 * Replace `{uid}` with the uid of the Category you want to update:
	 * ```
	 * https://www.mysite.com/api/category/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * 
	 * @param CategoryModel $category
	 * @param int $uid
	 * @return array
	 */
	public function deleteIndexAction( CategoryModel $category = null, int $uid = null ) //: ResponseInterface
	{	
		if (!$category) {
			return $this->response->notFound("Category with uid [{$uid}] was not found.");
		}
		
		$this->categoryRepository->remove( $category );
		\nn\t3::Db()->persistAll();

		$result = $this->categoryRepository->findAll();
		return $result;
	}

}

