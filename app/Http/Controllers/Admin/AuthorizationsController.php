<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends Controller
{
    /**
     * 获取 token
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $credentials = [];
        $credentials['name'] = $request->name;
        $credentials['password'] = $request->password;

        if (!$token = Auth::guard('admin')->attempt($credentials)) {
            return $this->errorResponse(401, '用户名或密码错误', 1001);
        }
        return $this->respondWithToken($token);
    }

    /**
     * 刷新 token
     *
     * @return mixed|void
     */
    public function update()
    {
        try {
            $token = Auth::guard('admin')->refresh();
        } catch (\Exception $e) {
            return $this->errorResponse(401, 'token 无法更新', 1002);
        }
        return $this->respondWithToken($token);
    }

    /**
     * 删除 token
     *
     * @return \Illuminate\Http\Response|void
     */
    public function destroy()
    {
        try {
            Auth::guard('admin')->logout();
        } catch (\Exception $e) {
            return $this->errorResponse(401, 'token 已过期');
        }
        // 删除成功，返回 204， 没有其他内容返回
        return response()->noContent();
    }

    /**
     * 返回 token
     *
     * @param $token
     * @return mixed
     */
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('admin')->factory()->getTTL() * 60,
        ])->setStatusCode(201);
    }
}
