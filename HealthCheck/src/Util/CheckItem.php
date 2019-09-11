<?php
namespace HealthCheck\Util;

use \Cake\Utility\Inflector;

class CheckItem
{
    private $_name = null;
    private $_parentId;
    public function __construct($parentId, $name)
    {
        $this->_name = $name;
        $this->_parentId = $parentId;
    }

    public function getId()
    {
        return $this->_parentId."-".Inflector::underscore($this->_name);
    }

    public function getParentId()
    {
        return $this->_parentId;
    }

    public function getName()
    {
        $name = basename($this->_name, 'Check');

        $name = Inflector::underscore($name);
        
        return  Inflector::humanize($name);
    }
}
