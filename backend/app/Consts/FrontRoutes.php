<?php
namespace App\Consts;
enum FrontRoutes : string{
    case DASHBOARD = '/dashboard';
    case LOGIN = '/login';

    case RESET_PASSWORD = '/reset-password';
}
