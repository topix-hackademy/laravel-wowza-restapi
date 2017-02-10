<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 16:51
 */

namespace Topix\Hackademy\LaravelWowza\Api\Type;


use Illuminate\Support\Collection;

class VHostCountType extends ConnectionCountType
{

    protected $applications = false;

    public function applications()
    {
        return $this->children('Application', ApplicationCountType::class);
        /*
         * refactored code but here for legacy
         */
//        if (!$this->applications && $this->applicationsData()) {
//            if (!isset($this->applicationsData()['Name'])) {
//                $this->applications = new Collection();
//                foreach ($this->applicationsData() as $application_data) {
//                    $this->applications->push(new ApplicationCountType($application_data));
//                };
//            }
//            else {
//                $this->applications = new ApplicationCountType($this->applicationsData());
//            }
//        }
//        return $this->applications;
    }

    public function applicationsData()
    {
        return isset($this->xml['Application']) ? $this->xml['Application'] : false;
    }


}