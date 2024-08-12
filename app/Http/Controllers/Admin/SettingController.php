<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    private $settingsService;

    public function __construct(SettingsService $settings)
    {
        $this->settingsService = $settings;
    }

    public function index()
    {
        return redirect(route('settings.general'));
    }

    public function store(Request $request)
    {

        $settings = $request->all();

        foreach ($settings as $key => $setting) {
            $this->settingsService->save($key, $setting);

        }

        return redirect()->back()->withSuccess('Successfully Updated!');
    }
}
