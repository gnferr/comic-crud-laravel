<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ComicModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ComicController extends Controller
{
    public function index(Request $request): View
    {
        $comic = ComicModel::all();
        return view('admin.comic.comic', compact('comic'));
    }

    public function get()
    {
        $comic = ComicModel::all();
        $result = array();
        $index = 0;
        foreach ($comic as $val) {
            $index++;
            $row = array();
            $row['index'] = $index;
            $row['cover'] = "<img src='$val->cover' width='80px'>";
            $row['title'] = $val->title;
            $row['type'] = $val->type;
            $row['genre'] = "<p title='{$val->genre}'>$val->genre</p>";
            $row['description'] = "<p title='{$val->description}'>$val->description</p>";
            $btn =
                "<div class='dropdown'>
            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Action
            </button>
            <div class='dropdown-menu'>
                <a class='dropdown-item has-icon' data-target='#UpdateData' data-toggle='modal' data-backdrop='static'><i class='fas fa-info text-warning'></i> Detail</a>
                <a class='dropdown-item has-icon flip-card-update' id='update-comic' onClick='getID({$val->id})'><i class='fas fa-edit text-primary'></i> Edit</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item has-icon text-danger' id='deleteBook' data-target='#DeleteData' data-toggle='modal' data-id='{$val->id}'><i class='fas fa-trash'></i> Delete</a>
            </div>
            </div>";

            $row['action'] = $btn;
            $result[] = (object)$row;
        }
        return json_encode([
            'data' => $result
        ]);
    }
    // data-id='{$val->id}' data-title='{$val->title}' data-type='{$val->type}' data-genre='{$val->genre}' data-description='{$val->description}' data-cover='{$val->cover}'

    public function create(Request $request)
    {
        $valid = $this->validate($request, [
            'title' => 'required|string',
            'genre' => 'required',
        ]);
        $comicID = $request->id;

        ComicModel::updateOrInsert(
            [
                'id' => $comicID
            ],
            [
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'genre' => implode(',', $request->genre),
                'type' => $request->type,
                'description' => $request->description,
                'cover' => $request->cover == '' ? 'https://www.bukukita.com/babacms/displaybuku/74409_f.jpg' : $request->cover
            ]
        );
        return response()->json(['success' => 'Comic saved successfully.']);
    }

    public function edit(Request $request)
    {
        $get = array('id' => $request->id);
        $comic = ComicModel::where($get)->first();

        return response()->json($comic);
    }


    public function delete(Request $request)
    {
        $comic = ComicModel::where('id', $request->id)->delete();

        return Response()->json($comic);
    }
}
