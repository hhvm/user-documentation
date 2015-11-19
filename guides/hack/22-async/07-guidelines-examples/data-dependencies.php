<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\DataDependencies;

// So we can use asio-utilities function vm()
require __DIR__ . "/../../../../vendor/autoload.php";

class PostData {
  // using constructor argument promotion
  public function __construct(public string $text) {}
}

async function fetch_all_post_ids_for_author(int $author_id)
  : Awaitable<array<int>> {

  // Query database, etc., but for now, just return made up stuff
  return array(4, 53, 99);
}

async function fetch_post_data(int $post_id): Awaitable<PostData> {
  // Query database, etc. but for now, return something random
  return new PostData(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"));
}

async function fetch_comment_count(int $post_id): Awaitable<int> {
  // Query database, etc., but for now, return something random
  return rand(0, 50);
}

async function fetch_page_data(int $author_id)
  : Awaitable<Vector<(PostData, int)>> {

  $all_post_ids = await fetch_all_post_ids_for_author($author_id);
  // An async closure that will turn a post ID into a tuple of
  // post data and comment count
  $post_fetcher = async function(int $post_id): Awaitable<(PostData, int)> {
    list($post_data, $comment_count) =
      await \HH\Asio\v(array(
        fetch_post_data($post_id),
        fetch_comment_count($post_id),
      ));
    /* The problem is that v takes Traverable<Awaitable<T>> and returns
     * Awaitable<Vector<T>>, but there isn't a good value of T that represents
     * both ints and PostData, so they're currently almost a union type.
     *
     * Now we need to tell the typechecker what's going on.
     * In the future, we plan to add HH\Asio\va() - VarArgs - to support this.
     * This will have a type signature that varies depending on the number of
     * arguments, for example:
     *
     *  - va(Awaitable<T1>, Awaitable<T2>): Awaitable<(T1, T2)>
     *  - va(Awaitable<T1>,
     *       Awaitable<T2>,
     *       Awaitable<T3>): Awaitable<(T1, T2, T3)>
     *
     * And so on, with no need for T1, T2, ... Tn to be related types.
     */
    invariant($post_data instanceof PostData, "This is good");
    invariant(is_int($comment_count), "This is good");
    return tuple($post_data, $comment_count);
  };

  // Transform the array of post IDs into an array of results,
  // using the vm() function from asio-utilities
  return await \HH\Asio\vm($all_post_ids, $post_fetcher);
}

async function generate_page(int $author_id): Awaitable<string> {
  $tuples = await fetch_page_data($author_id);
  $page = "";
  foreach ($tuples as $tuple) {
    list($post_data, $comment_count) = $tuple;
    // Normally render the data into HTML, but for now, just create a
    // normal string
    $page .= $post_data->text . " " . $comment_count . PHP_EOL;
  }
  return $page;
}

$page = \HH\Asio\join(generate_page(13324)); // just made up a user id
var_dump($page);
