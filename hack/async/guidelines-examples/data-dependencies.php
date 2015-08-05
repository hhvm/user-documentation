<?hh

async function fetch_all_post_ids_for_author(int $author_id)
  : Awaitable<array<int>> {

  // Query database, etc.
}

async function fetch_post_data(int $post_id): Awaitable<PostData> {
  // Query database, etc.
}

async function fetch_comment_count(int $post_id): Awaitable<int> {
  // Query database, etc.
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
  foreach ($tuples as $tuple) {
    list($post_data, $comment_count) = $tuple;
    // Render the data into HTML
  }
}

HH\Asio\join(generate_page(13324));
