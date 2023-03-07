<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\{
    User,
    Role,
    GoldRatesSheet,
    GoldRates,
    Categories,
    Karat
};
// use App\Http\Requests\ClientStoreRequest;
use Hash, File, Auth, Str;
use LengthException;

class GoldSheetController extends Controller
{
    public function index(Request $request)
    {
        $data = GoldRatesSheet::select("*");

        if ($request->dates) {
            $dateRange = explode("-", $request->dates);
            $date1 = trim(str_replace("/", "-", date('Y-m-d', strtotime($dateRange[0]))));
            $date2 = trim(str_replace("/", "-", date('Y-m-d', strtotime($dateRange[1]))));

            $data = $data->whereBetween('created_at', [$date1, $date2])->where('status', 1);
        }

        $data = $data->OrderBy('created_at', 'ASC')->paginate(10);
        return view('sheet.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $categories = Categories::select('id', 'name')->get();
        return view('sheet.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $id = Str::uuid()->toString();
        $sheet = '';
        try {
            if ($request->id != '') {
                $sheet = GoldRatesSheet::findorFail($request->id);
                $id = $sheet->id;
                $sheet->updated_by = Auth::user()->id;
            } else {
                $sheet = new GoldRatesSheet();
                $sheet->id = $id;
                $sheet->created_by = Auth::user()->id;
            }

            $sheet->name = $request->name;
            $sheet->status = $request->status;
            // var_dump(request->$category[0]);
            // die();
            // die();
            // GoldRates::all()

            if ($sheet->save()) {
                if (isset($request->category[0])) {
                    GoldRates::where('sheet_id', $id)->forceDelete();
                    foreach ($request->category as $key => $value) {
                        if (isset($request->market[$value]))
                            for ($i = 0; $i < count($request->market[$value]); $i++) {
                                $rate = new GoldRates;
                                $rate->id = Str::uuid()->toString();
                                $rate->sheet_id = $id;
                                $rate->category_id = $value;
                                $rate->market = $request->market[$value][$i];
                                $rate->buy = $request->buy[$value][$i];
                                $rate->sell = $request->sell[$value][$i];
                                $rate->created_by = Auth::user()->id;
                                $rate->save();
                            }
                    }
                    // die();
                    //deactive previous
                    if ($request->status == 1) {
                        GoldRatesSheet::where('id', '!=', $sheet->id)->update(['status' => 0]);
                    }
                } else {
                    return response()->json(
                        [
                            'success' => false,
                            'data' => [],
                            'message' => "Please add rates to sheet",
                        ],
                        404
                    );
                }

                return response()->json(
                    [
                        'success' => true,
                        'data' => ['id' => $id],
                        'message' => 'Sheet saved.',
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

    public function show(Request $request)
    {
        $data = GoldRatesSheet::findorFail($request->id);

        $ids = array();




        foreach ($data->rates as $key => $value) {
            array_push($ids, $value->category_id);
        }


        $test = Categories::query('select * from categories');
        $categories = Categories::select('id', 'name')->whereIn('id', $ids)->get();
        return view('sheet.show', compact('data', 'categories'));
    }

    public function publicSheet()
    {

        // $id = GoldRatesSheet::all('id')->where('status', '=', 1);
        $ids  = DB::table("gold_rates_sheets")->select("id")->where("status", 1)->get()->first()->id;
        
        $data = GoldRatesSheet::findorFail($ids);

        // $data = GoldRatesSheet::findorFail($request->id);

        $ids = array();




        foreach ($data->rates as $key => $value) {
            array_push($ids, $value->category_id);
        }


        $test = Categories::query('select * from categories');
        $categories = Categories::select('id', 'name')->whereIn('id', $ids)->get();
        return view('sheet.show', compact('data', 'categories'));
    }


    public function test(Request $request)
    {

        $categories = Categories::select('id', 'name')->get();

        $data = [];

        foreach ($categories as $category) {
            $data['categories'][$category->id]['id'] = $category->id;
            $data['categories'][$category->id]['name'] = $category->name;
            $karats = Karat::select('id', 'name')->where('category_id', $category->id)->get();
            // print_r($karats);
            // die();
            foreach ($karats as $karat) {
                $data['categories'][$category->id]['karats'][] = ['id' => $karat->id, 'name' => $karat->name];
            }
        }

        // print_r($data);
        // die();

        return view('sheet.sheet2')->with('data', $data);
    }
    public function edit($id)
    {
        $data = GoldRatesSheet::findorFail($id);
        $categories = Categories::select('id', 'name')->get();
        return view('sheet.sheet2', compact('categories', 'data'));
    }



    public function destroy($id)
    {
        $data = GoldRatesSheet::findorFail($id);

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
