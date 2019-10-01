<?php

namespace Arcanesoft\Support\Policies;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class     PolicyMeta
 *
 * @package  Arcanesoft\Support\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PolicyMeta implements Arrayable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    private $id;

    /** @var  string */
    private $ability;

    /** @var  string */
    private $method;

    /** @var  string|null */
    private $name;

    /** @var  string|null */
    private $description;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PolicyMeta constructor.
     *
     * @param  string  $id
     * @param  string  $ability
     * @param  string  $method
     */
    public function __construct($id, $ability, $method)
    {
        $this->id      = $id;
        $this->ability = trim($ability, '.');
        $this->method  = $method;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get the ability name.
     *
     * @return string
     */
    public function ability()
    {
        return $this->ability;
    }

    /**
     * Get the method.
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Set the name.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function name(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name.
     *
     * @return string|null
     */
    public function getName()
    {
        return __($this->name);
    }

    /**
     * Set the name.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function description(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return __($this->description);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a new policy meta.
     *
     * @param  string  $id
     * @param  string  $ability
     * @param  string  $method
     *
     * @return $this
     */
    public static function make($id, $ability, $method)
    {
        return new static($id, $ability, $method);
    }

    /**
     * Convert to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ability'     => $this->ability(),
            'method'      => $this->method(),
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }
}
