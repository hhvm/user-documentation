#!/usr/bin/env ruby

require 'bundler/setup'
require 'html/pipeline'

require_relative 'HHVM/UserDocumentation/SyntaxHighlightFilter.rb'
require_relative 'HHVM/UserDocumentation/IncludeExamplesFilter.rb'

FILE = ARGV[0]

if FILE.nil?
  puts "Usage: #{$0} /path/to/input.md"
  exit(1)
end

pipeline = HTML::Pipeline.new(
  [
    HTML::Pipeline::MarkdownFilter,
    HHVM::UserDocumentation::IncludeExamplesFilter,
    HHVM::UserDocumentation::SyntaxHighlightFilter,
  ],
  { file: FILE },
)

puts pipeline.call(File.read(FILE))[:output].to_s
