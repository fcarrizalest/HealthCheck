<?php
namespace HealthCheck\Delivery;

class Entregable1Delivery extends \HealthCheck\Util\DeliveryAbstract implements \HealthCheck\Util\DeliveryInterface
{
    public function story145Check()
    {
        if (!defined('CAR')) {
            $this->addDanger('Variable CAR no esta definidad');
        }

        $this->addInfo('Hay que darle permisos a   ');
    }
}
