<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    /**
     * Apply filters to the query.
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function apply(Builder $query, array $filters): Builder
    {
        if (isset($filters['search']) && $filters['search']) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['user_type']) && $filters['user_type']) {
            $query->whereHas('roles', function ($q) use ($filters) {
                $q->where('name', $filters['user_type']);
            });
        }

        return $query;
    }
}
