<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karat;
use App\Models\Categories;
use App\Models\User;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Role;
use Hamcrest\Core\HasToString;
use Hash, File, Auth, Str;


class karatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karat = Karat::OrderBy('id', 'DESC')->latest()->paginate(10);
        return view('karat.index', compact('karat'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id', 'name')->get();
        return view('karat.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Str::uuid()->ToString();
        $karat = '';
        try {
            if ($request->id != '') {
                $karat = Karat::findorFail($request->id);
                $id = $karat->id;
                $karat->updated_by = Auth::user()->id;
            } else {
                $karat = new karat();
                $karat->id = $id;
                $karat->created_by = Auth::user()->id;
            }
            $karat->name = $request->name;
            $karat->category_id = $request->category;
            $karat->description = $request->description;

            if ($karat->save()) {
                return response()->json(
                    [
                        'success' => true,
                        'data' => ['id' => $id],
                        'message' => 'Item saved.',
                    ],
                    200
                );
            }
        } catch (Exception $err) {
            return response()->json(
                [
                    'success' => false,
                    'data' => [],
                    'message' => $err->getMessage(),
                ],
                404
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Karat::findorFail($id);
        $categories = Categories::select('id', 'name')->get();
        return view('karat.create', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = karat::findorFail($id);

        if ($data->delete()) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Item Deleted Successfully',
                ],
                200
            );
        }

        return response()->json(
            [
                'success' => false,
                'data' => [],
                'message' => 'Opps! something went wrong try again.',
            ],
            404
        );
    }
}
