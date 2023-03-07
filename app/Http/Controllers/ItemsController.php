<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Role;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Hash, File, Auth, Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::OrderBy('id', 'DESC')->latest()->paginate(10);
        return view('items.index', compact('items'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        
        return view('items.create');
    }

    public function store(Request $request)
    {
        $id = Str::uuid()->toString();
        $item = '';

        try {
            if ($request->id != '') {
                $item = Items::findorFail($request->id);
                $id = $item->id;
                $item->updated_by = Auth::user()->id;
            } else {
                $item = new Items();
                $item->id = $id;
                $item->created_by = Auth::user()->id;
            }

            $item->name = $request->name;
            $item->client = $request->client;
            $item->karat = $request->karat;
            $item->purity = $request->purity;
            $item->quantity = $request->quantity;
            $item->code = $request->code;
            $item->weight = $request->weight;
            $item->origin = $request->origin;
            $item->production_date = $request->production_date;


            if ($item->save()) {
                $item->barcode = \QrCode::size(150)->generate(
                    url('/items/public/')
                );
                if ($item->update()) {
                    return response()->json(
                        [
                            'success' => true,
                            'data' => ['id' => $id],
                            'message' => 'Item saved.',
                        ],
                        200
                    );
                }
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

    public function qrpublic()
    {
    }

    public function show(Request $request)
    {
        $data = Items::findorFail($request->id);
        return view('items.show', compact('data'));
    }
    public function publicview()
    {

        return view('items.Productview');
    }
    public function verifyproduct(Request $request)
    {
        $code = $request->code;
        $rows = Items::select('*')->where('code', $code)->first();

        // $row = DB::table('items')->where('code', $code)->get();
        // die();
        // $data = compact('rows');
        return view('items.printSlip', ['row' => $rows]);


        // if (isset($row)) {
        // } else {
        //     return view('items.Productview');
        // }
    }

    public function edit($id)
    {
        $data = Items::findorFail($id);
        return view('items.create', compact('data'));
    }
    public function print($id)
    {
        $item = Items::find($id);
        $data = compact('item');
        return view('items.viewPrint')->with($data);



        // return view('items.printSlip')->with($item,$item);
        // return response()->json([
        //     $data
        // ]);
    }

    public function destroy($id)
    {
        $data = Items::findorFail($id);

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
