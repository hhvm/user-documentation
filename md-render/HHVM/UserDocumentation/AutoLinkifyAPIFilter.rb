require 'json'

module HHVM
  module UserDocumentation
    class AutoLinkifyAPIFilter < HTML::Pipeline::Filter
      DEFINITIONS = JSON.parse(File.read(File.dirname(__FILE__)+'/../../../build/unified-index.json'))
      CLASS_REGEXP = /^(?<type>class|interface|trait)\.(?<name>[^.]+)/
      def call
        doc.search('p code, li code, td code').each do |node|
          content = node.inner_text

          if content =~ /\([A-Za-z0-9_\(\)\<\>\$]*\)$/ then
            content = content[/^[^(]+/]
          end

          url = DEFINITIONS[content]
          if url.nil?
            file = File.basename(context[:file])
            match = CLASS_REGEXP.match file
            if match
              klass = match[:name]
            end
            url = DEFINITIONS['%s::%s' % [klass, content]]
          end

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
