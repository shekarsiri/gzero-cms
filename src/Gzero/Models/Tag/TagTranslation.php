<?php namespace Gzero\Models\Tag;

use Gzero\Models\Translation;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class TagTranslation
 *
 * @package    Gzero\Models\Tag
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class TagTranslation extends Translation {

    protected $fillable = array(
        'name',
        'is_active'
    );

    /**
     * Represents tag relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('Gzero\Models\Tag\Tag');
    }

    /**
     * Represents lang relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lang()
    {
        return $this->belongsTo('Gzero\Models\Lang');
    }
} 
