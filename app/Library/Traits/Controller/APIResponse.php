<?php

namespace Noah\Library\Traits\Controller;

trait APIResponse {

    /**
     * Return success response accordingly.
     * 
     * @param array $attributes
     * @return array
     * 
     * @author Cali
     */
    protected function successResponse($attributes = [])
    {
        return request()->ajax() ?
            $this->ajaxSuccessResponse($attributes) : 
            redirect()->intended()->with($this->ajaxSuccessResponse());
    }

    /**
     * Return error response accordingly.
     *
     * @param array $attributes
     * @return array
     *
     * @author Cali
     */
    protected function errorResponse($attributes = [])
    {
        return request()->ajax() ?
            $this->ajaxErrorResponse($attributes) : 
            redirect()->intended()->with($this->ajaxErrorResponse());
    }

    /**
     * Return success response for AJAX request.
     *
     * @param array $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxSuccessResponse($attributes = [])
    {
        return array_merge(
            ['status' => 'succeeded',],
            $attributes
        );
    }

    /**
     * Return error response for AJAX request.
     *
     * @param array $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxErrorResponse($attributes = [])
    {
        return array_merge(
            ['status' => 'error',],
            $attributes
        );
    }
}