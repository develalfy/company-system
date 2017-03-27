<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $filter = \DataFilter::source(new Item());
        $filter->add('name','Name', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name', true);
        $grid->edit('/admin/items/edit', 'Edit','show|modify|delete');
        $grid->link('/admin/items/edit/create=1',"New Item", "TR");
        $grid->paginate(10);

        return  view('items.list', compact('filter', 'grid'));
    }

    /**
     * All the CRUD
     * @return mixed
     */
    public function anyEdit()
    {
        $edit = \DataEdit::source(new Item());
        $edit->link("admin/items","Items", "TR")->back();
        $edit->add('name','Name', 'text')->rule('required|min:5');
        $edit->add('desc','Description', 'textarea')->rule('min:5');
        $edit->add('category_id','Category','select')->options(Category::lists('name', 'id')->all())->rule('required');
        $edit->add('price','Price', 'text');
        $edit->add('img_1','Image 1', 'image')->move('uploads/items/')->fit(240, 160)->preview(120,80);
        $edit->add('img_2','Image 2', 'image')->move('uploads/items/')->fit(240, 160)->preview(120,80);
        $edit->add('img_3','Image 3', 'image')->move('uploads/items/')->fit(240, 160)->preview(120,80);

        return $edit->view('items.edit', compact('edit'));
    }
}
