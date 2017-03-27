<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $filter = \DataFilter::source(new Category());
        $filter->add('name','Name', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name', true);
        $grid->edit('/admin/categories/edit', 'Edit','show|modify|delete');
        $grid->link('/admin/categories/edit/create=1',"New Category", "TR");
        $grid->paginate(10);

        return  view('categories.list', compact('filter', 'grid'));
    }

    /**
     * All the CRUD
     * @return mixed
     */
    public function anyEdit()
    {
        $edit = \DataEdit::source(new Category());
        $edit->link("admin/categories","Categories", "TR")->back();
        $edit->add('name','Name', 'text')->rule('required|min:5');
        $edit->add('img','Image', 'image')->move('uploads/categories/')->fit(240, 160)->preview(120,80);

        return $edit->view('categories.edit', compact('edit'));
    }
}
