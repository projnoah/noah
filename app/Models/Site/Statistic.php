<?php

namespace Noah;

use DB;
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

    /**
     * Get the total page views.
     * 
     * @return int
     * @author Cali
     */
    public static function totalPageViews()
    {
        return static::count();
    }

    /**
     * Get the total user count.
     * 
     * @return int
     * @author Cali
     */
    public static function totalUsers()
    {
        return User::count();
    }

    /**
     * Get the total blog count.
     * 
     * @return int
     * @author Cali
     */
    public static function totalBlogs()
    {
        return Blog::count();
    }

    /**
     * Get the total comment count.
     *
     * @return int
     * @author Cali
     */
    public static function totalComments()
    {
        return Comment::count();
    }

    /**
     * Get the most browser.
     * 
     * @return mixed
     * @author Cali
     */
    public static function mostBrowser()
    {
        return self::getMostRecord('browser');
    }

    /**
     * Get the most platform.
     * 
     * @return mixed
     * @author Cali
     */
    public static function mostPlatform()
    {
        return self::getMostRecord('platform');
    }
    
    /**
     * Get the most city.
     * 
     * @return mixed
     * @author Cali
     */
    public static function mostCity()
    {
        return self::getMostRecord('city');
    }
    
    /**
     * Get the most device.
     * 
     * @return mixed
     * @author Cali
     */
    public static function mostDevice()
    {
        return self::getMostRecord('device');
    }

    /**
     * Get the most uri.
     * 
     * @return mixed
     * @author Cali
     */
    public static function mostUri()
    {
        return self::getMostRecord('uri');
    }

    /**
     * Get a most record.
     * 
     * @param $column
     * @return mixed
     * @author Cali
     */
    protected static function getMostRecord($column)
    {
        return static::select(DB::raw("count({$column}) as count, {$column} as name"))
            ->groupBy($column)->orderBy('count', 'desc')->first();
    }
}
