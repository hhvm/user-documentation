<?hh // strict

use HHVM\UserDocumentation\UIGlyphIcon;

final class :search-bar extends :x:element {
  attribute
    string class,
    string placeholder = 'Search';

  protected function render(): XHPRoot {
    $class =
      ($this->:class !== null) ? "searchBar ".$this->:class : "searchBar";
    return
      <div class={$class}>
        <form method="get" action="/search">
          <input
            class="searchInput"
            name="term"
            type="search"
            required={true}
          />
          <div class="inputLabel">
            <ui:glyph icon={UIGlyphIcon::SEARCH} />
            <label class="searchPlaceholder">{$this->:placeholder}</label>
          </div>
        </form>
      </div>;
  }
}
