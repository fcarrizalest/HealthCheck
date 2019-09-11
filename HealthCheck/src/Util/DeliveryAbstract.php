<?php

namespace HealthCheck\Util;

use \Cake\Utility\Inflector;

abstract class DeliveryAbstract
{
    protected $_inform = [
        
    ];

    protected $_check= null;

    protected $_types = [
        'info',
        'success',
        'danger',
        'warning'

    ];

    protected function getClassName()
    {
        $class = get_class($this);

        if (preg_match('/\\\\([\w]+)$/', $class, $matches)) {
            $class = $matches[1];
        }
        return $class;
    }

    public function getId()
    {
        $class = $this->getClassName();

        return  Inflector::underscore($class);
    }

    public function getName()
    {
        $class  = $this->getClassName();
        $class = basename($class, 'Delivery');

        $class = Inflector::underscore($class);
        
        return  Inflector::humanize($class);
    }

    public function getCheckList()
    {
        $array = [];
        $methods = get_class_methods($this);

        $pattern = '/Check$/';
        foreach ($methods as $method) {
            if (preg_match($pattern, $method)) {
                $array[]  = new CheckItem($this->getId(), $method);
            }
        }

        return $array;
    }

    public function getInform()
    {
        return $this->_inform;
    }

    protected function add($type, $message)
    {
        if (in_array($type, $this->_types)) {
            $check = $this->getCheckItem();


            $this->_inform[] = [ 'title' => $this->getName().'-'.$check->getName(),  'type' => $type , 'message' => $message  ];
        }
    }

    protected function addInfo($message)
    {
        $this->add('info', $message);
    }

    protected function addSuccess($message)
    {
        $this->add('success', $message);
    }

    protected function addDanger($message)
    {
        $this->add('danger', $message);
    }

    protected function addWarning($message)
    {
        $this->add('warning', $message);
    }

    protected function setCheckItem(CheckItem $check)
    {
        $this->_check = $check;
    }

    protected function getCheckItem()
    {
        return $this->_check;
    }

    public function run($test)
    {
        $test = Inflector::camelize($test);

        if (!method_exists($this, $test)) {
            throw new \Exception("Test No Found", 1);
        }

        $this->setCheckItem(new CheckItem($this->getId(), $test));

        $this->{$test}();
    }
}
