<?php

declare(strict_types=1);

namespace WDB\WdbRest\Domain\Model;

use \Nng\Nnrestapi\Domain\Model\AbstractRestApiModel;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Selected Properties of the table `pages`.
 * 
 */
class Category extends AbstractRestApiModel //\WDB\WdbRest\Domain\AbstractModel
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

	/**
     * description
     *
     * @var string
     */
    protected $description = '';

	/**
     * items
     *
     * @var ObjectStorage<Category>
     */
    protected $items = null;

	/**
     * parent
     *
     * @var Category
     */
    protected $parent = null;

    /**
	 * constructor
     * 
	 */
	public function __construct()
	{
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		$this->items = new ObjectStorage();
	}

	/**
	 * @return  string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param   string  $title  title
	 * @return  self
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return  string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param   string  $description  description
	 * @return  self
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return  ?ObjectStorage<Category>
	 */
	public function getItems(): ?ObjectStorage
	{
		return $this->items;
	}

	/**
	 * @param Category $category
     * @return self
	 */
	public function addItem(Category $category)
	{
		if ($this->getItems() === NULL) {
			$this->items = new ObjectStorage();
		}
		$this->items->attach($category);
        return $this;
	}

	/**
	 * @param Category $category
     * @return self
	 */
	public function removeItem(Category $category)
	{
		$this->items->detach($category);
        return $this;
	}

	/**
	 * @param   ObjectStorage  $items  items
	 * @return  self
	 */
	public function setItems(ObjectStorage $items)
	{
		$this->items = $items;
		return $this;
	}

	/**
	 * @return ?Category
	 */
	public function getParent(): ?Category
	{
		return $this->parent;
	}

	/**
	 * @param   Category  $category  parent
	 * @return  self
	 */
	public function setParent(Category $category)
	{
		$this->parent = $category;
		return $this;
	}
}
