<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Redis\Redis;

/**
 * @AutoController(prefix="redis")
 */
class RedisController extends Controller
{
    public function lua()
    {
        $lua = <<<'LUA'
local stock = KEYS[1]
local stock_locked = KEYS[2]

local stock_val = ARGV[1]
local stock_lock_val = ARGV[2]
local ttl = ARGV[3]

local is_exists = redis.call("EXISTS", stock)

if is_exists == 1 then
return 0
else
redis.call("SET", stock, stock_val)
redis.call("SET", stock_locked, stock_lock_val)
redis.call("EXPIRE", stock, ttl)
redis.call("EXPIRE", stock_locked, ttl)
return 1
end
LUA;

        $res = di()->get(Redis::class)->eval($lua, ['lua:test', 'lua:test:lock', '1', '1', 10, 10], 2);

        return $this->response->success($res);
    }
}
