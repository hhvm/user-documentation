<?hh // strict

use HHVM\UserDocumentation\NavDataNode;

class :ui:navbar extends :x:element {
  attribute
    array<string, NavDataNode> data @required,
    array<string> activePath @required,
    string extraNavListClass;

  protected function render(): XHPRoot {
    $nav_args = [
      'data' => $this->:data,
      'activePath' => $this->:activePath,
      'extraNavListClass' => $this->:extraNavListClass ?? '',
    ];

    return (
      <div class="navWrapper guideNav">
        <div class="navLoader" />
        <static:script path="/js/UnifiedSideNav.js" />
        <script>
          var navLoader = document.getElementsByClassName('navLoader')[0];
          ReactDOM.render(
            React.createElement(DocNav, {json_encode($nav_args)}),
            navLoader
          );
        </script>
      </div>
    );
  }
}
