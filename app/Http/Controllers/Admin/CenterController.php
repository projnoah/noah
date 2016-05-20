<?php

namespace Noah\Http\Controllers\Admin;

use Noah\Blog;
use Noah\User;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;

class CenterController extends Controller {

    /**
     * Show index page of data center.
     *
     * @return mixed
     * @author Cali
     */
    public function showIndex()
    {
        return view('admin.center.index');
    }

    /**
     * Show factory page.
     *
     * @return mixed
     * @author Cali
     */
    public function showFactory()
    {
        return view('admin.center.factory');
    }

    /**
     * Create model factory.
     * 
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function createFactory(Request $request)
    {
        $this->validate($request, [
            'model'    => 'required',
            'quantity' => 'numeric|required'
        ]);

        try {
            $this->generateModelFactory($request->input('model'), intval($request->input('quantity')));
        } catch (\Exception $e) {
            return $this->errorResponse([
                'message' => trans('views.admin.pages.data-center.factory.half-created')
            ]);
        }

        return $this->successResponse([
            'message' => trans('views.admin.pages.data-center.factory.created', [
                'q' => $request->input('quantity'),
                'model' => trans('views.admin.pages.data-center.factory.models.' . $request->input('model'))
            ])
        ]);
    }

    /**
     * Generate model factory and persists into database.
     *
     * @param $model
     * @param $quantity
     * @return mixed
     *
     * @author Cali
     */
    protected function generateModelFactory($model, $quantity)
    {
        switch ($model) {
            case 'user':
                $model = User::class;
                break;
            case 'blog':
                $model = Blog::class;
                break;
        }

        return factory($model, $quantity)->create();
    }
}