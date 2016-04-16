<?php

namespace Noah\Http\Controllers\Admin;

use Site;
use Mailer;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
use Noah\Library\Traits\Controller\APIResponse;

class SettingsController extends Controller {

    use APIResponse;

    /**
     * Show general settings page.
     *
     * @return mixed
     * @author Cali
     */
    public function showGeneralSettings()
    {
        return view('admin.settings.general');
    }

    /**
     * Show services settings page.
     *
     * @return mixed
     * @author Cali
     */
    public function showServicesSettings()
    {
        return view('admin.settings.services');
    }

    /**
     * Show advanced settings page.
     * 
     * @return mixed
     * @author Cali
     */
    public function showAdvancedSettings()
    {
        return view('admin.settings.advanced');
    }

    /**
     * Show display settings page.
     * 
     * @return mixed
     * @author Cali
     */
    public function showDisplaySettings()
    {
        return view('admin.settings.display');
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
        switch ($type) {
            case 'basics':
                return [
                    'site_title'   => 'required|max:50',
                    'home_uri'     => 'required|max:50',
                    'social_uri'   => 'required|max:50',
                    'post_uri'     => 'required|max:50',
                    'admin_uri'    => 'required|max:50',
                    'registration' => 'required|in:yes,no',
                    'admin_email'  => 'required|email'
                ];
            case 'seo':
                return [
                    'site_separator'   => 'required|max:50',
                    'site_description' => 'required|min:10|max:300'
                ];
            case 'region':
                return [];
            default:
                return ['icp' => 'max:50'];
        }
    }

    /**
     * Save the oAuth applications settings.
     *
     * @param         $service
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveServicesOAuthSettings($service, Request $request)
    {
        $this->validate($request, [
            'app_id'     => 'required',
            'app_secret' => 'required',
            'redirect'   => 'required|url'
        ]);

        Site::saveServicesOAuthSettings($service, $request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => strtoupper(substr($service, 0, 1)) . substr($service, 1)
            ])
        ]);
    }

    /**
     * Save the email settings.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveServicesEmailSettings(Request $request)
    {
        $this->validate($request, [
            'mail_driver'     => 'required|in:smtp,mailgun',
            'mail_host'       => 'required|max:100',
            'mail_port'       => 'required|numeric',
            'mail_password'   => 'required',
            'mail_encryption' => 'required|in:tsl,ssl'
        ]);

        Site::saveServicesEmailSettings($request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.settings.services.email.heading')
            ])
        ]);
    }

    /**
     * Send the test email.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function sendTestEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        try {
            Mailer::subject(trans('emails.test-out'))->to($request->input('email'))
                ->load('admin.settings.related.test-email')->send();
        } catch (\Exception $e) {
            return $this->errorResponse([
                'message' => trans('views.admin.pages.settings.services.email.test-failure')
            ]);
        }

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.services.email.test-success')
        ]);
    }

    /**
     * Save pusher settings.
     * 
     * @param Request $request
     * @return array
     * 
     * @author Cali
     */
    public function saveServicesPushSettings(Request $request)
    {
        $this->validate($request, [
            'app_id' => 'required',
            'key'    => 'required',
            'secret' => 'required'
        ]);
        
        Site::saveServicesPushSettings($request);
        
        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.settings.services.push.heading')
            ])
        ]);
    }
}
