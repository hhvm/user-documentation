require 'yaml'
require 'html/pipeline'

module HHVM
  module UserDocumentation
    class YAMLFrontMatterFilter < HTML::Pipeline::Filter
      def call
        doc.search('pre').each do |node|
          if node['lang'] != 'yamlmeta'
            next
          end
          data = YAML.load(node.text)

          if data['lib']
            node.add_previous_sibling(%Q{
              <div class="apiTopMessage apiFromLib">
                This API is part of
                <a href="https://github.com/#{data['lib']['github']}/"
                  >#{data['lib']['name']}</a>, not HHVM itself.
              </div>
            })
          end

          if data['fbonly messages']
            html = ''
            data['fbonly messages'].each do |message|
              html += HTML::Pipeline::MarkdownFilter.new(message).call().to_s
            end
            node.add_previous_sibling(%Q{
              <div class="apiTopMessage fbOnly">
                <strong>Facebook Engineer?</strong>
                #{html}
                <!--
                  Not a Facebook engineer... yet?
                  https://www.facebook.com/careers/
                -->
              </div>
            })
          end

          node.remove
        end
        doc
      end
    end
  end
end
