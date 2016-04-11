<?php

namespace Noah\Http\Controllers;

use Illuminate\Http\Request;

use Noah\Http\Requests;

class InstallationController extends Controller {
    
    /**
     * Show installation view of Noah.
     *
     * @return mixed
     * @author Cali
     */
    public function install($step = 1)
    {
        return view('installation.index', compact('step'));
    }

    /**
     * Handle the installation request.
     *
     * @param         $step
     * @param Request $request
     * @return mixed
     *
     * @author Cali
     */
    public function postInstall($step, Request $request)
    {
        $this->validateForm($step, $request);
        
        return redirect(route('install', compact('step'), false))
            ->with('status', $this->getSuccessMessages($step));
    }

    /**
     * Validates the installation form.
     *
     * @param         $step
     * @param Request $request
     * @return bool
     *
     * @author Cali
     */
    protected function validateForm($step, Request $request)
    {
        if ($step == 1) {
            $this->validate($request, [
                'db_host'     => 'required|max:30',
                'db_name'     => 'required',
                'db_user'     => 'required',
                'db_password' => 'required',
            ]);

            return true;
        }

        $this->validate($request, [
            'admin_username' => 'required|max:30',
            'admin_password' => 'required',
            'admin_email'    => 'required|email'
        ]);

        return true;
    }

    /**
     * Get the success messages.
     *
     * @param $step
     * @return array
     *
     * @author Cali
     */
    protected function getSuccessMessages($step)
    {
        if ($step == 1) {
            return [
                ['type' => 'success', 'detail' => ''],
            ];
        }

        return [
            ['type' => 'success', 'detail' => '']
        ];
    }
}
