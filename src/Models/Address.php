<?php
/**
 * Address Model
 *
 * @author Del
 */

namespace Delatbabel\Contacts\Models;

use Delatbabel\Fluents\Fluents;
use Delatbabel\Keylists\Models\Keyvalue;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Address Model
 *
 * Contains addresses which may map to contacts or companies.
 */
class Address extends Model
{
    use SoftDeletes, Fluents;

    /** @var array */
    protected $guarded = ['id'];

    protected $casts = [
        'extended_data'     => 'array',
    ];

    /**
     * Many:Many relationship with Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany('Delatbabel\Contacts\Models\Contact')
            ->withPivot(['address_type', 'status', 'start_date', 'end_date']);
    }

    /**
     * Many:Many relationship with Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('Delatbabel\Contacts\Models\Company')
            ->withPivot(['address_type', 'status', 'start_date', 'end_date']);
    }

    /**
     * Get all of the address types (categories).
     *
     * Returns a key => value array, e.g.
     * billing => Billing
     * Suitable for use in pull-down lists.
     *
     * @return array
     */
    public static function getTypes()
    {
        return Keyvalue::getKeyValuesByType('address-types');
    }

    /**
     * Get all of the address statuses (categories).
     *
     * Returns a key => value array, e.g.
     * current => Current
     * Suitable for use in pull-down lists.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return Keyvalue::getKeyValuesByType('address-statuses');
    }
}