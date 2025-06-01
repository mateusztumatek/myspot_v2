<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\Conversions\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventCategory extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\EventCategoryFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['parent_id', 'name', 'slug'];

    public function parent() : BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(EventCategory::class, 'parent_id');
    }

    // Icon as spatie media relation

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('icon')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('icon')
            ->fit(Fit::Crop, 100, 100)
            ->nonQueued();
    }
}
