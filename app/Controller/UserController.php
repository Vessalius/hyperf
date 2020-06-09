<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Request\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\DbConnection\Db;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller()
 */
class UserController extends AbstractController
{
    /**
     * @RequestMapping(path="login", methods="get,post")
     */
    public function login(LoginRequest $request)
    {
        $user = $this->request->input('user');
        $password = $this->request->input('password');
        $validated = $request->validated();
        print_r($validated);
//        Db::table('user')->where('')

//        return [
//            'method' => $method,
//            'message' => "Hello {$user}.",
//        ];
    }
}
