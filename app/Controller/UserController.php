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

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller()
 */
class UserController extends AbstractController
{

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    /**
     * @RequestMapping(path="login", methods="get,post")
     */
    public function login(RequestInterface $request)
    {
        $validator = $this->validationFactory->make(
            $request->all(),
            [
                'name' => 'required|max:20',
                'password' => 'required|max:50',
            ],
            [
                'name.required' => 'name is required',
                'password.required' => 'password is required',
            ]
        );

        //未通过验证
        if ($validator->fails()){
            // Handle exception
            $errorMessage = $validator->errors()->first();
            return [
                'error' => 500,
                'message' => $errorMessage,
            ];
        }

        //通过验证
        $name = $request->input('name');
        $password = $request->input('password');
        $where = [
            ['name','=',$name],
            ['password','=',md5($password)],
        ];
        $user = Db::table('user')->where($where)->first();
        print_r($user);die;

//        return [
//            'method' => $method,
//            'message' => "Hello {$user}.",
//        ];
    }
}
