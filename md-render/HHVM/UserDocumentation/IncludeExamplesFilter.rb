require 'colorize'

module HHVM
  module UserDocumentation
    class IncludeExamplesFilter < HTML::Pipeline::Filter
      def remove_boilerplate code
        return code.gsub(%r<^require(_once)?[^\n]+;\n\n>, '')
      end

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
              :class => "warning",
            )
            node.replace(warning)
            next
          end

          content = File.read(full_path)
          content = self.remove_boilerplate(content)

          code = doc.document.create_element(
            'pre',
            content,
            language: 'Hack',
          );
          code_node = node.replace(code)
          # If the stopper file exists, we don't give the output. Use
          # case was in the Hack getting started guide where we were doing
          # a step by step tutorial of how to write and run code.
          if not (File.exists? (full_path + ".no.auto.output"))
            # If the example has HHVM output associated with it, then print it
            # after the code example. However, if both a .example.hhvm.out and
            # .hhvm.expect exist, that is an error
            output_header = doc.document.create_element(
              'em',
              "Output",
            );
            if (File.exists? (full_path + ".hhvm.expect")) ^ (File.exists? (full_path + ".example.hhvm.out"))
              if File.exists? (full_path + ".hhvm.expect")
                output_path = full_path + ".hhvm.expect"
              else
                output_path = full_path + ".example.hhvm.out"
              end
              output = doc.document.create_element(
                'pre',
                File.read(output_path),
                language: 'Text',
              );
              code_node.after(output).after(output_header)
            elsif (File.exists? (full_path + ".hhvm.expect")) && (File.exists? (full_path + ".example.hhvm.out"))
              text = "Both .hhvm.expect and .example.hhvm.out exist. Remove one: #{full_path}"
              STDERR.write(
                text.red.bold + "\n"
              )
              warning = doc.document.create_element(
                'h1',
                text,
                :class => "warning",
              )
              code_node.after(warning).after(output_header)
            elsif File.exists? (full_path + ".hhconfig") # We have some include .php files that we don't want output for. Files that are test run have a .hhconfig
              text = "Neither .hhvm.expect or .example.hhvm.out exist. Add one or a .no.auto.output file: #{full_path}"
              STDERR.write(
                text.red.bold + "\n"
              )
              warning = doc.document.create_element(
                'h1',
                text,
                :class => "warning",
              )
              code_node.after(warning).after(output_header)
            end
          end
        end
        doc
      end
    end
  end
end
