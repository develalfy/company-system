<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Demo\Article;
use Zofe\Rapyd\Demo\Author;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $filter = \DataFilter::source(Article::with('author','categories'));
        $filter->add('title','Title', 'text');
        $filter->add('categories.name','Categories','tags');
        $filter->add('publication_date','publication date','daterange')->format('m/d/Y', 'en');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title', true);
        $grid->add('author.fullname','Author');
        $grid->add('{{ implode(", ", $categories->lists("name")->all()) }}','Categories');
        $grid->add('publication_date|strtotime|date[m/d/Y]','Date', true);
        $grid->add('body|strip_tags|substr[0,20]','Body');
        $grid->edit('/admin/articles/edit', 'Edit','modify|delete');
        $grid->paginate(10);

        return  view('articles.list', compact('filter', 'grid'));
    }

    public function anyEdit()
    {
        if (\Input::get('do_delete')==1) return  "not the first";

        $edit = \DataEdit::source(new Article());
        $edit->label('Edit Article');
        $edit->link("admin/articles","Articles", "TR")->back();
        $edit->add('title','Title', 'text')->rule('required|min:5');

        $edit->add('body','Body', 'redactor');
        $edit->add('detail.note','Note', 'textarea')->attributes(array('rows'=>2));
        $edit->add('detail.note_tags','Note tags', 'text');
        $edit->add('author_id','Author','select')->options(Author::lists("firstname", "id")->all());
        $edit->add('publication_date','Date','date')->format('d/m/Y', 'it');
        $edit->add('photo','Photo', 'image')->move('uploads/demo/')->fit(240, 160)->preview(120,80);
        $edit->add('public','Public','checkbox');
        $edit->add('categories.name','Categories','tags');

        return $edit->view('articles.edit', compact('edit'));
    }
}
