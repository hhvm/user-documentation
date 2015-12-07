module HHVM
  module UserDocumentation
    # -<p>Foo<br />
    # -bar</p>
    # +<p>Foo bar</p>
    class IgnoreNewlinesFilter< HTML::Pipeline::Filter
      def call
        doc.search('p br').each do |node|
          next_node = node.next
          next unless next_node && next_node.text?
          text = next_node.to_s
          if text[0] == "\n" then
            node.remove
          end
        end
        doc
      end
    end
  end
end
