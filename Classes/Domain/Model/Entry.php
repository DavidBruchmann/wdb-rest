<?php

declare(strict_types=1);

namespace WDB\WdbRest\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * A simple Model to test things with.
 * 
 */
class Entry extends \WDB\WdbRest\Domain\AbstractModel
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * @var ObjectStorage<FileReference>
     */
    protected $files;

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
		$this->files = new ObjectStorage();
	}

	/**
	 * @return  string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param   string  $title  title
	 * @return  self
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

    /**
	 * @return ObjectStorage
	 */
	public function getFiles() {
		return $this->files;
	}
	
	/**
	 * @param ObjectStorage $files
	 * @return self
	 */
	public function setFiles(ObjectStorage $files) {
		$this->files = $files;
        return $this;
	}

	/**
	 * @param FileReference $file
     * @return self
	 */
	public function addFile(FileReference $file) {
		if ($this->getFiles() === NULL) {
			$this->files = new ObjectStorage();
		}
		$this->files->attach($file);
        return $this;
	}

	/**
	 * @param FileReference $file
     * @return self
	 */
	public function removeFile(FileReference $file) {
		if ($this->getFiles() === NULL) {
			// $this->files = new ObjectStorage();
			return $this;
		}
		$this->files->detach($file);
        return $this;
	}
}
