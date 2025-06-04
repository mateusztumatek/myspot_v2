<?php

namespace App\Models;

use App\Exceptions\EventMaxAttendeesExceededException;
use App\Models\Traits\ModelHasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

/**
 * @property string $uuid
 * @property ?int $max_attendees
 */
class Event extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, HasUuid, ModelHasCreator, InteractsWithMedia;

    /**
     * REPLACE THE FOLLOWING ARRAYS IN YOUR Event MODEL
     *
     * Replace your existing $fillable and/or $guarded and/or $appends arrays with these - we already merged
     * any existing attributes from your model, and only included the one(s) that need changing.
     */


    protected $fillable = [
        'uuid',
        'created_by',
        'name',
        'description',
        'category_id',
        'location_name',
        'location_latitude',
        'location_longitude',
        'start_at',
        'end_at',
        'visibility',
        'max_attendees',
        'sign_up_until',
        'user_visibility',
        'paid',
        'payment_details',

        // Computed value
        'location',
    ];

    protected $appends = [
        'location',
    ];

    protected $casts = [
        'payment_details' => 'json',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'sign_up_until' => 'datetime',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function attendees() : HasMany
    {
        return $this->hasMany(EventAttendee::class);
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
            ]);

    }
    /**
     * ADD THE FOLLOWING METHODS TO YOUR Event MODEL
     *
     * The 'location_latitude' and 'location_longitude' attributes should exist as fields in your table schema,
     * holding standard decimal latitude and longitude coordinates.
     *
     * The 'location' attribute should NOT exist in your table schema, rather it is a computed attribute,
     * which you will use as the field name for your Filament Google Maps form fields and table columns.
     *
     * You may of course strip all comments, if you don't feel verbose.
     */

    /**
     * Returns the 'location_latitude' and 'location_longitude' attributes as the computed 'location' attribute,
     * as a standard Google Maps style Point array with 'lat' and 'lng' attributes.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @return array
     */

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float)$this->location_latitude,
            "lng" => (float)$this->location_longitude,
        ];
    }

    /**
     * Takes a Google style Point array of 'lat' and 'lng' values and assigns them to the
     * 'location_latitude' and 'location_longitude' attributes on this model.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @param ?array $location
     * @return void
     */
    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location))
        {
            $this->attributes['location_latitude'] = $location['lat'];
            $this->attributes['location_longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    /**
     * Get the lat and lng attribute/field names used on this table
     *
     * Used by the Filament Google Maps package.
     *
     * @return string[]
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'location_latitude',
            'lng' => 'location_longitude',
        ];
    }

    /**
     * Get the name of the computed location attribute
     *
     * Used by the Filament Google Maps package.
     *
     * @return string
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function getRouteKeyName() : string
    {
        return 'uuid';
    }

    public function validateAttendeesCount() : void
    {
        if(!$this->max_attendees) return;
        if($this->attendees()->count() > $this->max_attendees){
            throw new EventMaxAttendeesExceededException($this);
        }
    }
}
