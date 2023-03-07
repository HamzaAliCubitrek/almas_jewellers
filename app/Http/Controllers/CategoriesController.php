<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Role;
// use App\Models\Types;
use App\Models\Categories;
use Hash, File, Auth, Str;

use function PHPSTORM_META\type;



class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Categories::OrderBy('id', 'DESC')->latest()->paginate(10);
        return view('categories.index', compact('items'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Str::uuid()->toString();
        $type = '';

        try {
            if ($request->id != '') {
                $categories = Categories::findorFail($request->id);
                $id = $categories->id;
                $categories->updated_by = Auth::user()->id;
            } else {
                $categories = new Categories();
                $categories->id = $id;
                $categories->created_by = Auth::user()->id;
            }

            $categories->name = $request->name;
            $categories->description = $request->description;


            if ($categories->save()) {
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
        //
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
        $data = Categories::findorFail($id);
        return view('categories.create', compact('data'));
        //
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
        $data = Categories::findorFail($id);

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
