<?php

namespace Noah\Http\Controllers\Admin;

use Noah;
use Site;
use Mailer;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;

class SettingsController extends Controller {

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
     * Show database settings page.
     *
     * @return mixed
     * @author Cali
     */
    public function showDatabaseSettings()
    {
        return view('admin.settings.database');
    }

    /**
     * Show cache settings page.
     *
     * @return mixed
     * @author Cali
     */
    public function showCacheSettings()
    {
        return view('admin.settings.cache');
    }

    /**
     * Show upgrade settings page.
     *
     * @return mixed
     * @author Cali
     */
    public function showUpgradeSettings()
    {
        return view('admin.settings.upgrade');
    }

    /**
     * Show sub-domains settings.
     *
     * @return mixed
     * @author Cali
     */
    public function showSubDomainsSettings()
    {
        return view('admin.settings.sub-domains');
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

    /**
     * Save storage settings.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveServicesStorageSettings(Request $request)
    {
        $this->validate($request, ['type' => 'required']);

        Site::saveServicesStorageSettings($request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.settings.services.storage.heading')
            ])
        ]);
    }

    /**
     * Save disks credentials.
     *
     * @param         $disk
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveServicesDiskSettings($disk, Request $request)
    {
        $this->validate($request, $this->getDiskRules($disk));

        Site::saveServicesDiskSettings($disk, $request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.settings.services.storage.heading')
            ])
        ]);
    }

    /**
     * Get disk validation rules.
     *
     * @param $disk
     * @return array
     *
     * @author Cali
     */
    protected function getDiskRules($disk)
    {
        switch ($disk) {
            case 'ftp':
                return [
                    'ftp_host' => 'required',
                    'username' => 'required',
                    'password' => 'required',
                ];
            case 's3':
                return [
                    'key'    => 'required',
                    'secret' => 'required',
                    'region' => 'required',
                    'bucket' => 'required',
                ];
            case 'rackspace':
                return [
                    'key'       => 'requried',
                    'username'  => 'requried',
                    'secret'    => 'required',
                    'region'    => 'required',
                    'endpoint'  => 'required',
                    'container' => 'required',
                    'url_type'  => 'required',
                ];
            case 'qiniu':
                return [
                    'access_key' => 'required',
                    'secret_key' => 'required',
                    'bucket'     => 'required',
                    'default'    => 'required',
                ];
        }
    }

    /**
     * Save develop settings.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveAdvancedDevelopSettings(Request $request)
    {
        Site::saveAdvancedDevelopSettings($request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.settings.advanced.develop.title')
            ])
        ]);
    }

    /**
     * Refresh cache or clear it out.
     *
     * @param        $type
     * @param string $action
     * @return array
     *
     * @author Cali
     */
    public function doCacheByType($type, $action = 'refresh')
    {
        Site::doCacheByType($type, $action);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.advanced.cache.' . $action . 'ed', [
                'type' => trans('views.admin.pages.settings.advanced.cache.' . $type)
            ])
        ]);
    }

    /**
     * Upload site logo.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function uploadLogo(Request $request)
    {
        $file = $request->file('logo');

        $file->move('assets', 'logo.png');

        if (site('logoVersion')) {
            Site::logoVersion(intval(site('logoVersion')) + 1);
        } else {
            Site::logoVersion('1');
        }

        return response('/assets/logo.png?ver=' . site('logoVersion'), 200, ['Content-type' => 'text/plain']);
    }

    /**
     * Save sub-domains settings.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function saveSubDomainsSettings(Request $request)
    {
        Site::saveSubDomainsSettings($request);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.titles.settings.sub.advanced.sub-domains')
            ])
        ]);
    }

    /**
     * Upgrade the application.
     *
     * @author Cali
     */
    public function upgrade()
    {
        if (Noah::getNewVersion() != noah_version()) {
            Noah::upgrade();
        }
    }

    /**
     * Get the upgrade log.
     * 
     * @return array
     * @author Cali
     */
    public function getUpgradeLog()
    {
        if (str_contains(Noah::log(), 'UPGRADE_COMPLETE')) {
            return [
                'upgrade' => 'complete'
            ];
        } else {
            $m = Noah::log();

            return [
                'upgrade' => 'pending',
                'message' => str_replace(PHP_EOL, '', $m)
            ];
        }
    }
}
