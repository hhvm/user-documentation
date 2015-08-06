<?hh

// So we can use asio-utilities function vm()
require "../../../vendor/autoload.php";

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
      await HH\Asio\v(array(
        fetch_post_data($post_id),
        fetch_comment_count($post_id),
      ));
    return tuple($post_data, $comment_count);
  };

  // Transform the array of post IDs into an array of results,
  // using the vm() function from asio-utilities
  return await HH\Asio\vm($all_post_ids, $post_fetcher);
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

$page = HH\Asio\join(generate_page(13324)); // just made up a user id
var_dump($page);
