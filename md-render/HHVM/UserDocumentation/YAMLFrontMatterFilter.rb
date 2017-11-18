require 'yaml'

module HHVM
  module UserDocumentation
    class YAMLFrontMatterFilter < HTML::Pipeline::HtmlFilter
      def call
        doc.search('pre').each do |node|
          if node['lang'] != 'yamlmeta'
            next
          end
          data = YAML.load(node.text)

          if data['lib']
            node.add_previous_sibling(%Q{
              <div class="apiFromLib">
                This library is part of the
                <span class="apiLibName">#{data['lib']}</span>
                library, not HHVM itself.
              </div>
            })
          end

          if data['fbonly messages']
            data['fbonly messages'].each do |message|
              node.add_previous_sibling(%Q{
                <div class="fbonly">#{message}</div>
              })
            end
          end

          node.remove
        end

      end
    end
  end
end
