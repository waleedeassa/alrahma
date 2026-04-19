<?php

namespace App\Traits;

trait HasHomeRoute
{
    private const HOME_ROUTES = [
        1 => 'admin.dashboard',
        2 => 'admin.orphans.index',
        3 => 'admin.difficult-case-families.index',
        4 => 'admin.special-needs-people.index',
    ];

    public function homeRoute(): string
    {
        $roleId = (int) $this->roles->first()?->id;
        $routeName = self::HOME_ROUTES[$roleId] ?? null;
        return route($routeName ?? 'login');
    }

    public static function isCoreRole(int $roleId): bool
    {
        return array_key_exists($roleId, self::HOME_ROUTES);
    }
}
