<?php

namespace Topix\Hackademy\LaravelWowza\Api\Type;

use Illuminate\Database\Eloquent\Collection;

class ApplicationCountType extends ConnectionCountType
{

    protected $instances = false;

    public function instances()
    {
        return $this->children('ApplicationInstance', InstanceCountType::class);

//        if (!$this->instances && $this->instancesData()) {
//            if (!isset($this->instancesData()['Name'])) {
//                $this->instances = new Collection();
//                foreach ($this->instancesData() as $application_data) {
//                    $this->instances->push(new InstanceCountType($application_data));
//                };
//            }
//            else {
//                $this->instances = new InstanceCountType($this->instancesData());
//            }
//        }
//        return $this->instances;
    }
    public function instancesData()
    {
        return isset($this->xml['ApplicationInstance']) ? $this->xml['ApplicationInstance'] : false;
    }


    
}
