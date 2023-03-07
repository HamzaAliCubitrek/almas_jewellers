<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Role;
use App\Models\Types;
use Hash, File, Auth, Str;

use function PHPSTORM_META\type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Types::OrderBy('id', 'DESC')->latest()->paginate(10);
        return view('types.index', compact('items'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
                $type = Types::findorFail($request->id);
                $id = $type->id;
                $type->updated_by = Auth::user()->id;
            } else {
                $type = new Types();
                $type->id = $id;
                $type->created_by = Auth::user()->id;
            }

            $type->name = $request->name;
            $type->description = $request->description;


            if ($type->save()) {
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
    public function show(Request $request)
    {
        $data = Items::findorFail($request->id);
        return view('items.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Types::findorFail($id);
        return view('types.create', compact('data'));
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
        //
    }
}
