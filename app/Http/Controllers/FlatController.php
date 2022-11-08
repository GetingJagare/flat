<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $fields = $request->all();
        $flats = Flat::query();

        if (!empty($fields['name'])) {
            $flats->where('name', 'LIKE', "%{$fields['name']}%");
        }

        if (!empty($fields['price_from'])) {
            $flats->where('price', '>=', (float)$fields['price_from']);
        }

        if (!empty($fields['price_to'])) {
            $flats->where('price', '<=', (float)$fields['price_to']);
        }

        if (!empty($fields['bedrooms'])) {
            $flats->where('bedrooms', '=', (int)$fields['bedrooms']);
        }

        if (!empty($fields['bathrooms'])) {
            $flats->where('bathrooms', '=', (int)$fields['bathrooms']);
        }

        if (!empty($fields['storeys'])) {
            $flats->where('storeys', '=', (int)$fields['storeys']);
        }

        if (!empty($fields['garages'])) {
            $flats->where('garages', '=', (int)$fields['garages']);
        }

        return response()->json($flats->get());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterLimits()
    {
        return response()->json([
            'price' => [
                'min' => Flat::all()->min('price'),
                'max' => Flat::all()->max('price'),
            ],
            'bedrooms' => [
                'min' => Flat::all()->min('bedrooms'),
                'max' => Flat::all()->max('bedrooms'),
            ],
            'bathrooms' => [
                'min' => Flat::all()->min('bathrooms'),
                'max' => Flat::all()->max('bathrooms'),
            ],
            'storeys' => [
                'min' => Flat::all()->min('storeys'),
                'max' => Flat::all()->max('storeys'),
            ],
            'garages' => [
                'min' => Flat::all()->min('garages'),
                'max' => Flat::all()->max('garages'),
            ],
        ]);
    }
}
