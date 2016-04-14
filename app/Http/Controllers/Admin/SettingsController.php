<?php

namespace Noah\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;

class SettingsController extends Controller {

    /**
     * Show general setting page.
     * 
     * @return mixed
     * @author Cali
     */
    public function showGeneralSetting()
    {
        return view('admin.settings.general');
    }
    
    /**
     * Show services setting page.
     * 
     * @return mixed
     * @author Cali
     */
    public function showServicesSetting()
    {
        return view('admin.settings.services');
    }
}
