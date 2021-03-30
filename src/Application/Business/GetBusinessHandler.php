<?php


namespace App\Application\Business;


use App\Application\Business\Command\GetBusinessCommand;
use App\Domain\Business\Ports\BusinessInterface;

class GetBusinessHandler
{
    private BusinessInterface $businessPort;

    public function __construct(BusinessInterface $businessPort)
    {
        $this->businessPort = $businessPort;
    }


    public function handle(GetBusinessCommand $command)
    {


        $arrayBusiness = [];
        $allData = $this->businessPort->getAll();
        foreach ($allData as $key => $value) {
            $arrayBusiness[$key]['id'] = $value->getId();
            $arrayBusiness[$key]['name'] = $value->getName();
        }
        return [
            "data" => $arrayBusiness,
            "status" => 202
        ];
    }
}