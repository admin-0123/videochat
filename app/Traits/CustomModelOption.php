<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait CustomModelOption
{
    public function getSortBy($sortOptions = array(), $defaultSortBy = null) : string
    {
        $sortBy = request()->query('sort_by');

        return in_array($sortBy, $sortOptions) ? $sortBy : $defaultSortBy;
    }

    public function getOrder($defaultOrderBy = 'desc') : string
    {
        $order =  request()->query('order', 'desc');

        return in_array($order, ['asc', 'desc']) ? $order : $defaultOrderBy;
    }

    public function getPerPage() : int
    {
        $per_page = (int)  request()->query('per_page', config('config.system.per_page'));

        // if (! is_integer($per_page)) {
        //     $per_page = config('config.system.per_page');
        // }

        if ($per_page <= 0 || $per_page > 100) {
            $per_page = config('config.system.per_page');
        }

        return $per_page;
    }

    public function getCurrentPage() : int
    {
        $current_page =  request()->query('current_page', 1);

        if (! is_integer($current_page)) {
            $current_page = 1;
        }

        if ($current_page <= 0 || $current_page > 100) {
            $current_page = 1;
        }

        return $current_page;
    }
}
