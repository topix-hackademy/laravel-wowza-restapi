<?php

/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 16:06
 */

namespace Topix\Hackademy\LaravelWowza\Api\Type;


use Illuminate\Database\Eloquent\Collection;
use Topix\Hackademy\WowzaApi\Configuration;
use Verdant\XML2Array;

class ServerCountType extends ConnectionCountType
{

    protected $vhosts = false;
    /**
     * ConnectionCountType constructor.
     */
    public function __construct($data)
    {
        if( is_array($data) ) $this->xml = $data;
        else {
            $this->xml = $data = XML2Array::createArray($data);
        }
        $this->xml = $data = collect($data)->first();
        parent::__construct($data);
    }

    public function vhosts()
    {
        return $this->children('VHost', VHostCountType::class);
        /*
                if(!$this->vhosts && $this->vhostsData()){
                    if(!isset($this->vhostsData()['Name']))//se non sono nell'array dell'oggetto ma in array di oggetti
                    {
                        $this->vhosts = new Collection();
                        foreach($this->vhostsData() as $vhost_data)
                        {
                            $this->vhosts->push(new VHostCountType($vhost_data));
                        };
                    }
                    else {
                        $this->vhosts = new VHostCountType($this->vhostsData());
                    }
                }
                return $this->vhosts;
        */
    }
    public function vhostsData()
    {
        return isset($this->xml['VHost']) ? $this->xml['VHost'] : false;

    }

    public function getName()
    {
        return Configuration::$DEFAULT_SERVER;
    }


}