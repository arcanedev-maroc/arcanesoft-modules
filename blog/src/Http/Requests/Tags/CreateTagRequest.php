<?php namespace Arcanesoft\Blog\Http\Requests\Tags;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Http\Requests\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class     CreateTagRequest
 *
 * @package  Arcanesoft\Blog\Http\Requests\Tags
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateTagRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(Blog::table('tags'), 'name')],
            'slug' => ['required', 'string', Rule::unique(Blog::table('tags'), 'slug')],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ( ! $this->get('slug'))
            $this->merge([
                'slug' => Str::slug($this->get('name')),
            ]);
    }

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function getValidatedData(): array
    {
        return $this->all([
            'name',
            'slug',
        ]);
    }
}
