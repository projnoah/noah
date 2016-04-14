<?php

namespace Noah;

use Location;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Noah\Library\Traits\Model\TimeSortable;

class Statistic extends Model {

    use TimeSortable;
    
    /**
     * Every attribute but id is mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Call dynamic method by string.
     *
     * @param $expression
     * @return mixed
     *
     * @author Cali
     */
    public static function callByExpression($expression, $params = [])
    {
        $parameters = [];
        array_push($parameters, $params);

        return static::__callStatic(camel_case($expression), $parameters);
    }
    
    /**
     * Record the visitation.
     *
     * @param Request $request
     * @author Cali
     */
    public static function visited(Request $request)
    {
        $userAgent = new Agent();
        $location = Location::get();

        static::create([
            'referer'  => url()->previous(),
            'uri'      => $request->path(),
            'browser'  => $userAgent->browser(),
            'platform' => $userAgent->platform(),
            'device'   => $userAgent->device(),
            'mobile'   => ! $userAgent->isDesktop(),
            'ip'       => $location->ip,
            'country'  => $location->isoCode,
            'city'     => $location->cityName,
        ]);
    }

    /**
     * Get new users count by the sorting method.
     * 
     * @param       $method
     * @param array $params
     * @return int
     * 
     * @author Cali
     */
    public static function newUsers($method = 'today', $params = [])
    {
        return call_user_func_array([new User, camel_case($method)], $params)->count();
    }

    /**
     * Get the ratio for new users.
     * 
     * @param string $method
     * @return float
     * 
     * @author Cali
     */
    public static function newUsersRatio($method = 'today')
    {
        return (static::newUsers($method) / User::count()) * 100;
    }

    /**
     * Get a specific scope page views.
     * 
     * @param string $method
     * @param array  $params
     * @return int
     *
     * @author Cali
     */
    public static function pageViews($method = 'today', $params = [])
    {
        return call_user_func_array([new static, camel_case($method)], $params)->count();
    }

    /**
     * Get the ratio for page views.
     * 
     * @param string $method
     * @return float
     * 
     * @author Cali
     */
    public static function pageViewsRatio($method = 'today')
    {
        return (static::pageViews($method) / static::count()) * 100;
    }
}
