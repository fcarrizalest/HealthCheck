<?php
namespace HealthCheck\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
use Cake\Core\Plugin;
use Cake\Filesystem\Folder;
use Cake\Core\Configure;

/**
 * Check component
 */
class CheckComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $_type =  'Delivery';
    protected $_deliveries = [];


    public function initialize(array $config)
    {
        $paths = App::path($this->_type);

        foreach ($paths as $path) {
            $Folder = new Folder($path);
            $res = array_merge($this->_deliveries, $Folder->find('.+'.$this->_type.'\.php'));
            foreach ($res as &$r) {
                $r = basename($r, $this->_type.'.php');
            }
            $this->_deliveries = $res;
        }
        $plugins = Plugin::loaded();
        foreach ($plugins as $plugin) {
            $pluginPaths = App::path($this->_type, $plugin);
            foreach ($pluginPaths as $pluginPath) {
                $Folder = new Folder($pluginPath);
                $res = $Folder->find('.+'.$this->_type.'\.php');
                foreach ($res as &$r) {
                    $r = $plugin . '.' . basename($r, $this->_type.'.php');
                }
                $this->_deliveries = array_merge($this->_deliveries, $res);
            }
        }

        $this->validDelivery();
    }

    private function validDelivery()
    {
        $delivery = [];
        if (!empty($this->_deliveries) && count($this->_deliveries) > 0) {
            foreach ($this->_deliveries as $key => $fileName) {
                $class = App::className($fileName, $this->_type, $this->_type);

                if ($class) {
                    $obj = new $class();
                    if ($obj instanceof \HealthCheck\Util\DeliveryInterface) {
                        $delivery[ $obj->getId() ] = $obj;
                    }
                }
            }
        }
        $this->_deliveries = $delivery;
    }

    public function findDeliveries()
    {
        return $this->_deliveries;
    }

    public function run($test)
    {
        $rows = $this->findDeliveries();

        list($class, $method) = explode('-', $test);

        if (!isset($rows[$class])) {
            throw new \Exception("Metod no found", 1);
        }

        $obj = $rows[$class];

        $obj->run($method);

        return $obj->getInform();
    }
}
