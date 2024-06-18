<?php

namespace App\Helper;

class SideMenu
{
    private static $pages;

    public static function render()
    {
        self::$pages = [
            // Common pages
            ['slug' => 'home', 'name' => 'HOME', 'icon' => 'ni ni-world-2 text-primary', 'auth' => 'common', 'roles' => null],
            ['slug' => 'dashboard', 'name' => 'Dashboard', 'icon' => 'ni ni-tv-2 text-primary', 'auth' => 'common', 'roles' => null],
            ['slug' => 'transaksi', 'name' => 'Transaksi', 'icon' => 'ni ni-bullet-list-67 text-red', 'auth' => 'common', 'roles' => null],
            ['slug' => 'pembayaran', 'name' => 'Pembayaran', 'icon' => 'ni ni-money-coins text-green', 'auth' => true, 'roles' => [0, 1]],
            ['slug' => 'member', 'name' => 'Member', 'icon' => 'ni ni-single-02 text-yellow', 'auth' => 'common', 'roles' => null],
            ['slug' => 'setting', 'name' => 'Setting', 'icon' => 'ni ni-settings-gear-65 text-info', 'auth' => true, 'roles' => [1]],
            // Pages that require login
            ['slug' => 'auth/logout', 'name' => 'Logout', 'icon' => 'ni ni-button-power text-danger', 'auth' => true, 'roles' => null],
            // Pages that require no login
            ['slug' => 'auth/login', 'name' => 'Login', 'icon' => 'ni ni-key-25 text-info', 'auth' => false, 'roles' => null],
            // Role-specific pages
            ['slug' => 'admin/dashboard', 'name' => 'Admin Dashboard', 'icon' => 'ni ni-tv-2 text-primary', 'auth' => true, 'roles' => ['admin']],
            ['slug' => 'user/profile', 'name' => 'Profile', 'icon' => 'ni ni-single-02 text-yellow', 'auth' => true, 'roles' => ['0', 'admin']],
        ];

        $isLoggedIn = self::isLogin();
        $currentUrl = self::getCurrentUrl();
        $result = '<ul class="navbar-nav">';

        foreach (self::$pages as $page) {
            if (
                ($isLoggedIn && $page['auth'] === true || !$isLoggedIn && $page['auth'] === false || $page['auth'] === 'common')
                && (is_null($page['roles']) || self::isRole($page['roles']))
            ) {
                $isActive = strpos($currentUrl, $page['slug']) !== false ? 'active' : '';
                $result .= '<li class="nav-item ' . $isActive . '">';
                $result .= '<a class="nav-link" href="' . getBaseUrl() . $page['slug'] . '">';
                $result .= '<i class="' . $page['icon'] . '"></i> ' . $page['name'] . '</a>';
                $result .= '</li>';
            }
        }

        $result .= '</ul>';
        return $result;
    }

    private static function isLogin()
    {
        return isset($_SESSION['login']);
    }

    private static function getCurrentUrl()
    {
        $currentUrl = $_SERVER['REQUEST_URI'];
        return trim($currentUrl, '/');
    }

    private static function isRole($roles)
    {
        if (isset($_SESSION['login_role'])) {
            if (is_array($roles)) {
                return in_array($_SESSION['login_role'], $roles);
            } else {
                return $_SESSION['login_role'] == $roles;
            }
        }
        return false;
    }
}