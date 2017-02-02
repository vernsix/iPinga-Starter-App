<?php
defined('__VERN') or die('Restricted access');

Class utilities
{

    /**
     * @param $table \ipinga\table
     * @param $keyValueArray array
     *
     * @return \ipinga\table
     */
    public static function popTableFromKeyValueArray($table, $keyValueArray)
    {
        foreach ($keyValueArray as $k => $v) {
            if (array_key_exists($k, $table->field) == true) {
                $table->field[$k] = $v;
            }
        }
        return $table;
    }


}