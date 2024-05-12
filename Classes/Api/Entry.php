<?php

declare(strict_types=1);

namespace WDB\WdbRest\Api;

use Nng\Nnrestapi\Annotations as Api;
use Psr\Http\Message\ResponseInterface;
use WDB\WdbRest\Domain\Repository\EntryRepository;
use WDB\WdbRest\Domain\Model\Entry as EntryModel;

/**
 * This annotation registers this class as an Endpoint!
 *  
 * @Api\Endpoint()
 */
class Entry extends \Nng\Nnrestapi\Api\AbstractApi 
{
	/**
	 * @var EntryRepository
	 */
	private $entryRepository = null;

	/**
	 * Constructor
	 * Inject the EntryRepository. 
	 * Ignore storagePid.
	 * 
	 * @return void
	 */
	public function __construct() 
	{
		$this->entryRepository = \nn\t3::injectClass( EntryRepository::class );
		\nn\t3::Db()->ignoreEnableFields( $this->entryRepository );
	}

	/**
	 * # Retrieve an existing Entry
	 * 
	 * Send a simple GET request to retrieve an Entry by its uid from the database.
	 * 
	 * Replace `{uid}` with the uid of the Entry:
	 * ```
	 * https://www.mysite.com/api/entry/{uid}
	 * ```
	 * 
	 * @Api\Access("public")
	 * @Api\Localize()
	 * @Api\Label("/api/entry/{uid}")
	 * 
	 * @param EntryModel $entry
	 * @param int $uid
	 * @return array
	 */
	public function getIndexAction( EntryModel $entry = null, int $uid = null ) // : ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/entry/{uid}`");
		}
		if (!$entry) {
			return $this->response->notFound("Example with uid [{$uid}] was not found.");
		}
		return $entry;
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
	public function getAllAction() // : ResponseInterface
	{	
		$result = $this->entryRepository->findAll();
		return $result;
	}

	/**
	 * # Create a new Entry
	 * 
	 * Send a POST request to this endpoint including a JSON to create a
	 * new Entry in the database. You can also upload file(s).
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @Api\Example("{'title':'Example', 'files':['UPLOAD:/file-0']}");
	 * 
	 * @param EntryModel $entry
	 * @return array
	 */
	public function postIndexAction( EntryModel $entry = null ) // : ResponseInterface
	{	
		$this->entryRepository->add( $entry );
		\nn\t3::Db()->persistAll();
		return $entry;
	}

	/**
	 * # Update an existing Entry
	 * 
	 * Send a PUT request to this endpoint including a JSON to update an
	 * existing Entry in the database.
	 * 
	 * You only need to set the fields in the JSON that should be updated.
	 * The data from the JSON will be merged with the data from the persisted Entry.
	 *
	 * Replace `{uid}` with the uid of the Entry you want to update:
	 * ```
	 * https://www.mysite.com/api/entry/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * @Api\Upload("config[extname]")
	 * @Api\Label("/api/entry/{uid}")
	 * 
	 * @param EntryModel $entry
	 * @param int $uid
	 * @return array
	 */
	public function putIndexAction( EntryModel $entry = null, int $uid = null ) // : ResponseInterface
	{
		if (!$uid) {
			return $this->response->notFound("No uid passed in URL. Send the request with `api/entry/{uid}`");
		}
		if (!$entry) {
			return $this->response->notFound("Example with uid [{$uid}] was not found.");
		}
	
		$this->entryRepository->update( $entry );
		\nn\t3::Db()->persistAll();

		return $entry;
	}
	
	/**
	 * # Delete an Entry
	 * 
	 * Send a DELETE request to this endpoint to delete an existing entry.
	 * The method will return a list of all remaining Entries.
	 * 
	 * Replace `{uid}` with the uid of the Entry you want to update:
	 * ```
	 * https://www.mysite.com/api/entry/{uid}
	 * ```
	 * 
	 * You __must be logged in__ as a frontend OR backend user to access 
	 * this endpoint.
	 * 
	 * @Api\Access("be_users,fe_users")
	 * 
	 * @param EntryModel $entry
	 * @param int $uid
	 * @return array
	 */
	public function deleteIndexAction( EntryModel $entry = null, int $uid = null ) // : ResponseInterface
	{	
		if (!$entry) {
			return $this->response->notFound("Example with uid [{$uid}] was not found.");
		}
		
		$this->entryRepository->remove( $entry );
		\nn\t3::Db()->persistAll();

		$result = $this->entryRepository->findAll();
		return $result;
	}

}