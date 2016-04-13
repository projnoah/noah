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
     * Change admin theme.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function changeThemeColor(Request $request)
    {
        $user = $request->user();
        $user->changeAdminTheme([
            'theme' => $request->input('theme'),
            'color' => $request->input('color')
        ]);

        return $this->successResponse(['message' => trans('views.admin.theme-color-changed')]);
    }
}
