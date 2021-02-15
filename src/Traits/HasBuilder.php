<?php


namespace Aammui\LaravelMedia\Traits;

/**
 * Trait HasBuilder
 * @package Aammui\LaravelMedia\Traits
 */
trait HasBuilder
{
    protected $_collection;

    /**
     * Base URL for media
     *
     * @var $_host
     */
    protected $_host;

    /**
     * @var string $_disk
     */
    protected $_disk = "public";

    /**
     * @var $_query
     */
    protected $_query;

    /** Set download true or false */
    protected $_download;

    /**
     * @var $_extension
     */
    protected $_extension;

    /**
     * @param $name
     *
     * @return $this
     */
    public function toDisk($name)
    {
        $this->_disk = $name;

        return $this;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function toCollection($name)
    {
        $this->_collection = $name;

        return $this;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function fromCollection($name)
    {
        $this->_query['collection'] = $name;

        return $this;
    }

    /**
     * @param string $extension
     *
     * @return $this
     */
    public function setMediaType(string $extension)
    {
        $this->_extension = $extension;

        return $this;
    }

    /**
     * Reset the query parameters.
     */
    public function resetBuilder()
    {
        $this->_collection = null;
        $this->_query      = [];
        $this->_disk       = "public";
        $this->_extension  = null;
        $this->_host       = null;
    }
}
