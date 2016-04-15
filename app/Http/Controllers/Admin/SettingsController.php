<?php

namespace Noah\Http\Controllers\Admin;

use Site;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
use Noah\Library\Traits\Controller\APIResponse;

class SettingsController extends Controller {

    use APIResponse;

    /**
     * Show general setting page.
     *
     * @return mixed
     * @author Cali
     */
    public function showGeneralSettings()
    {
        return view('admin.settings.general');
    }

    /**
     * Show services setting page.
     *
     * @return mixed
     * @author Cali
     */
    public function showServicesSettings()
    {
        return view('admin.settings.services');
    }

    /**
     * Save general settings.
     *
     * @param         $type
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveGeneralSettings($type, Request $request)
    {
        $this->validate($request, $this->getGeneralSettingsRules($type));

        // For redirection purpose
        $oldAdminUri = site('adminUri');
        
        Site::__callStatic(camel_case("save_general_{$type}_settings"), [$request]);

        return $oldAdminUri === site('adminUri') ? $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans("views.admin.pages.settings.general.$type.heading")
            ])
        ]) : $this->successResponse([
            'redirectUrl' => url(site('adminUri'))
        ]);
    }

    /**
     * Get general settings validation rules.
     *
     * @param $type
     * @return array
     * @author Cali
     */
    protected function getGeneralSettingsRules($type)
    {
        if ($type == 'basics') {
            return [
                'site_title'   => 'required|max:50',
                'home_uri'     => 'required|max:50',
                'social_uri'   => 'required|max:50',
                'post_uri'     => 'required|max:50',
                'admin_uri'    => 'required|max:50',
                'registration' => 'required|in:yes,no',
                'admin_email'  => 'required|email'
            ];
        }
        
        return [
            'site_separator'   => 'required|max:50',
            'site_description' => 'required|min:10|max:300'
        ];
    }
}
