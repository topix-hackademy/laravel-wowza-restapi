<?php

namespace Topix\Hackademy\LaravelWowza\Api\Type;

use Verdant\XML2Array;

class StreamCountType
{


    private $sessions_flash;
    private $sessions_cupertino;
    private $sessions_san_jose;
    private $sessions_smooth;
    private $sessions_rtsp;
    private $sessions_mpeg_dash;
    private $session_total;

    private $name;
    
    public function __construct( $data)
    {
        if( is_array($data) ) $this->xml = $data;
        else {
            $this->xml = $data = XML2Array::createArray($data);
        }
        $this->name = isset($data['Name']) ? $data['Name'] : '';

        $this->sessions_flash = $data['SessionsFlash'];
        $this->sessions_cupertino = $data['SessionsCupertino'];
        $this->sessions_san_jose = $data['SessionsSanJose'];
        $this->sessions_smooth = $data['SessionsSmooth'];
        $this->sessions_rtsp = $data['SessionsRTSP'];
        $this->sessions_mpeg_dash = $data['SessionsMPEGDash'];
        $this->session_total = $data['SessionsTotal'];

    }

    /**
     * @return mixed
     */
    public function getSessionsFlash()
    {
        return urldecode( (string) $this->sessions_flash);
    }

    /**
     * @return mixed
     */
    public function getSessionsCupertino()
    {
        return urldecode( (string) $this->sessions_cupertino);
    }

    /**
     * @return mixed
     */
    public function getSessionsSanJose()
    {
        return urldecode( (string) $this->sessions_san_jose);
    }

    /**
     * @return mixed
     */
    public function getSessionsSmooth()
    {
        return urldecode( (string) $this->sessions_smooth);
    }

    /**
     * @return mixed
     */
    public function getSessionsRtsp()
    {
        return urldecode( (string) $this->sessions_rtsp);
    }

    /**
     * @return mixed
     */
    public function getSessionsMpegDash()
    {
        return urldecode( (string) $this->sessions_mpeg_dash);
    }

    /**
     * @return mixed
     */
    public function getSessionTotal()
    {
        return urldecode( (string) $this->session_total);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return urldecode( (string) $this->name);
    }

    public function getInfo()
    {
        return [
            'name'                          => $this->getName(),
            'sessions_flash'           => $this->getSessionsFlash(),
            'sessions_cupertino'             => $this->getSessionsCupertino(),
            'sessions_san_jose'    => $this->getSessionsSanJose(),
            'sessions_smooth'    => $this->getSessionsSmooth(),
            'sessions_rtsp'        => $this->getSessionsRtsp(),
            'sessions_mpeg_dash'       => $this->getSessionsMpegDash(),
            'session_total'       => $this->getSessionTotal()
        ];

    }
}
