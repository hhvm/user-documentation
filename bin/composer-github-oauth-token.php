<?hh

// The deploy process can use this to get higher rate limits
function dump_composer_github_oauth_token(): void {
  $config = getenv('HOME').'/.composer/auth.json';
  if (!file_exists($config)) {
    return;
  }
  $auth = json_decode(
    file_get_contents($config),
    /* as array = */ true,
  );
  $token = @$auth['github-oauth']['github.com'];
  if (is_string($token)) {
    print $token."\n";
  }
}

dump_composer_github_oauth_token();
