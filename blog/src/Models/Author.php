<?php namespace Arcanesoft\Blog\Models;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\User;
use Arcanesoft\Blog\Base\Model;
use Arcanesoft\Blog\Blog;

/**
 * Class     Author
 *
 * @package  Arcanesoft\Blog\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  int                         user_id
 * @property  string                      username
 * @property  string                      slug
 * @property  string                      bio
 * @property  array                       meta
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 *
 * @property-read  \App\Models\User|\Arcanesoft\Auth\Models\User  $user
 */
class Author extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Presenters\AuthorPresenter;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'slug',
        'bio',
        'avatar',
        'meta',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'meta' => 'array',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(Blog::table('authors'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * User's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            Auth::model('user', User::class),
            'user_id'
        );
    }

    /**
     * Posts' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(
            Blog::model('post'),
            'author_id'
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the author is deletable.
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->user->isDeletable();
    }

    /**
     * Check if the author is not deletable.
     *
     * @return bool
     */
    public function isNotDeletable(): bool
    {
        return ! $this->isDeletable();
    }
}
