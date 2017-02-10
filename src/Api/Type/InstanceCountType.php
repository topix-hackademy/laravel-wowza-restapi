<?php

namespace Topix\Hackademy\LaravelWowza\Api\Type;

use Illuminate\Database\Eloquent\Collection;

class InstanceCountType extends ConnectionCountType
{

    protected $streams = false;

    public function streams()
    {
        return $this->children('Stream', StreamCountType::class);

//        if (!$this->streams && $this->streamsData()) {
//            if (!isset($this->streamsData()['Name'])) {
//                $this->streams = new Collection();
//                foreach ($this->streamsData() as $application_data) {
//                    $this->streams->push(new StreamCountType($application_data));
//                };
//            }
//            else {
//                $this->streams = new InstanceCountType($this->streamsData());
//            }
//        }
//        return $this->streams;
    }
    public function streamsData()
    {
        return isset($this->xml['Stream']) ? $this->xml['Stream'] : false;
    }
}
