<?php

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

use PhpOption\None;
use PhpOption\Some;

final class ServerConstAdapter implements AdapterInterface
{
    /**
     * Create a new server const adapter instance.
     *
     * @return void
     */
    private function __construct()
    {
        //
    }

    /**
     * Create a new instance of the adapter, if it is available.
     *
     * @return \PhpOption\Option<\Dotenv\Repository\Adapter\AdapterInterface>
     */
    public static function create()
    {
        /** @var \PhpOption\Option<AdapterInterface> */
        return Some::create(new self());
    }

    /**
     * Get an environment variable, if it exists.
     *
     * @param string $name
     *
     * @return \PhpOption\Option<string|null>
     */
    public function get(string $name)
    {
        if (array_key_exists($name, $_SERVER)) {
            return Some::create($_SERVER[$name]);
        }

        return None::create();
    }

    /**
     * Set an environment variable.
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return void
     */
    public function set(string $name, string $value = null)
    {
        $_SERVER[$name] = $value;
    }

    /**
     * Clear an environment variable.
     *
     * @param string $name
     *
     * @return void
     */
    public function clear(string $name)
    {
        unset($_SERVER[$name]);
    }
}