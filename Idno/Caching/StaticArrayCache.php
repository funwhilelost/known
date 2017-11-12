<?php

namespace Idno\Caching {

    /**
     * A version of MemoryCache which uses a shared array, this means it's safe to use "$foo = new MemoryCache()" and still have access
     * to values set elsewhere in the system.
     */
    class StaticArrayCache extends MemoryCache {

        private static $staticCache = [];

        public function delete($key) {
            unset(self::$staticCache[$key]);

            return true;
        }

        public function load($key) {

            if (isset(self::$staticCache[$key])) {
                return self::$staticCache[$key];
            }

            return false;
        }

        public function size() {
            return count(self::$staticCache);
        }

        public function store($key, $value) {

            self::$staticCache[$key] = $value;

            return true;
        }

    }

}
