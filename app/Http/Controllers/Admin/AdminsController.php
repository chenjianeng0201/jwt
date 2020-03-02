<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @param Admin $admin
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request,  Admin $admin)
    {
        $admins = $admin->oldest()->paginate(20);
        return AdminResource::collection($admins);
    }

    /**
     * 查看自身
     *
     * @param Admin $admin
     * @return AdminResource
     */
    public function currentShow()
    {
        return new AdminResource(Auth::guard('admin')->user());
    }

    /**
     * 详情
     *
     * @param Admin $admin
     * @return AdminResource
     */
    public function show(Admin $admin)
    {
        return new AdminResource($admin);
    }

    /**
     * 新增
     *
     * @param Request $request
     * @param Admin $admin
     * @return AdminResource
     */
    public function store(Request $request, Admin $admin)
    {
        $admin->fill($request->all());
        $admin->save();
        return new AdminResource($admin);
    }

    /**
     * 修改自身
     *
     * @param Request $request
     * @return AdminResource
     */
    public function currentUpdate(Request $request)
    {
        Auth::guard('admin')->user()->update($request->all());
        return new AdminResource(Auth::guard('admin')->user());
    }

    /**
     * 修改
     *
     * @param Request $request
     * @param Admin $admin
     * @return AdminResource
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->update($request->all());
        return new AdminResource($admin);
    }

    /**
     * 删除
     *
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->noContent();
    }
}
