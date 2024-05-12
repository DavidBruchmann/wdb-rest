<?php

declare(strict_types=1);

namespace WDB\WdbRest\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Selected Properties of the table `tt_content`.
 * 
 */
class Content extends \WDB\WdbRest\Domain\AbstractModel
{
    /**
     * header
     *
     * @var string
     */
    protected $header = '';

    /**
     * subheader
     *
     * @var string
     */
    protected $subheader = '';

    /**
     * bodytext
     *
     * @var string
     */
    protected $bodytext = '';

    /**
     * cType
     *
     * @var string
     */
    protected $cType = '';

    /**
     * listType
     *
     * @var string
     */
    protected $listType = '';

	/**
	 * @var ObjectStorage<FileReference>
	 */
	protected $assets;
 
	/**
	 * constructor
	 *
	 */
	public function __construct() {
	   $this->initStorageObjects();
	}
 
	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
	   $this->assets = new ObjectStorage();
	}

	/**
	 * @return  string
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * @param   string  $header  header
	 * @return  self
	 */
	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getSubheader() {
		return $this->subheader;
	}

	/**
	 * @param   string  $subheader  subheader
	 * @return  self
	 */
	public function setSubheader($subheader) {
		$this->subheader = $subheader;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * @param   string  $bodytext  bodytext
	 * @return  self
	 */
	public function setBodytext($bodytext) {
		$this->bodytext = $bodytext;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getCType() {
		return $this->cType;
	}

	/**
	 * @param   string  $cType  cType
	 * @return  self
	 */
	public function setCType($cType) {
		$this->cType = $cType;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getListType() {
		return $this->listType;
	}

	/**
	 * @param   string  $listType  listType
	 * @return  self
	 */
	public function setListType($listType) {
		$this->listType = $listType;
		return $this;
	}

	/**
	 * @return ObjectStorage
	 */
	public function getAssets() {
	   return $this->assets;
	}
 
	/**
	 * @param ObjectStorage $assets
	 * @return self
	 */
	public function setAssets(ObjectStorage $assets) {
	   $this->assets = $assets;
	   return $this;
	}
}
