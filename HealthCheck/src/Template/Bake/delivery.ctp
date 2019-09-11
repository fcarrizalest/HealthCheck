<?php
namespace <%= $namespace %>\Delivery;

use Cake\Event\EventListenerInterface;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class <%= $name %>Delivery extends \HealthCheck\Util\DeliveryAbstract implements \HealthCheck\Util\DeliveryInterface
{

    /**
     *  Cada metodo debe ser publico 
     *  Debe terminar con el sufijo Check
     *  El nombre del método debe ser camelCase
     */

    public function ejeUnoParaVerComoSeVeCheck(){

        $message = "Ej";
        $this->addInfo($message);
        $this->addSuccess($message);
        $this->addDanger($message);
        $this->addWarning($message);
   
    }

}