require 'uri'

module HHVM
  module UserDocumentation
    # Internal links end in .md - remove the .md
    class InternalLinksFilter < HTML::Pipeline::Filter
      PATTERN = /\.md(#|$)/

      def call
        doc.search('a').each do |node|
          href = node[:href]
          next unless URI(href).host.nil?
          if PATTERN.match href then
            node[:href] = href.sub PATTERN, '\1'
          end
        end
        doc
      end
    end
  end
end
