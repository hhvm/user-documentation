require 'json'

module HHVM
  module UserDocumentation
    class AutoLinkifyAPIFilter < HTML::Pipeline::Filter
      DEFINITIONS = JSON.parse(File.read(File.dirname(__FILE__)+'/../../../build/final/unified-index.json'))
      CLASS_REGEXP = /^(?<type>class|interface|trait)\.(?<name>[^.]+)/
      def call
        doc.search('p code, li code, td code').each do |node|
          content = node.inner_text

          # Keep code null; Otherwise we would go to HH\Asio\null
          # This will still allow null() and HH\Asio\null() to be linked
          if content == 'null'
            next
          end

          # remove parens e.g., Set::map() or HH\Asio\curl_exec($hello)
          # , for e.g., multiple params, tuples and <x, y>
          # = for default parameters
          if content =~ /\([A-Za-z0-9_?=, \(\)\<\>\$]*\)$/ then
            content = content[/^[^(]+/]
          end

          # remove type parameters e.g. ConstSet<Tm> or ConstSet<ConstSet<Tm>>
          # comma for e.g., tuples and <x, y>
          if content =~ /\<[A-Za-z0-9_?, \(\)\<\>\$]*\>$/ then
            content = content[/^[^<]+/]
          end

          url = DEFINITIONS[content]
          if url.nil?
            # try appending an HH namespace
            url = DEFINITIONS['HH\\' + content.to_s] # to_s in case content nil
          end
          if url.nil?
            url = DEFINITIONS['HH\\Lib\\' + content.to_s]
          end
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
