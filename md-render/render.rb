#!/usr/bin/env ruby

require 'bundler/setup'
require 'html/pipeline'

require_relative 'HHVM/UserDocumentation/SyntaxHighlightFilter.rb'
require_relative 'HHVM/UserDocumentation/IncludeExamplesFilter.rb'
require_relative 'HHVM/UserDocumentation/InternalLinksFilter.rb'
require_relative 'HHVM/UserDocumentation/HeadingAnchorsFilter.rb'
require_relative 'HHVM/UserDocumentation/ResponsiveTablesFilter.rb'
require_relative 'HHVM/UserDocumentation/VersionedImagesFilter.rb'

pipeline = HTML::Pipeline.new(
  [
    HTML::Pipeline::MarkdownFilter,
    HHVM::UserDocumentation::IncludeExamplesFilter,
    HHVM::UserDocumentation::SyntaxHighlightFilter,
    HHVM::UserDocumentation::InternalLinksFilter,
    HHVM::UserDocumentation::HeadingAnchorsFilter,
    HHVM::UserDocumentation::ResponsiveTablesFilter,
    HHVM::UserDocumentation::VersionedImagesFilter,
  ],
)

STDOUT.sync = true
STDIN.each_line do |line|
  in_file, out_file = line.strip.split ' -> '
  out_text = pipeline.call(
    File.read(in_file),
    { file: in_file },
  )[:output].to_s

  File.open(out_file, 'w+') { |f| f.write out_text }
  puts 'OK] '+line
end
