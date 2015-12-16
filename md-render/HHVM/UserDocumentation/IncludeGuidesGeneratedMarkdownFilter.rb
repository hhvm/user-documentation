require 'colorize'

# This is not a HTML::Pipeline style filter. We want to deal with raw strings
# instead of NokoGiri Document Fragments, etc. So this is a standalone filter
# that does not require any HTML::Pipeline functionality. We go line by line
# in the text string and look for markers representing generated markdown.
# e.g., we have generated markdown for the HHVM supported PHP INI settings
# table
module HHVM
  module UserDocumentation
    class IncludeGuidesGeneratedMarkdownFilter

      def call(in_text, filename)

        out_text = in_text # assume they will be the same

        # Symlink to build/guides-generated-markdown
        guides_generated_md_dir = 'guides-generated-markdown'
        match = /(?<source_dir>.+)/.match(guides_generated_md_dir)

        if ! match.nil?
          gen_md_dir = match['source_dir']
          base = File.expand_path(guides_generated_md_dir, File.dirname(filename))
          out_text = ''
          in_text.each_line do |line|
            full_path = nil
            if match = %r,^@@ (?<dir_name>[^/ ]+)/(?<file_name>[^/ ]+\.md) @@$,.match(line)
              if match[:dir_name] === gen_md_dir
                full_path = File.expand_path(match[:file_name], base)
              end
            elsif match = %r,^@@ (?<absolute_path>/[^@ ]+\.md) @@$,.match(line)
                full_path = match[:absolute_path]
            end

            if full_path.nil?
              out_text << line
            else
              if ! File.exists? full_path
                text = "Missing generated guide: #{full_path}"
                STDERR.write(
                  text.red.bold + "\n"
                )
                out_text << '<h1 class="warning">' + text + '</h1>'
              else
                out_text << File.read(full_path)
              end
            end
          end
        end
        out_text
      end
    end
  end
end
