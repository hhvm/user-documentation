require 'json'

module HHVM
  module UserDocumentation
    class AutoLinkifyAPIFilter < HTML::Pipeline::Filter
      DEFINITIONS = JSON.parse(File.read(File.dirname(__FILE__)+'/../../../build/unified-index.json'))
      def call
        doc.search('p code, li code').each do |node|
          content = node.inner_text

          if content =~ /\(\)$/ then
            content = content[/^[^(]+/]
          end

          url = DEFINITIONS[content]
          next if url.nil?

          link = Nokogiri::XML::Node.new 'a', doc
          link[:class] = 'autoAPILink'
          link[:href] = url
          node.replace link

          node.parent = link
        end
        doc
      end
    end
  end
end
