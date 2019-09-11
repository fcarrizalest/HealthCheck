<?php

namespace HealthCheck\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;

class DeliveryTask extends SimpleBakeTask
{
    public $pathFragment = 'Delivery/';
    //public $plugin = 'HealthCheck';
    public function name()
    {
        return 'Delivery';
    }

    public function fileName($name)
    {
        return $name . 'Delivery.php';
    }

    public function template()
    {
        return 'HealthCheck.delivery';
    }
}
