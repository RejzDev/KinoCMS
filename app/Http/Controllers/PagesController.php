<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;


class PagesController extends Controller
{

    public function pages($id)
    {
        $page = new Page();
        $data = $page->getPageIds($id);


        return view('page.index', ['data' => $data]);
    }
}

