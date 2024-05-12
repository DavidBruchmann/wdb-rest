<?php

declare(strict_types=1);

namespace WDB\WdbRest\Domain\Model;

/**
 * Selected Properties of the table `pages`.
 * 
 */
class Page extends \WDB\WdbRest\Domain\AbstractModel
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

	/**
     * subtitle
     *
     * @var string
     */
    protected $subtitle = '';

	/**
     * title
     *
     * @var int
     */
    protected $doktype = 0;

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
	 * @return  string
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * @param   string  $subtitle  subtitle
	 * @return  self
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
		return $this;
	}

	/**
	 * @return  int
	 */
	public function getDoktype() {
		return $this->doktype;
	}

	/**
	 * @param   int  $doktype  doktype
	 * @return  self
	 */
	public function setDoktype($doktype) {
		$this->doktype = $doktype;
		return $this;
	}
}
