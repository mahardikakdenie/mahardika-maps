<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Brryfrmnn\Transformers\Json;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $map = Map::get();
            return Json::response($map);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $map = new Map();
            $map->title = $request->title;
            $map->is_address = $request->is_address;
            $map->ordinat = $request->ordinat;
            if ($request->is_address == false) {
                $url = "https://maps.google.com/maps?q=" . $request->ordinat . "&t=&z=13&ie=UTF8&iwloc=&output=embed";
            }
            if ($request->is_address == true) {
                $map->address = $request->address;
                $address = str_replace(" ", "%20%", $request->address);
                $url = "https://maps.google.com/maps?q=" . $address . "&t=&z=13&ie=UTF8&iwloc=&output=embed";
            }
            $map->url = $url;
            $map->description = $request->description;
            $map->mark_as = $request->mark_as;
            $map->save();

            return Json::response($map);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        try {
            $map = Map::byId($request->id)->first();
            return Json::response($map);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        try {
            $map = Map::findOrFail($id);
            $map->title = $request->input('title', $map->title);
            $map->is_address = $request->is_address;

            if ($map->is_address == false) {
                $map->ordinat = $request->input("ordinat", $map->ordinat);
                $url = "https://maps.google.com/maps?q=" . $request->ordinat . "&t=&z=13&ie=UTF8&iwloc=&output=embed";
                $map->address = null;
            }
            if ($map->is_address == true) {
                $map->address = $request->input("address", $map->address);
                $address = str_replace(" ", "%20%", $request->input("address", $map->address));
                $url = "https://maps.google.com/maps?q=" . $address . "&t=&z=13&ie=UTF8&iwloc=&output=embed";
                $map->ordinat = null;
            }
            $map->url = $url;
            $map->description = $request->input("description", $map->description);
            $map->mark_as = $request->input("mark_as", $map->mark_as);
            $map->save();

            return Json::response($map);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $map = Map::findOrFail($id);
            $map->delete();

            return Json::response($map);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}
