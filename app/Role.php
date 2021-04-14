<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Options\ZooOptions;

class Role extends Model
{
    /**
     * Returns role by name provided. Can throw an exception.
     * @param  string $name Role name
     * @return App\Role     Role object
     */
    private static function getRoleByName(string $name)
    {
        return self::where('name', '=', $name)->first();
    }

    /**
     * Returns admin role. Can throw an exception.
     * @return App\Role Administrator Role object
     */
    public static function getAdminRole()
    {
        return self::getRoleByName('admin');
    }
}
