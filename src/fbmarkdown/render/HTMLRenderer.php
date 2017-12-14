<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\Markdown;

use namespace HH\Lib\{C, Str, Vec};

// TODO: fix namespace support in XHP, use that :'(
class HTMLRenderer extends Renderer<string> {
  const keyset<classname<RenderFilter>> EXTENSIONS = keyset[
    TagFilterExtension::class,
  ];

  protected static function escapeContent(string $text): string {
    return _Private\plain_text_to_html($text);
  }

  protected static function escapeAttribute(string $text): string {
    return _Private\plain_text_to_html_attribute($text);
  }

  // This is the list from the reference implementation
  const keyset<string> URI_SAFE = keyset[
    '-', '_', '.', '+', '!', '*', "'", '(', ')', ';', ':', '%', '#', '@', '?',
    '=', ';', ':', '/', ',', '+', '&', '$',
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
    'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
    'u', 'v', 'w', 'x', 'y', 'z',
    '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
  ];

  protected static function escapeURIAttribute(string $text): string {
    // While the spec states that no particular method is required, we attempt
    // to match cmark's behavior so that we can run the spec test suite.
    $text = \html_entity_decode(
      $text,
      /* HH_FIXME[4106] */ /* HH_FIXME[2049] */ \ENT_HTML5,
      'UTF-8',
    );

    $out = '';
    $len = Str\length($text);
    for ($i = 0; $i < $len; ++$i) {
      $char = $text[$i];
      if (C\contains_key(self::URI_SAFE, $char)) {
        $out .= $char;
        continue;
      }
      $out .= \urlencode($char);
    }
    $text = $out;

    return self::escapeAttribute($text);
  }

  <<__Override>>
  protected function renderNodes(vec<ASTNode> $nodes): string {
    return $nodes
      |> Vec\map($$, $node ==> $this->render($node))
      |> Vec\filter($$, $line ==> $line !== '')
      |> Str\join($$, '');
  }

  <<__Override>>
  protected function renderResolvedNode(ASTNode $node): string {
    if ($node instanceof RenderableAsHTML) {
      return $node->renderAsHTML($this->getContext(), $this);
    }
    return parent::renderResolvedNode($node);
  }

  <<__Override>>
  protected function renderBlankLine(): string {
    return '';
  }

  <<__Override>>
  protected function renderBlockQuote(Blocks\BlockQuote $node): string {
    return $node->getChildren()
      |> $this->renderNodes($$)
      |> "<blockquote>\n".$$."</blockquote>\n";
  }

  <<__Override>>
  protected function renderCodeBlock(Blocks\CodeBlock $node): string {
    $extra = '';
    $info = $node->getInfoString();
    if ($info !== null) {
      $first = C\firstx(Str\split($info, ' '));
      $extra = ' class="language-'.self::escapeAttribute($first).'"';
    }
    $code = $node->getCode();
    if ($code !== '') {
      $code = self::escapeContent($code)."\n";
    }
    return'<pre><code'.$extra.'>'.$code."</code></pre>\n";
  }

  <<__Override>>
  protected function renderHeading(Blocks\Heading $node): string {
    $level = $node->getLevel();
    return $node->getHeading()
      |> $this->renderNodes($$)
      |> sprintf("<h%d>%s</h%d>\n", $level, $$, $level);
  }

  <<__Override>>
  protected function renderHTMLBlock(Blocks\HTMLBlock $node): string {
    return $node->getCode()."\n";
  }

  <<__Override>>
  protected function renderLinkReferenceDefinition(
    Blocks\LinkReferenceDefinition $def,
  ): string {
    return '';
  }

  protected function renderTaskListItemExtension(
    Blocks\ListOfItems $list,
    Blocks\TaskListItemExtension $item,
  ): string {
    $checked = $item->isChecked() ? ' checked=""' : '';
    $checkbox = '<input'.$checked.' disabled="" type="checkbox"> ';

    $children = $item->getChildren();
    $first = C\first($children);
    if ($first instanceof Blocks\Paragraph) {
      $children[0] = new Blocks\Paragraph(
        Vec\concat(
          vec[new Inlines\RawHTML($checkbox)],
          $first->getContents(),
        )
      );
    } else {
      $children = Vec\concat(
        vec[new Blocks\HTMLBlock($checkbox)],
        $children,
      );
    }

    return $this->renderListItem(
      $list,
      new Blocks\ListItem(
        $item->getNumber(),
        $children,
      ),
    );
  }

  protected function renderListItem(
    Blocks\ListOfItems $list,
    Blocks\ListItem $item,
  ): string {
    if ($item instanceof Blocks\TaskListItemExtension) {
      return $this->renderTaskListItemExtension($list, $item);
    }

    $children = $item->getChildren();
    if (C\is_empty($children)) {
      return "<li></li>\n";
    }

    $content = '';

    if ($list->isTight()) {
      if (!C\first($children) instanceof Blocks\Paragraph) {
        $content .= "\n";
      }

      $content .= $children
        |> Vec\map(
          $$,
          $child ==> {
            if ($child instanceof Blocks\Paragraph) {
              return $this->renderNodes($child->getContents());
            }
            if ($child instanceof Blocks\Block) {
              return Str\trim($this->render($child));
            }
            return $this->render($child);
          },
        )
        |> Str\join($$, "\n");
      if (!C\last($children) instanceof Blocks\Paragraph) {
        $content .= "\n";
      }
    } else {
      $content = "\n".$this->renderNodes($children);
    }

    return '<li>'.$content."</li>\n";
  }

  <<__Override>>
  protected function renderListOfItems(Blocks\ListOfItems $node): string {
    $start = $node->getFirstNumber();
    if ($start === null) {
      $start = '<ul>';
      $end = '</ul>';
    } else if ($start === 1) {
      $start ='<ol>';
      $end = '</ol>';
    } else {
      $start = sprintf('<ol start="%d">', $start);
      $end = '</ol>';
    }
    return $node->getItems()
      |> Vec\map($$, $item ==> $this->renderListItem($node, $item))
      |> Str\join($$, '')
      |> $start."\n".$$.$end."\n";
  }

  <<__Override>>
  protected function renderParagraph(Blocks\Paragraph $node): string {
    return '<p>'.$this->renderNodes($node->getContents())."</p>\n";
  }

  <<__Override>>
  protected function renderTableExtension(Blocks\TableExtension $node): string {
    $html = "<table>\n".$this->renderTableHeader($node);

    $data = $node->getData();
    if (C\is_empty($data)) {
      return $html."</table>\n";
    }
    $html .= "\n<tbody>";

    $row_idx = -1;
    foreach ($data as $row) {
      ++$row_idx;
      $html .= "\n".$this->renderTableDataRow($node, $row_idx, $row);
    }
    return $html."</tbody></table>\n";
  }

  protected function renderTableHeader(Blocks\TableExtension $node): string {
    $html = "<thead>\n<tr>\n";

    $alignments = $node->getColumnAlignments();
    $header = $node->getHeader();
    for ($i = 0; $i < C\count($header); ++$i) {
      $cell = $header[$i];
      $alignment = $alignments[$i];
      if ($alignment !== null) {
        $alignment = ' align="'.$alignment.'"';
      }
      $html .=
        '<th'.$alignment.'>'.
        $this->renderNodes($cell).
        "</th>\n";
    }
    $html .= "</tr>\n</thead>";
    return $html;
  }

  protected function renderTableDataRow(
    Blocks\TableExtension $table,
    int $row_idx,
    Blocks\TableExtension::TRow $row,
  ): string {
    $html = "<tr>";
    for ($i = 0; $i < C\count($row); ++$i) {
      $cell = $row[$i];

      $html .= "\n".$this->renderTableDataCell($table, $row_idx, $i, $cell);
    }
    $html .= "\n</tr>";
    return $html;
  }

  protected function renderTableDataCell(
    Blocks\TableExtension $table,
    int $row_idx,
    int $col_idx,
    Blocks\TableExtension::TCell $cell,
  ): string {
    $alignment = $table->getColumnAlignments()[$col_idx];
    if ($alignment !== null) {
      $alignment = ' align="'.$alignment.'"';
    }
    return
      "<td".$alignment.'>'.
      $this->renderNodes($cell).
      "</td>";
  }

  <<__Override>>
  protected function renderThematicBreak(): string {
    return "<hr />\n";
  }

  <<__Override>>
  protected function renderAutoLink(Inlines\AutoLink $node): string {
    $href = self::escapeURIAttribute($node->getDestination());
    $text = self::escapeContent($node->getText());
    return '<a href="'.$href.'">'.$text.'</a>';
  }

  <<__Override>>
  protected function renderInlineWithPlainTextContent(Inlines\InlineWithPlainTextContent $node): string {
    return self::escapeContent($node->getContent());
  }

  <<__Override>>
  protected function renderCodeSpan(Inlines\CodeSpan $node): string {
    return '<code>'.self::escapeContent($node->getCode()).'</code>';
  }

  <<__Override>>
  protected function renderEmphasis(Inlines\Emphasis $node): string {
    $tag = $node->isStrong() ? 'strong' : 'em';
    return $node->getContent()
      |> Vec\map($$, $item ==> $this->render($item))
      |> Str\join($$, '')
      |> '<'.$tag.'>'.$$.'</'.$tag.'>';
  }

  <<__Override>>
  protected function renderHardLineBreak(): string {
    return "<br />\n";
  }

  <<__Override>>
  protected function renderImage(Inlines\Image $node): string {
    $title = $node->getTitle();
    if ($title !== null) {
      $title = ' title="'.self::escapeAttribute($title).'"';
    }
    $src = self::escapeURIAttribute($node->getSource());
    $text = $node->getDescription()
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
    // Needs to always be present for spec tests to pass
    $alt = ' alt="'.self::escapeAttribute($text).'"';
    return '<img src="'.$src.'"'.$alt.$title.' />';
  }

  <<__Override>>
  protected function renderLink(Inlines\Link $node): string {
    $title = $node->getTitle();
    if ($title !== null) {
      $title = ' title="'.self::escapeAttribute($title).'"';
    }
    $href = self::escapeURIAttribute($node->getDestination());
    $text = $node->getText()
      |> Vec\map($$, $child ==> $this->render($child))
      |> Str\join($$, '');
    return '<a href="'.$href.'"'.$title.'>'.$text.'</a>';
  }

  <<__Override>>
  protected function renderRawHTML(Inlines\RawHTML $node): string {
    return $node->getContent();
  }

  <<__Override>>
  protected function renderSoftLineBreak(): string {
    return "\n";
  }

  <<__Override>>
  protected function renderStrikethroughExtension(Inlines\StrikethroughExtension $node): string {
    $children = $node->getChildren()
      |> Vec\map($$, $child ==> $this->render($child))
      |> Str\join($$, '');
    return '<del>'.$children.'</del>';
  }
}
