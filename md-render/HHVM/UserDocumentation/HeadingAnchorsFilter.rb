module HHVM
  module UserDocumentation
    # - <h1>Foo Bar</h1>
    # + <h1 id="foo-bar">Foo Bar</h1>
    class HeadingAnchorsFilter < HTML::Pipeline::Filter
      PARENTS = {
        'h1' => nil,
        'h2' => nil,
        'h3' => 'h2',
      }
      def call
        doc.search('h1', 'h2', 'h3').each do |node|
          id = node.text.strip
          # collapse whitespace
          id.gsub! /\s+/, ' '
          # only whitelisted chars
          id.gsub! /[^A-Za-z0-9_\.\- ]/, ''
          # normalize
          id.downcase!
          id.gsub! ' ', '-'

          # prefix with preceding higher-level heading id
          # to avoid duplicates - eg:
          # - <h2>Foo</h2><h3>Bar</h3>
          # + <h2 id="foo">Foo</h2><h3 id="foo__bar">Bar</h3>
          last = nil
          target = PARENTS[node.name]
          if (target) then
            node.parent.search(target).each do |sibling|
              break if sibling === node
              # ignore headings that appear after this node in the document
              # since they can't be a 'parent' of this heading
              break if sibling.line > node.line
              last = sibling[:id]
            end
          end
          if last then
            id = last+'__'+id
          end

          link = Nokogiri::XML::Node.new 'a', doc
          link[:href] = '#'+id
          glyph = Nokogiri::XML::Node.new 'i', doc
          glyph[:class] = 'glyphIcon fa fa-link'
          glyph.parent = link
          link.parent = node
          node[:class] = 'headingWithAnchor'

          # Set the ID
          node[:id] = id
        end
        doc
      end
    end
  end
end
