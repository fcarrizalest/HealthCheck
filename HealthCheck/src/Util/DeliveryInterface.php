<?php
namespace HealthCheck\Util;

interface DeliveryInterface
{
    public function getId();
    public function getName();
    public function getCheckList();
    public function run($test);
    public function getInform();
}
