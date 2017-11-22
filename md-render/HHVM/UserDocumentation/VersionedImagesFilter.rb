require 'json'

module HHVM
  module UserDocumentation
    class VersionedImagesFilter < HTML::Pipeline::Filter
      STATIC_RESOURCES = JSON.parse(File.read(File.dirname(__FILE__)+'/../../../build/final/static_resources.json'))
      def call
        doc.search('img').each do |node|
          path = node[:src]
          versioned = self.versioned_path(path)

          node[:src] = versioned
        end
        doc
      end

      def versioned_path path
        if STATIC_RESOURCES.has_key? path
          info = STATIC_RESOURCES[path]
          return '/s/%s%s' % [info['checksum'], path]
        end
        return path
      end
    end
  end
end
