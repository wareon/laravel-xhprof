<?php

namespace Wareon\LaravelXhprof\Providers;

use Wareon\LaravelXhprof\Profiling\ProfilingData;
use function xhprof_disable;
use function xhprof_enable;

class XHProfMongoDBProvider implements ProviderInterface
{
    /**
     * @inheritDoc
     */
    public function enable()
    {
        xhprof_enable(config('xhprof.flags', 0));
    }

    /**
     * @inheritDoc
     */
    public function disable()
    {
        $data = xhprof_disable();

        if (!is_array($data)) return false;
        $data = $this->encodeProfile($data);
        $ProfilingData = new ProfilingData(config('xhprof', []));
        $result = $ProfilingData->getProfilingData($data);
        //1.Connect MongoDB
        $database = config('xhprof.database', []);
        if (empty($database['username'])) {
            $uri = "{$database['driver']}://{$database['host']}:{$database['port']}/{$database['database']}";
        } else {
            $uri = "{$database['driver']}://{$database['username']}:{$database['password']}@{$database['host']}:{$database['port']}/{$database['database']}";
        }
        $manager = new \MongoDB\Driver\Manager($uri);
        //2.Create BulkWrite object
        $bulk = new \MongoDB\Driver\BulkWrite();
        $oid = new \MongoDB\BSON\ObjectID();
        $result['_id'] = $oid;
        $_id = $bulk->insert($result);
        //3.Run insert
        return $manager->executeBulkWrite($database['database'] . '.results', $bulk);
    }

    private function encodeProfile(array $profile)
    {
        $results = array();
        foreach ($profile as $k => $v) {
            if (strpos($k, '.') !== false) {
                $k = str_replace('.', '_', $k);
            }
            $results[$k] = $v;
        }

        return $results;
    }

}
