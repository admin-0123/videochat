<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class ArrHelper
{
    /**
     * Get json variables from resources in array
     * @param string $list
     * @param string $type
     */
    public static function getVar($list, $type = null) : array
    {
        $file = resource_path('var/'.($type ? ($type.'/') : '').$list.'.json');

        return (\File::exists($file)) ? (json_decode(file_get_contents($file), true) ? : []) : [];
    }

    /**
     * Get list by key
     * @param string $key
     * @param string $type
     */
    public static function getList($key, $type = 'general') : array
    {
        $lists = self::getVar('list');

        return Arr::get($lists, $type.'.'.$key, []);
    }

    /**
     * Get translated list by key
     * @param string $key
     * @param string $type
     * @param boolean $sort
     */
    public static function getTransList($key, $type = 'general', $sort = true) : array
    {
        $list  = self::getList($key, $type);

        $data = array();
        foreach ($list as $item) {
            $data[] = array('uuid' => $item, 'name' => __('list.'.$type.'.'.$key.'.'.$item));
        }

        if ($sort) {
            array_multisort(array_map(function ($element) {
                  return $element['uuid'];
            }, $data), SORT_ASC, $data);
        }

        return $data;
    }

    /**
     * Get translated list by key
     * @param string $key
     * @param string $type
     * @param boolean $sort
     */
    public static function getAdvTransList($key, $type = 'general', $except = [], $sort = true) : array
    {
        $list  = self::getList($key, $type);

        $data = array();
        foreach ($list as $item) {
            if (empty($except) || ! in_array($item, $except)) {
                $data[] = array('uuid' => $item, 'name' => __('list.'.$type.'.'.$key.'.'.$item));
            }
        }

        if ($sort) {
            array_multisort(array_map(function ($element) {
                  return $element['uuid'];
            }, $data), SORT_ASC, $data);
        }

        return $data;
    }

    /**
     * Search multidimension array by key & value
     * @param  array $data
     * @param  string $key
     * @param  string $value
     */
    public static function searchByKey($data, $key, $value) : array
    {
        $index = array_search($value, array_column($data, $key));

        return ($index === false) ? [] : $data[$index];
    }

    /**
     * Remove array value
     *
     * @param array $array
     * @param string $value
     */
    public static function removeByValue($array, $value) : array
    {
        return array_values(array_diff($array, (is_array($value) ? $value : array($value))));
    }

    /**
     * Get select list
     * @param array $items
     * @param boolean $key
     */
    public static function getSelectList($items, $key = false) : array
    {
        $data = array();
        foreach ($items as $index => $item) {
            $data[] = array('uuid' => ($key) ? $index : $item, 'name' => $item);
        }

        return $data;
    }

    /**
     * Get childs
     * @param array $array
     */
    public static function getChilds($array, $currentParent = 1, $level = 1, $child = array(), $currLevel = 0, $prevLevel = -1) : array
    {
        foreach ($array as $categoryId => $category) {
            if ($currentParent === $category) {
                if ($currLevel > $prevLevel) {
                }
                if ($currLevel === $prevLevel) {
                }
                $child[] = $categoryId;
                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }
                $currLevel++;
                if ($level) {
                    $child = self::getChilds($array, $categoryId, $level, $child, $currLevel, $prevLevel);
                }
                $currLevel--;
            }
        }
        if ($currLevel === $prevLevel) {
        }
        return $child;
    }

    public static function getQueryFromUrl($url = null, $variable = null) : ?string
    {
        if (! $url || ! $variable) {
            return null;
        }

        $query = Arr::get(parse_url($url), 'query');
        parse_str($query, $params);
        return Arr::get($params, $variable);
    }
}
