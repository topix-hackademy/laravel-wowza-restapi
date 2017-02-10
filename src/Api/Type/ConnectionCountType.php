<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 16:23
 */

namespace Topix\Hackademy\LaravelWowza\Api\Type;

use Illuminate\Database\Eloquent\Collection;
use Verdant\XML2Array;

abstract class ConnectionCountType
{

    private $connections_current;
    private $connections_total;
    private $connections_total_accepted;
    private $connections_total_rejected;
    private $messages_in_bytes_rate;
    private $messages_out_bytes_rate;

    private $name;

    private $children = false;

    public function __construct( $data)
    {
        if( is_array($data) ) $this->xml = $data;
        else {
            $this->xml = $data = XML2Array::createArray($data);
        }
        $this->name = isset($data['Name']) ? $data['Name'] : '';

        $this->connections_current = $data['ConnectionsCurrent'];
        $this->connections_total = $data['ConnectionsTotal'];
        $this->connections_total_accepted = $data['ConnectionsTotalAccepted'];
        $this->connections_total_rejected = $data['ConnectionsTotalRejected'];
        $this->messages_in_bytes_rate = $data['MessagesInBytesRate'];
        $this->messages_out_bytes_rate = $data['MessagesOutBytesRate'];

    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return urldecode((string) $this->name);
    }

    /**
     * @return mixed
     */
    public function getConnectionsCurrent()
    {
        return urldecode((string) $this->connections_current);
    }

    /**
     * @return mixed
     */
    public function getConnectionsTotal()
    {
        return urldecode((string) $this->connections_total);
    }

    /**
     * @return mixed
     */
    public function getConnectionsTotalAccepted()
    {
        return urldecode((string) $this->connections_total_accepted);
    }

    /**
     * @return mixed
     */
    public function getConnectionsTotalRejected()
    {
        return urldecode((string) $this->connections_total_rejected);
    }

    /**
     * @return mixed
     */
    public function getMessagesInBytesRate()
    {
        return urldecode((string) $this->messages_in_bytes_rate);
    }

    /**
     * @return mixed
     */
    public function getMessagesOutBytesRate()
    {
        return urldecode((string) $this->messages_out_bytes_rate);
    }

    public function getInfo()
    {
        return [
            'name'                          => $this->getName(),
            'connections_current'           => $this->getConnectionsCurrent(),
            'connections_total'             => $this->getConnectionsTotal(),
            'connections_total_accepted'    => $this->getConnectionsTotalAccepted(),
            'connections_total_rejected'    => $this->getConnectionsTotalRejected(),
            'messages_in_bytes_rate'        => $this->getMessagesInBytesRate(),
            'messages_out_bytes_rate'       => $this->getMessagesOutBytesRate(),
        ];
    }


    public function children($entity, $className)
    {
        $this->children = new Collection();

        if ($this->children->isEmpty() && $this->childrenData($entity)) {
            if (!isset($this->childrenData($entity)['Name'])) {
                foreach ($this->childrenData($entity) as $application_data) {

                    $this->children->push(new $className($application_data));
                };
            }
            else {
                $this->children->push(new $className($this->childrenData($entity)));
            }
        }
        return $this->children;
    }
    public function childrenData($entity)
    {
        return isset($this->xml[$entity]) ? $this->xml[$entity] : false;
    }

}