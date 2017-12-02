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

namespace Facebook\GFM;

use namespace HH\Lib\{C, Str, Vec};
use function Facebook\GFM\_Private\plain_text_to_html;
use function Facebook\GFM\_Private\plain_text_to_html_attribute;

// TODO: fix namespace support in XHP, use that :'(
function render_html(RenderContext $ctx, ASTNode $node): string {
  $nodes = $ctx->transformNode($node);
  $count = C\count($nodes);
  if ($count === 0) {
    return '';
  }
  if ($count > 1) {
    return $nodes
      |> Vec\map($$, $node ==> render_html($ctx, $node))
      |> Str\join($$, '');
  }
  $node = C\firstx($nodes);

  if ($node instanceof Blocks\BlankLine) {
    return "\n";
  }

  if ($node instanceof Blocks\BlockQuote) {
    return $node->getChildren()
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, '')
      |> '<blockquote>'.$$.'</blockquote>';
  }

  if ($node instanceof Blocks\Document) {
    return $node->getChildren()
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, '');
  }

  // Blocks\FencedCodeBlock
  // Blocks\IndentedCodeBlock
  if ($node instanceof Blocks\CodeBlock) {
    $extra = '';
    $info = $node->getInfoString();
    if ($info !== null) {
      $first = C\firstx(Str\split($info, ' '));
      $extra = ' class="language-'.plain_text_to_html_attribute($first).'"';
    }
    return plain_text_to_html($node->getCode())
      |> '<pre><code'.$extra.'>'.$$."\n</code></pre>";
  }

  if ($node instanceof Blocks\Heading) {
    $level = $node->getLevel();
    return $node->getHeading()
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, '')
      |> sprintf("<h%d>%s</h%d>", $level, $$, $level);
  }

  if ($node instanceof Blocks\HTMLBlock) {
    return $node->getCode();
  }

  if ($node instanceof Blocks\LinkReferenceDefinition) {
    return '';
  }

  if ($node instanceof Blocks\ListItem) {
    $children = $node->getChildren();
    $child = C\first($children);
    if (C\count($children) === 1 && $child instanceof Blocks\Paragraph) {
      $children = $child->getContents();
    }
    return $children
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, "\n")
      |> '<li>'.$$.'</li>';
  }

  if ($node instanceof Blocks\ListOfItems) {
    $start = $node->getFirstNumber();
    if ($start === null) {
      $start = '<ul>';
      $end = '</ul>';
    } else {
      $start = sprintf('<ol start="%d">', $start);
      $end = '</ol>';
    }
    return $node->getItems()
      |> Vec\map($$, $item ==> render_html($ctx, $item))
      |> Str\join($$, "\n")
      |> $start."\n".$$."\n".$end."\n";
  }

  if ($node instanceof Blocks\Paragraph) {
    return $node->getContents()
      |> Vec\map($$, $item ==> render_html($ctx, $item))
      |> Str\join($$, '')
      |> '<p>'.$$."</p>\n";
  }

  if ($node instanceof Blocks\ThematicBreak) {
    return "<hr />\n";
  }

  if ($node instanceof Inlines\AutoLink) {
    $href = plain_text_to_html_attribute($node->getDestination());
    $text = plain_text_to_html($node->getText());
    return '<a href="'.$href.'">'.$text.'</a>';
  }

  // Inlines\BackslashEscape
  // Inlines\DisallowedRawHTML
  // Inlines\EntityReference
  // Inlines\TextualContent
  if ($node instanceof Inlines\InlineWithPlainTextContent) {
    return plain_text_to_html($node->getContent());
  }

  if ($node instanceof Inlines\CodeSpan) {
    return '<code>'.plain_text_to_html($node->getCode()).'</code>';
  }

  if ($node instanceof Inlines\Emphasis) {
    $tag = $node->isStrong() ? 'strong' : 'em';
    return $node->getContent()
      |> Vec\map($$, $item ==> render_html($ctx, $item))
      |> Str\join($$, '')
      |> '<'.$tag.'>'.$$.'</'.$tag.'>';
  }

  if ($node instanceof Inlines\HardLineBreak) {
    return "<br />\n";
  }

  if ($node instanceof Inlines\Image) {
    $title = $node->getTitle();
    if ($title !== null) {
      $title = ' title="'.plain_text_to_html_attribute($title).'"';
    }
    $src = plain_text_to_html_attribute($node->getSource());
    $text = $node->getDescription()
      |> Vec\map($$, $child ==> $child->getContentAsPlainText())
      |> Str\join($$, '');
    $alt = ($text === '')
      ? '' : ' alt="'.plain_text_to_html_attribute($text).'"';
    return '<img src="'.$src.'"'.$alt.$title.' />';
  }

  if ($node instanceof Inlines\Link) {
    $title = $node->getTitle();
    if ($title !== null) {
      $title = ' title="'.plain_text_to_html_attribute($title).'"';
    }
    $href = plain_text_to_html_attribute($node->getDestination());
    $text = $node->getText()
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, '');
    return '<a href="'.$href.'"'.$title.'>'.$text.'</a>';
  }

  if ($node instanceof Inlines\RawHTML) {
    return $node->getContent();
  }

  if ($node instanceof Inlines\SoftLineBreak) {
    return "\n";
  }

  if ($node instanceof Inlines\StrikethroughExtension) {
    $children = $node->getChildren()
      |> Vec\map($$, $child ==> render_html($ctx, $child))
      |> Str\join($$, '');
    return '<del>'.$children.'</del>';
  }

  invariant_violation(
    "Unhandled node type: %s",
    get_class($node),
  );
}
