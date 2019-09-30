<?php namespace Arcanesoft\Support\Policies;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Trait     HasAbilities
 *
 * @package  Arcanesoft\Support\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasAbilities
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability by the given key.
     *
     * @param  string  $key
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function ability(string $key): string
    {
        $keys = static::keys();

        if ( ! $keys->has($key))
            throw new Exception("The method [$key] not found in ".static::class);

        return $keys->get($key);
    }

    /**
     * Get the keys.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function keys(): Collection
    {
        return static::toCollection()->mapWithKeys(function (PolicyMeta $meta) {
            return [$meta->id() => $meta->ability()];
        });
    }

    /**
     * Get the abilities.
     *
     * @return array
     */
    public static function abilities(): array
    {
        return static::toCollection()->mapWithKeys(function (PolicyMeta $meta) {
            return [$meta->id() => $meta->ability()];
        })->toArray();
    }

    /**
     * Get the policy's definitions.
     *
     * @return array
     */
    public static function definitions(): array
    {
        return static::toCollection()->mapWithKeys(function (PolicyMeta $meta) {
            return [$meta->ability() => static::class.'@'.$meta->method()];
        })->toArray();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the key prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return '';
    }

    /**
     * Get the metas as a collection.
     *
     * @return \Illuminate\Support\Collection
     */
    private static function toCollection(): Collection
    {
        return new Collection(static::metas());
    }

    /**
     * Get the seeds.
     *
     * @param  string|null  $category
     *
     * @return \Illuminate\Support\Collection
     */
    public static function seeds($category = null): Collection
    {
        return static::toCollection()->transform(function (PolicyMeta $meta) use ($category) {
            return [
                'category'    => $category,
                'ability'     => $meta->ability(),
                'name'        => $meta->getName(),
                'description' => $meta->getDescription(),
            ];
        });
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    abstract public static function metas() : array;

    /**
     * Make a new policy's meta.
     *
     * @param  string       $key
     * @param  string|null  $customMethod
     *
     * @return \Arcanesoft\Support\Policies\PolicyMeta
     */
    protected static function meta(string $key, ?string $customMethod = null): PolicyMeta
    {
        return PolicyMeta::make(
            $key,
            static::prefix().'.'.$key,
            ($customMethod ?: Str::camel($key))
        );
    }
}
