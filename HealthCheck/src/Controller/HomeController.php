<?php
namespace HealthCheck\Controller;

class HomeController extends AppController
{
    public function index()
    {
        $this->loadComponent('HealthCheck.Check');

        $rows = $this->Check->findDeliveries();

        $this->set(compact('rows'));
    }


    public function run($test)
    {
        $this->loadComponent('HealthCheck.Check');
       
        try {
            $result = $this->Check->run($test);
            $this->response->statusCode(200);
            $this->response->body(json_encode(['success' => true,'test' => $test ,'result' => $result ]));
        } catch (\Exception $e) {
            $this->response->statusCode(500);
            $this->response->body(json_encode(['success' => false,'test' => $test]));
        }

        return $this->response;
    }
}
