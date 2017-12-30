<?php

namespace Skytells\Database\Eloquent;

interface Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Skytells\Database\Eloquent\Builder  $builder
     * @param  \Skytells\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model);
}
