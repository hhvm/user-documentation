require 'colorize'

module HHVM
  module UserDocumentation
    class IncludeExamplesFilter < HTML::Pipeline::Filter
      def call
        base = File.dirname(context[:file])
        doc.search('p').each do |node|
          contents = node.inner_text.strip
          if match_data = /^@@ (?<relative_path>[^ ]+\.php(?:.type-errors)?) @@$/.match(contents)
            relative_path = match_data['relative_path']
            full_path = File.expand_path(relative_path, base)

            if ! File.exists? full_path
              text = "Missing example: #{full_path}"
              STDERR.write(
                text.red.bold + "\n"
              )
              warning = doc.document.create_element(
                'h1',
                text,
                style: 'color: red',
              )
              node.replace(warning)
              next
            end

            code = doc.document.create_element(
              'pre',
              File.read(full_path),
              language: 'Hack',
            );
            node.replace(code)
          end
        end
        doc
      end
    end
  end
end
