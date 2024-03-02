<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
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
}
