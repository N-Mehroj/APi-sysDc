<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;

use App\Models\Rates;


class RatesApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = Rates::all();
        // $data = [$index, [$index->yearly_prices]];

        $newData = [];

        foreach ($index as $item) {
            $newItem = [
                'id' => $item['id'],
                'definition_name' => $item['definition_name'],
                'server_number' => $item['server_number'],
                'definition_status' => $item['definition_status'],
                'definition_userId' => $item['definition_userId'],
                'definition_paymentStatus' => $item['definition_paymentStatus'],
                'definition_publicStatus' => $item['definition_publicStatus'],
                'deleted_at' => $item['deleted_at'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
            ];

            $newItem['prices'] = [
                'daily' => $item['daily_prices'],
                'monthly' => $item['monthly_prices'],
                'yearly' => $item['yearly_prices'],
            ];

            $newData[] = $newItem;
        }
        return $newData;
        // return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $obj = $data['storeDefinition'];

        $definition_name = $obj["definition_name"];
        $server_number = $obj["server_number"];
        $definition_status = $obj["definition_status"];
        $definition_userId = $obj["definition_userId"];
        $definition_paymentStatus = $obj["definition_paymentStatus"];
        $definition_publicStatus = $obj["definition_publicStatus"];
        $daily_prices = $obj["daily_prices"];
        $monthly_prices = $obj["monthly_prices"];
        $yearly_prices = $obj["yearly_prices"];

        $rates = new Rates([
            'definition_name' => $definition_name,
            'server_number' => $server_number,
            'definition_status' => $definition_status,
            'definition_userId' => $definition_userId,
            'definition_paymentStatus' => $definition_paymentStatus,
            'definition_publicStatus' => $definition_publicStatus,
            'daily_prices' => $daily_prices,
            'monthly_prices' => $monthly_prices,
            'yearly_prices' => $yearly_prices
        ]);
        if ($rates->save()) {
            return response()->json(['message' => 'Tarif muvaffaqiyatli qo\'shildi ', 'rates' => $rates], 201);
        } else {
            return response()->json(['error' => 'xattolik yuzaga keldi'], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $data = $request->all();
        $obj = $data['updateDefinition'];

        $definition_id = $obj["definition_id"];

        $rates = Rates::find($definition_id);
        if ($rates != null) {
            $rates->definition_name = $obj["definition_name"];
            $rates->server_number = $obj["server_number"];
            $rates->definition_status = $obj["definition_status"];
            $rates->definition_userId = $obj["definition_userId"];
            $rates->definition_paymentStatus = $obj["definition_paymentStatus"];
            $rates->definition_publicStatus = $obj["definition_publicStatus"];
            $rates->daily_prices = $obj["daily_prices"];
            $rates->monthly_prices = $obj["monthly_prices"];
            $rates->yearly_prices = $obj["yearly_prices"];
            if ($rates->save()) {
                return response()->json(['message' => 'ma\'lumot yangilandi'], 201);
            } else {
                return response()->json(['error' => 'xattolik yuzaga keldi'], 401);
            }
        } else {
            return response()->json(['error' => 'id topilmadi'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $destroy = Rates::find($id);
        if ($destroy != null) {
            $destroy->delete();
            return response()->json(['message' => 'ma\'lumot o\'chirildi'], 201);
        } else {
            return response()->json(['error' => 'xattolik yuzaga keldi'], 401);
        }
    }
}
