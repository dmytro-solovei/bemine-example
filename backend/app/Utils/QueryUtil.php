<?php

namespace App\Utils;

class QueryUtil
{

    /**
     * @param $query
     * @return void
     */
    public static function getQuery($query)
    {
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        $sql_with_bindings = preg_replace_callback('/\?/', function ($match) use ($sql, &$bindings) {
            return json_encode(array_shift($bindings));
        }, $sql);

        return $sql_with_bindings;
    }
}
