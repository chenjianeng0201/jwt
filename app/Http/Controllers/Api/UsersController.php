<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{

    /**
     * 列表
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, User $user)
    {
        $users = $user->oldest()->paginate(20);
        return UserResource::collection($users);
    }

    /**
     * 详情
     *
     * @param User $user
     * @return UserResource
     */
    public function currentShow(User $user)
    {
        return new UserResource(Auth::guard('api')->user());
    }

    /**
     * 详情
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * 新增
     *
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function store(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return new UserResource($user);
    }

    /**
     * 修改自身
     *
     * @param Request $request
     * @return UserResource
     */
    public function currentUpdate(Request $request)
    {
        Auth::guard('api')->user()->update($request->all());
        return new UserResource(Auth::guard('api')->user());
    }

    /**
     * 修改
     *
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * 删除
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
