<?php

declare(strict_types=1);

namespace WDB\WdbRest\Domain;

use \TYPO3\CMS\Extbase\Domain\Model\FileReference;
use \Nng\Nnrestapi\Domain\Model\AbstractRestApiModel;

/**
 * Common properties of models
 * 
 */
class AbstractModel extends AbstractRestApiModel
{
    /**
     * uid
     *
     * @var int
     */
    protected $uid = '';

    /**
     * pid
     *
     * @var int
     */
    protected $pid = '';

    /**
	 * constructor
     * 
	 */
	public function __construct()
	{
	}

	/**
	 * @return  string
	 */
	public function getUid(): ?int
	{
		return $this->uid;
	}

	/**
	 * @param   string  $uid  uid
	 * @return  self
	 */
	public function setUid(int $uid)
	{
		$this->uid = $uid;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getPid(): ?int
	{
		return $this->pid;
	}

	/**
	 * @param   string  $pid  pid
	 * @return  self
	 */
	public function setPid(int $pid): void
	{
		$this->pid = $pid;
	}
}
