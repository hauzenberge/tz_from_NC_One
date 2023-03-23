<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\House;

class HouseController extends Controller
{
    public function index()
    {
        return House::all()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'price' => $item->price,
                    'badrooms' => $item->badrooms,
                    'storeys' => $item->storeys,
                    'garages' => $item->garages
                ];
            });
    }

    public function filter(Request $request)
    {
        $keys = $request->input();
        $query = new House;
        if (array_key_exists("name", $keys)) {
            $query = $query->where('name', 'like', '%' . $keys["name"] . '%');
        }

        if (array_key_exists("bedrooms", $keys)) {
            $query = $query->where('badrooms', '=',  intval($keys["bedrooms"]));
        }
        if (array_key_exists("storeys", $keys)) {
            $query = $query->where('storeys', '=',  intval($keys["storeys"]));
        }
        if (array_key_exists("garages", $keys)) {
            $query = $query->where('garages', '=',  intval($keys["garages"]));
        }

        if (array_key_exists("price", $keys)) {
            $query = $query->where('price', '>=',  intval($keys["price"][0]))
                ->where('price', '<=',  intval($keys["price"][1]));
        }

        return $query->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'price' => $item->price,
                    'badrooms' => $item->badrooms,
                    'storeys' => $item->storeys,
                    'garages' => $item->garages
                ];
            });
    }
}
