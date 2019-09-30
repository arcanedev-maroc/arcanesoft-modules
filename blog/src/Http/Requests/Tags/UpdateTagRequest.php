<?php namespace Arcanesoft\Blog\Http\Requests\Tags;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Http\Requests\FormRequest;
use Arcanesoft\Blog\Http\Routes\TagsRoutes;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class     UpdateTagRequest
 *
 * @package  Arcanesoft\Blog\Http\Requests\Tags
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateTagRequest extends FormRequest
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
        $tag = $this->getCurrentTag();

        return [
            'name' => ['required', 'string', Rule::unique(Blog::table('tags'), 'name')->ignore($tag->id)],
            'slug' => ['required', 'string', Rule::unique(Blog::table('tags'), 'slug')->ignore($tag->id)],
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

    /**
     * Get the current tag.
     *
     * @return \Arcanesoft\Blog\Models\Tag|mixed
     */
    protected function getCurrentTag()
    {
        return $this->route()->parameter(TagsRoutes::TAG_WILDCARD);
    }
}
