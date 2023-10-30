<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Api\V1\Admin\Servers;

class ServerApi extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = Servers::all();
        $mergedServers = [];

        foreach ($index as $server) {
            $mergedServer = $server;
            $mergedServer['NS_addresses'] = [
                $server['NS1_address'],
                $server['NS2_address'],
                $server['NS3_address'],
                $server['NS4_address'],
            ];
            $mergedServer['IP_addresses'] = [
                $server['IP1_address'],
                $server['IP2_address'],
                $server['IP3_address'],
                $server['IP4_address'],
            ];

            unset($mergedServer['NS1_address']);
            unset($mergedServer['NS2_address']);
            unset($mergedServer['NS3_address']);
            unset($mergedServer['NS4_address']);
            unset($mergedServer['IP1_address']);
            unset($mergedServer['IP2_address']);
            unset($mergedServer['IP3_address']);
            unset($mergedServer['IP4_address']);

            $mergedServers[] = $mergedServer;
        }

        $response = ['servers' => $mergedServers];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locale = $request->header('Accept-Language');

        if ($locale) {
            app()->setLocale($locale);
        }

        $data = $request->all();
        $obj = $data['storeServer'];
        $validator = Validator::make($obj, [
            'server_name' => 'required|string',
            'server_ip' => 'required|ip',
            'server_login' => 'required|string',
            'server_password' => 'required|string',
            'server_status' => 'required|boolean',
            'server_userId' => 'required|numeric',
            'server_type' => 'required',
            'server_address' => 'required',
            'server_port' => 'required|numeric',
            'NS1_address' => 'required',
            'NS2_address' => 'required',
            'NS3_address' => 'required',
            'NS4_address' => 'required',
            'IP1_address' => 'required|ip',
            'IP2_address' => 'required|ip',
            'IP3_address' => 'required|ip',
            'IP4_address' => 'required|ip',
            'server_location' => 'required',
            'server_description' => '',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $server = new Servers([
            'server_name' => $obj["server_name"],
            'server_ip' => $obj["server_ip"],
            'server_login' => $obj["server_login"],
            'server_password' => $obj["server_password"],
            'server_status' => $obj["server_status"],
            'server_userId' => $obj["server_userId"],
            'server_type' => $obj["server_type"],
            'server_address' => $obj["server_address"],
            'server_port' => $obj["server_port"],
            'NS1_address' => $obj["NS1_address"],
            'NS2_address' => $obj["NS2_address"],
            'NS3_address' => $obj["NS3_address"],
            'NS4_address' => $obj["NS4_address"],
            'IP1_address' => $obj["IP1_address"],
            'IP2_address' => $obj["IP2_address"],
            'IP3_address' => $obj["IP3_address"],
            'IP4_address' => $obj["IP4_address"],
            'server_location' => $obj["server_location"],
            'server_description' => $obj["server_description"],
        ]);
        // $server->save();
        if ($server->save()) {
            return response()->json(['message' => 'Tarif muvaffaqiyatli qo\'shildi ', 'server' => $server], 201);
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
        $locale = $request->header('Accept-Language');

        if ($locale) {
            app()->setLocale($locale);
        }

        $data = $request->all();
        $obj = $data['updateServer'];

        $validator = Validator::make($obj, [
            'server_name' => 'string',
            'server_ip' => 'ip',
            'server_login' => 'string',
            'server_password' => 'string',
            'server_status' => 'boolean',
            'server_userId' => 'numeric',
            'server_port' => 'numeric',
            'IP1_address' => 'ip',
            'IP2_address' => 'ip',
            'IP3_address' => 'ip',
            'IP4_address' => 'ip',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        $server_id = $obj["server_id"];

        $server = Servers::find($server_id);
        if ($server != null) {
            $server->server_name = $obj["server_name"];
            $server->server_ip = $obj["server_ip"];
            $server->server_login = $obj["server_login"];
            $server->server_password = $obj["server_password"];
            $server->server_status = $obj["server_status"];
            $server->server_userId = $obj["server_userId"];
            $server->server_type = $obj["server_type"];
            $server->server_address = $obj["server_address"];
            $server->server_port = $obj["server_port"];
            $server->NS1_address = $obj["NS1_address"];
            $server->NS2_address = $obj["NS2_address"];
            $server->NS3_address = $obj["NS3_address"];
            $server->NS4_address = $obj["NS4_address"];
            $server->IP1_address = $obj["IP1_address"];
            $server->IP2_address = $obj["IP2_address"];
            $server->IP3_address = $obj["IP3_address"];
            $server->IP4_address = $obj["IP4_address"];
            $server->server_location = $obj["server_location"];
            $server->server_description = $obj["server_description"];
            if ($server->save()) {
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
        $locale = $request->header('Accept-Language');

        if ($locale) {
            app()->setLocale($locale);
        }

        $id = $request->id;

        $destroy = Servers::find($id);
        if ($destroy != null) {
            $destroy->delete();
            return response()->json(['message' => 'ma\'lumot o\'chirildi'], 201);
        } else {
            return response()->json(['error' => 'xattolik yuzaga keldi'], 401);
        }
    }
}
