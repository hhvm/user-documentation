require 'colorize'

module HHVM
  module UserDocumentation
    class IncludeExamplesFilter < HTML::Pipeline::Filter
      def call
        file = context[:file]

        # Actual directory is something like 01-foo-examples/ ...
        examples_dir = File.basename(file, '.md') + '-examples'
        # ... but to make reordering easier, the references to it in the
        # markdown skip the '01-' prefix.
        match = /^[0-9]+-(?<source_dir>.+)/.match(examples_dir)
        if match.nil?
          base = nil
          source_examples_dir = nil
        else
          source_examples_dir = match['source_dir']
          base = File.expand_path(examples_dir, File.dirname(file))
        end

        doc.search('p').each do |node|
          contents = node.inner_text.strip
          full_path = nil
          if match = %r,^@@ (?<dir_name>[^/ ]+)/(?<file_name>[^/ ]+\.php(?:.type-errors)?(?:.(hhvm|typechecker).expect[f]?)?) @@$,.match(contents)
            next if match[:dir_name] != source_examples_dir

            full_path = File.expand_path(match[:file_name], base)
          elsif match = %r,^@@ (?<absolute_path>/[^@ ]+\.php(?:.type-errors)?(?:.(hhvm|typechecker).expect[f]?)?) @@$,.match(contents)
            full_path = match[:absolute_path]
          end

          next if full_path.nil?

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
          code_node = node.replace(code)
          # If the example has HHVM output associated with it, then print it
          # after the code example
          if File.exists? (full_path + ".example.hhvm.out")
            output_header = doc.document.create_element(
              'em',
              "Output",
            );
            output = doc.document.create_element(
              'pre',
              File.read(full_path + ".example.hhvm.out"),
              language: 'Bash',
            );
            code_node.after(output).after(output_header)
          end
        end
        doc
      end
    end
  end
end
