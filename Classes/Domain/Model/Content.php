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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $assets;

    /**
     * colPos
     *
     * @var int
     */
    protected $colPos = 0;

    /**
     * pid
	 * repeating it here avoids that the unchanged value
	 * is shown despite the command to change it.
     *
     * @var int
     */
    protected $pid = 0;
 
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
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getAssets() {
	   return $this->assets;
	}
 
	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $assets
	 * @return self
	 */
	public function setAssets(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $assets) {
	   $this->assets = $assets;
	   return $this;
	}

	/**
	 * @return  int
	 */
	public function getColPos() {
		return $this->colPos;
	}

	/**
	 * @param   int  $colPos  colPos
	 * @return  self
	 */
	public function setColPos($colPos) {
		$this->colPos = $colPos;
		return $this;
	}

	/**
	 * @return  int
	 */
	public function getPid(): ?int
	{
		return $this->colPos;
	}

	/**
	 * @param   int  $pid  pid
	 * @return  void
	 */
	public function setPid($pid): void
	{
		$this->pid = $pid;
	}
}
