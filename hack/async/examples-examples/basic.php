<?hh

// async specifies a function will return a wait handle. Awaitable<string> means
// that the wait handle will ultimately return a string when complete
async function trivial(): Awaitable<string> {
  return "Hello";
}

async function call_trivial(): Awaitable<void> {
  // These first two lines could be combined into
  //     $result = await trivial();
  // but wanted to show the process

  // get wait handle that you can wait for completion
  $wait_handle = trivial();
  // wait for the operation to complete and get the result
  $result = await $wait_handle;
  echo $result; // "Hello"
}

call_trivial();

