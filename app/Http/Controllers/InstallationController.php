<?php

namespace Noah\Http\Controllers;

use File;
use Auth;
use Schema;
use Artisan;
use Noah\User;
use Noah\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;

class InstallationController extends Controller {

    /**
     * Paths that must be writable.
     *
     * @var array
     */
    protected $writablePaths = [
        'storage', 'public/upgrades'
    ];

    /**
     * Determine if any error happened.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $errorMessages;

    /**
     * InstallationController constructor.
     */
    public function __construct()
    {
        $this->errorMessages = collect([]);
    }

    /**
     * Show installation view of Noah.
     *
     * @return mixed
     * @author Cali
     */
    public function install($step = 1)
    {
        if (! File::exists(base_path('step-1.lock')) &&
            $step == 2 && ! session()->has('status')
        ) {
            $step = 1;

            return redirect(route('install', compact('step'), false));
        }

        if (File::exists(base_path('step-1.lock')) &&
            $step == 1 && ! session()->has('status')
        ) {
            $step = 2;

            return redirect(route('install', compact('step'), false));
        }

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

        if ($step == 1) {
            $credentials = [
                'host'     => $request->input('db_host'),
                'database' => $request->input('db_name'),
                'username' => $request->input('db_user'),
                'password' => $request->input('db_password'),
                'prefix'   => $request->input('db_prefix')
            ];

            if ($this->checkWritability()
                ->checkDatabaseCredentials($credentials)
            ) {
                File::put(base_path('step-1.lock'), '#');
            }
        } else {
            $credentials = [
                'email'    => $request->input('admin_email'),
                'username' => $request->input('admin_username'),
                'password' => $request->input('admin_password'),
            ];

            $this->migrateAndCreateAdmin($credentials);

            return redirect(route('dashboard'));
        }

        if ($this->errorMessages->count()) {
            return redirect(route('install', compact('step'), false))
                ->with([
                    'status'    => $this->buildErrorMessages(),
                    'succeeded' => 0
                ]);
        }

        return redirect(route('install', compact('step'), false))
            ->with([
                'status'    => $this->getSuccessMessages($step),
                'succeeded' => 1
            ]);
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
            'admin_username' => 'required|max:50|min:3',
            'admin_password' => 'required|min:6',
            'admin_email'    => 'required|email'
        ]);

        return true;
    }

    /**
     * Check the directories for writability.
     *
     * @return $this
     * @author Cali
     */
    protected function checkWritability()
    {
        foreach ($this->writablePaths as $path) {
            if (! File::isWritable(base_path($path))) {
                $this->errorMessages->push(
                    trans('views.installation.errors.unwritable', compact('path'))
                );
            }
        }

        return $this;
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
                [
                    'type' => 'success', 'detail' => trans('views.installation.success.writable')
                ],
                [
                    'type' => 'success', 'detail' => trans('views.installation.success.database_connection')
                ],
            ];
        }

        return [
            [
                'type'   => 'success',
                'detail' => trans('views.installation.success.done')
            ]
        ];
    }

    /**
     * Verify the database credentials.
     *
     * @param $credentials
     * @return bool
     * @author Cali
     */
    protected function checkDatabaseCredentials($credentials)
    {
        if (! $this->saveCredentialsToEnvironment($credentials)) {
            return false;
        }

        return $this->checkDatabaseConnection();
    }

    /**
     * Test the database connection.
     *
     * @return bool|int|mixed
     * @author Cali
     */
    protected function testConnection()
    {
        $error = null;

        try {
            Schema::create('pre-install', function (Blueprint $table) {
                $table->increments('id');
            });
            Schema::drop('pre-install');
        } catch (\Exception $e) {
            $error = $e->getCode();
        }

        return is_null($error) ? true : $error;
    }

    /**
     * Build the error messages to return in view.
     *
     * @return array
     * @author Cali
     */
    protected function buildErrorMessages()
    {
        $errors = [];

        foreach ($this->errorMessages as $message) {
            array_push($errors, [
                'type'   => 'fail',
                'detail' => $message
            ]);
        }

        return $errors;
    }

    /**
     * Save the credentials to .env
     *
     * @param $credentials
     * @return bool
     * @author Cali
     */
    protected function saveCredentialsToEnvironment($credentials)
    {
        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
        }

        if (($env_result = env_put('DB_HOST', $credentials['host'])) === ENV_UPDATED) {
            env_put('DB_USERNAME', $credentials['username']);
            env_put('DB_PASSWORD', $credentials['password']);
            env_put('DB_DATABASE', $credentials['database']);
            env_put('APP_ENV', 'production');
            env_put('APP_DEBUG', 'false');
            env_put('APP_URL', url('/'));

            if (($prefix = trim($credentials['prefix'])) !== "") {
                env_put('DB_PREFIX', $prefix);
            }

            return true;
        } else {
            if ($env_result === ENV_DENIED) {
                $this->errorMessages->push(
                    trans('views.installation.errors.env_denied')
                );
            } else {
                $this->errorMessages->push(
                    trans('views.installation.errors.env_not_found')
                );
            }

            return false;
        }
    }

    /**
     * Check the database connection.
     *
     * @return bool
     * @author Cali
     */
    protected function checkDatabaseConnection()
    {
        $result = $this->testConnection();

        if ($result === true) {
            return true;
        } elseif (is_int($result)) {
            switch ($result) {
                case DATABASE_ACCESS_DENIED:
                    $this->errorMessages->push(
                        trans('views.installation.errors.database_access_denied')
                    );
                    break;
                case DATABASE_NOT_FOUND:
                    $this->errorMessages->push(
                        trans('views.installation.errors.database_not_found')
                    );
                    break;
                case CONNECTION_REFUSED:
                    $this->errorMessages->push(
                        trans('views.installation.errors.connection_refused')
                    );
                    break;
                default:
                    $this->errorMessages->push(
                        trans('views.installation.errors.unknown')
                    );
                    break;
            }
        } else {
            $this->errorMessages->push(
                trans('views.installation.errors.unknown')
            );
        }

        return false;
    }

    /**
     * Create the admin account and migrate the database.
     *
     * @param $credentials
     * @author Cali
     */
    protected function migrateAndCreateAdmin($credentials)
    {
        env_put('ADMIN_EMAIL', $credentials['email'], true);

        Artisan::call('migrate', ['--force' => 'true']);

        $admin = User::createAdmin($credentials);
        Auth::login($admin, true);

        $this->writeLock();
    }

    /**
     * Write noah.lock to lock the installation.
     *
     * @author Cali
     */
    protected function writeLock()
    {
        File::delete(base_path('step-1.lock'));
        File::put(base_path('noah.lock'), 'Installed at ' . date('Y-m-d H:i:s'));
    }
}
