<?php
namespace Ligrila\Lib;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use SocketIO\Emitter;

/**
 * Use this class to enqueue Websocket events
 */
class Websocket
{
    /**
     * Publish event by adding queue entry to database
     *
     * @param  string $eventName name of event
     * @param  array $payload    additional data which is passed as is to websocket clients
     *                           Avoid sending sensitive data here!
     * @param array $audience    manipulate the configured audience
     *                           options:  [
     *                                      // whether all not authenticated clients should receive the event (overwrites event default)
     *                                      'includeAllNotAuthenticated' => false,
     *                                      // whether all authenticated clients should receive the event (overwrites event default)
     *                                      'includeAllAuthenticated' => true,
     *                                      // authenticated clients to send the event to (works independent of the settings above)
     *                                      'userIds' => []
     *                                     ]
     * @return bool
     * @throws \Exception if config of given event name is invalid
     */
    public static function publishEvent(string $eventName, array $payload = [], array $audience = []): bool
    {

        //REDIS IMPLEMTATION REEPLACE WITH CONFIG VARS
        $redis = new \Redis(); // Using the Redis extension provided client
        $redisHost = Configure::read('Redis.host','127.0.0.1');
        $redisPort = Configure::read('Redis.port','6379');

        $redis->connect($redisHost, $redisPort);

        $emitter = new Emitter($redis);
        //$emitter->emit($eventName, json_encode($payload));
        $payload = json_decode(json_encode($payload),true);
        $emitter->emit($eventName, compact('payload'));

        return true;
    }
}
