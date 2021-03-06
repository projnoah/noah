<?php

/*
 |------------------------------------------------------------
 | Routes Registration Entry
 | 路由注册 入口
 |------------------------------------------------------------
 |
 | All routes are registered here and only here
 | feel free to add your own, call the Route
 | Facade with the request method, done.
 |
 | @project Project Noah
 | @author Cali
 |
 */

if (! noah_installed()) {
    Router::installations();
} else {
    Router::dashboards()
        ->language()
        ->auth();

    Router::admins()->robots();

    Router::users();
}