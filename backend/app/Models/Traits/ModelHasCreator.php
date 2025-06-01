<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait ModelHasCreator
{
    public static function bootModelHasCreator()
    {
        static::creating(function (Model $model) {
            if (auth()->check() && !$model->created_by) {
                $model->created_by = auth()->id();
            }

            if(!$model->created_by){
                throw new \LogicException('Model has not assigned creator.');
            }
        });
    }
}
