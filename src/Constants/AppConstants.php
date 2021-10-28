<?php

namespace JetBox\Repositories\Constants;

use ReflectionClass;

class AppConstants
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;
    const STATUS_PENDING = 3;

    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_USER = 'user';

    const PERMISSION_VIEW_ADMIN = 'view_admin';

    const PERMISSION_VIEW_USER = 'view_user';
    const PERMISSION_SHOW_USER = 'show_user';
    const PERMISSION_CREATE_USER = 'create_user';
    const PERMISSION_EDIT_USER = 'edit_user';
    const PERMISSION_DELETE_USER = 'delete_user';

    const PERMISSION_VIEW_SETTING = 'view_setting';
    const PERMISSION_SHOW_SETTING = 'show_setting';
    const PERMISSION_EDIT_SETTING = 'edit_setting';

    const PERMISSION_VIEW_ROLE = 'view_role';
    const PERMISSION_SHOW_ROLE = 'show_role';
    const PERMISSION_CREATE_ROLE = 'create_role';
    const PERMISSION_EDIT_ROLE = 'edit_role';
    const PERMISSION_DELETE_ROLE = 'delete_role';

    const PERMISSION_VIEW_LOG = 'view_log';

    const JOB_EMAIL_SEND_TIME_SECONDS = 10;
    const JOB_EMAIL_QUEUE = 'email';

    /**
     * @param string $constantName
     * @return array
     */
    protected static function getConstants(string $constantName): array
    {
        $constants = (new ReflectionClass(static::class))->getConstants();

        $values = array_filter($constants, function ($key, $name) use ($constantName) {
            return strpos($name, mb_strtoupper($constantName)) === 0;
        }, ARRAY_FILTER_USE_BOTH);

        return array_values($values);
    }

    /**
     * @return array
     */
    public static function permissions(): array
    {
        return static::getConstants('permission');
    }

    /**
     * @return array
     */
    public static function status(): array
    {
        return static::getConstants('status');
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        return static::getConstants('role');
    }
}
