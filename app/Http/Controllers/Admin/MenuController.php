<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    protected $menuServices;
    public function __construct(MenuService $menuServices)
    {
        $this -> menuServices =$menuServices;
    }


    public function create()
    {
        return view('admin.menu.add',[
           'title' => 'Thêm Danh Mục Mới',
            'menus' => $this->menuServices->getParent(),
        ]);
    }

    public function store(CreateFormRequest $request)
    {
       $this->menuServices->create($request);

       return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list',[
           'title' => 'Danh sách Danh Mục mới nhất',
            'menus' => $this->menuServices->getAll(),
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.edit',[
            'title' => 'Chỉnh sửa Danh Mục ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuServices->getParent(),
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuServices->update($request, $menu);

        return redirect('/admin/menus/list');
    }

    public  function destroy(Request $request): JsonResponse
    {
        $result = $this->menuServices->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Đã xóa danh mục thành công'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
