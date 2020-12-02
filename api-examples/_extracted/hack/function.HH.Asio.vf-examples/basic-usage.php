<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioVf\BasicUsage;

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  $times = ImmVector {
    100000000, // Sat, 03 Mar 1973 09:46:40
    200000000, // Mon, 03 May 1976 19:33:20
    300000000, // Thu, 05 Jul 1979 05:20:00
    400000000, // Sat, 04 Sep 1982 15:06:40
    500000000, // Tue, 05 Nov 1985 00:53:20
    600000000, // Thu, 05 Jan 1989 10:40:00
    700000000, // Sat, 07 Mar 1992 20:26:40
    800000000, // Tue, 09 May 1995 06:13:20
    900000000, // Thu, 09 Jul 1998 16:00:00
    1000000000, // Sun, 09 Sep 2001 01:46:40
  };

  // Similar to $times->filter(...)
  // But awaits the awaitable result of the callback
  // rather than using it directly
  $saturdays =
    await \HH\Asio\vf($times, async ($time) ==> (\gmdate('w', $time) == 6));

  foreach ($saturdays as $time) {
    echo \gmdate('r', $time), "\n";
  }
}
