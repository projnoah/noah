<?php

namespace Noah\Library\Traits\Controller;

trait APIResponse {

    /**
     * Return success response accordingly.
     *
     * @param array|string $attributes
     * @param null  $to
     * @return array
     *
     * @author Cali
     */
    protected function successResponse($attributes = [], $to = null)
    {
        if (request()->ajax()) {
            return $this->ajaxSuccessResponse($attributes);
        }

        return $to ?
            redirect($to)->with($this->ajaxSuccessResponse($attributes)) :
            redirect()->back()->with($this->ajaxSuccessResponse($attributes));
    }

    /**
     * Return error response accordingly.
     *
     * @param array|string $attributes
     * @param null         $to
     * @return array
     * 
     * @author Cali
     */
    protected function errorResponse($attributes = [], $to = null)
    {
        if (request()->ajax()) {
            return $this->ajaxErrorResponse($attributes);
        }

        return $to ?
            redirect($to)->with($this->ajaxErrorResponse($attributes)) :
            redirect()->back()->with($this->ajaxErrorResponse($attributes));
    }

    /**
     * Return success response for AJAX request.
     *
     * @param array|string $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxSuccessResponse($attributes)
    {
        return is_string($attributes) ? [
            'status'  => 'succeeded',
            'message' => $attributes
        ] : array_merge(
            ['status' => 'succeeded',],
            $attributes
        );
    }

    /**
     * Return error response for AJAX request.
     *
     * @param array|string $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxErrorResponse($attributes)
    {
        return is_string($attributes) ? [
            'status'  => 'error',
            'message' => $attributes
        ] : array_merge(
            ['status' => 'error',],
            $attributes
        );
    }
}