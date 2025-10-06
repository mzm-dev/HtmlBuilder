<?php

namespace Mzm\HtmlBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Prompts\FormBuilder;

class FormBuilderForm extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_builder_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'descriptions',
        'config',
        'elements',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'config' => 'array',
        'elements' => 'array',
    ];

    /**
     * Get all of the response for the FormBuilderForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function response(): HasMany
    {
        return $this->hasMany(FormBuilderResponse::class, 'form_id', 'id');
    }
}
