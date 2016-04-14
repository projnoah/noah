<?php

namespace Noah\Http\Controllers\Admin;

use Noah\Http\Requests;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
use Noah\Library\Traits\Controller\APIResponse;

class ManageController extends Controller {

    use APIResponse;

    /**
     * Display admin dashboard.
     *
     * @return mixed
     * @author Cali
     */
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Change admin theme setting.
     * 
     * @param Request $request
     * @return array
     * 
     * @author Cali
     */
    public function changeSetting(Request $request)
    {
        $user = $request->user();
        $user->changeAdminThemeSetting([
            'type'  => $request->input('type'),
            'value' => $request->input('value') == 'true'
        ]);

        return $this->successResponse([
            'message' => trans('views.admin.theme-setting-changed', [
                'type' => trans('views.admin.navbar.settings.' . $request->input('type'))
            ])
        ]);
    }

    /**
     * Change admin theme color.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function changeThemeColor(Request $request)
    {
        $user = $request->user();
        $user->changeAdminThemeColor([
            'theme' => $request->input('theme'),
            'color' => $request->input('color')
        ]);

        return $this->successResponse(['message' => trans('views.admin.theme-color-changed')]);
    }
}
