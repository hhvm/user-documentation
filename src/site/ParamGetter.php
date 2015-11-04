<?hh

// a wrapper around the 'unstrict' $_GET and $_POST vars
final class ParamGetter {
    private static array<string, string> $get = [];
    private static array<string, string> $post = [];

    private static bool $getSet = false;
    private static bool $postSet = false;

    public static function getGet($key): string {
        if (!static::$getSet) {
            static::setGetVars();
        }

        if (isset(static::$get[$key])) {
            return static::$get[$key];
        } else {
            return "";
        }
    }

    public static function getPost($key): string {
        if (!static::$postSet) {
            static::setPostVars();
        }

        if (isset(static::$post[$key])) {
            return static::$post[$key];
        } else {
            return "";
        }
    }

    private static function setGetVars() {
        static::$get = $_GET;
    }

    private static function setPostVars() {
        static::$post = $_POST;
    }
}
