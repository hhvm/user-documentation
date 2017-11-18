#!/usr/bin/env ruby

require 'bundler/setup'
require 'html/pipeline'

require_relative 'HHVM/UserDocumentation/SyntaxHighlightFilter.rb'
require_relative 'HHVM/UserDocumentation/IncludeExamplesFilter.rb'
require_relative 'HHVM/UserDocumentation/IncludeGuidesGeneratedMarkdownFilter.rb'
require_relative 'HHVM/UserDocumentation/InternalLinksFilter.rb'
require_relative 'HHVM/UserDocumentation/HeadingAnchorsFilter.rb'
require_relative 'HHVM/UserDocumentation/ResponsiveTablesFilter.rb'
require_relative 'HHVM/UserDocumentation/VersionedImagesFilter.rb'
require_relative 'HHVM/UserDocumentation/IgnoreNewlinesFilter.rb'
require_relative 'HHVM/UserDocumentation/AutoLinkifyAPIFilter.rb'
require_relative 'HHVM/UserDocumentation/YAMLFrontMatterFilter.rb'

generatedMarkdownProcessor = HHVM::UserDocumentation::IncludeGuidesGeneratedMarkdownFilter.new

markdownPipeline = HTML::Pipeline.new(
  [
    HTML::Pipeline::MarkdownFilter,
    HHVM::UserDocumentation::IncludeExamplesFilter,
    HHVM::UserDocumentation::SyntaxHighlightFilter,
    HHVM::UserDocumentation::InternalLinksFilter,
    HHVM::UserDocumentation::HeadingAnchorsFilter,
    HHVM::UserDocumentation::ResponsiveTablesFilter,
    HHVM::UserDocumentation::VersionedImagesFilter,
    HHVM::UserDocumentation::IgnoreNewlinesFilter,
    HHVM::UserDocumentation::AutoLinkifyAPIFilter,
    HHVM::UserDocumentation::YAMLFrontMatterFilter,
  ],
)

STDOUT.sync = true
STDIN.each_line do |line|
  in_file, out_file = line.strip.split ' -> '
  in_text = File.read(in_file)
  out_text = generatedMarkdownProcessor.call(
    in_text, in_file
  )

  # If nothing happened in the preMarkdownFilter (etc. no generated markdown),
  # then what we write to out_file will be the same content as in_file.
  # out_file here is serving as an intermediary to the final out_file below
  File.open(out_file, 'w+') { |f| f.write out_text }

  out_text = markdownPipeline.call(
    File.read(out_file),
    { file: in_file },
  )[:output].to_s

  File.open(out_file, 'w+') { |f| f.write out_text }
  puts 'OK] '+line
end
