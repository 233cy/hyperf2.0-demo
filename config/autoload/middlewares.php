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
return [
    'http' => [
        App\Middleware\DebugMiddleware::class,
        Hyperf\Session\Middleware\SessionMiddleware::class,
        Hyperf\Validation\Middleware\ValidationMiddleware::class,
    ],
    'ws' => [
        Hyperf\Validation\Middleware\ValidationMiddleware::class,
    ],
];
