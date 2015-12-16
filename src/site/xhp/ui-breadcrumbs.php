<?hh // strict

final class :ui:breadcrumbs extends :x:element {
  attribute
    ConstMap<string, string> parents @required,
    string currentPage @required;

  public function render(): XHPRoot{
    $container = (
      <x:frag>
        <a href="/">Documentation</a>
      </x:frag>
    );
    foreach ($this->:parents as $name => $url) {
      $container->appendChild(
        <x:frag>
          <i class="breadcrumbSeparator" />
          <a href={$url}>{$name}</a>
        </x:frag>
      );
    }
    $container->appendChild(
      <x:frag>
        <i class="breadcrumbSeparator" />
        {$this->:currentPage}
      </x:frag>
    );
    return (
      <div class="breadcrumbNav">
        <div class="widthWrapper">
          {$container}
        </div>
      </div>
    );
  }
}
