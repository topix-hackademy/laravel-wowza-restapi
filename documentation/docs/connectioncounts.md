# ConnectionCount Api

Besides the Wowza Rest Api package classes, you can use the custom api for the connectioncounts endpoint


## WowzaConnectionCount

The class is configured via constructor and then expose a single method connectionCounts

The connectionCounts method calls the api and contruct the return types.

ServerCountType->VhostCountType->ApplicationCountType->InstanceCountType->StreamCountType

### ServerCountType


__getInfo__: Properties extracted via method  that returns an array containing: ( for ServerCountType and every extension of ConnectionCountType )

- 'name'                        => name of the resource
- 'connections_current'         => current connections on the resource
- 'connections_total'           => total connections on the resource
- 'connections_total_accepted'  => total accepted connections on the resource
- 'connections_total_rejected'  => total rejected connections on the resource
- 'messages_in_bytes_rate'      => inbound bandwidth on the resource
- 'messages_out_bytes_rate'     => outbound bandwidth on the resource

__vhosts__: Returns a collection containing all the virtual host found on the server as VHostCountType instances.


### VHostCountType

__getInfo__: see above

__applications__:  Returns a collection containing all the applications found on the virtual host as ApplicationCountType instances.

### ApplicationCountType

__getInfo__: see above

__instances__:  Returns a collection containing all the instances found on the application as InstanceCountType instances.

### InstanceCountType

__getInfo__: see above

__streams__:  Returns a collection containing all the streams found on the instance as StreamCountType instances.

### StreamCountType


__getInfo__: Properties extracted via method  that returns an array containing:

- 'name'                => name of the stream
- 'sessions_flash'      => number of session using flash rtmp
- 'sessions_cupertino'  => number of session using cupertino
- 'sessions_san_jose'   => number of session using san jose
- 'sessions_smooth'     => number of session using smooth
- 'sessions_rtsp'       => number of session using rtsp
- 'sessions_mpeg_dash'  => number of session using mpeg dash
- 'session_total'       => number of total session

## Example

The chain to extract all the data could be the following.ve 

    with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCounts()->vhosts()->first()->applications()->first()->instances()->first()->streams();

