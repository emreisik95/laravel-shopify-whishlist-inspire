<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function configureTheme()
    {
        $shop = Auth::user();

        $themes = $shop->api()->rest('GET', '/admin/themes.json');

        $activeThemeId = '';
        foreach ($themes['body']->container['themes'] as $theme) {
            if ($theme['role'] == 'main') {
                $activeThemeId = $theme['id'];
            }
        }

        $snippet = 'Your snippet code updated';
        $array = ['asset' => ['key' => 'snippets/codeinspire-wishlist-app.liquid', 'value' => $snippet]];
        $shop->api()->rest('PUT', '/admin/themes/' . $activeThemeId . '/assets.json', $array);

        // save data into database
        $settings = Setting::where('shop_id', $shop->name)->first();
        if ( ! $settings) {
            Setting::create([
                'shop_id' => $shop->name,
                'activated' => true,
            ]);
        } else {
            $settings->update([
                'shop_id' => $shop->name,
                'activated' => true,
            ]);
        }

        return [
            'message' => 'Theme setup successfully'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
