<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodConstruct\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  // For many use cases, calling MCRouter::createSimple($servers) would
  // suffice here. But this shows you how to explicitly create the configuration
  // options for creating an instance of MCRouter
  $options = darray[
    'config_str' => \json_encode(
      darray[
        'pools' => darray[
          'P' => darray[
            'servers' => $servers,
          ],
        ],
        'route' => 'PoolRoute|P',
      ],
    ),
  ];
  $mc = new \MCRouter($options); // could also pass a persistence id string here
  \var_dump($mc is \MCRouter);
}
