#!/usr/bin/env ruby

if ARGV[0].nil?
  puts "Usage: #{$0} /path/to/input.md"
  exit(1)
end

# Make relative file paths survive the chdir, which bundler needs :(
FILE = File.realpath(ARGV[0])
Dir.chdir(File.dirname(__FILE__))

require 'bundler/setup'
require 'html/pipeline'

require_relative 'HHVM/UserDocumentation/SyntaxHighlightFilter.rb'
require_relative 'HHVM/UserDocumentation/IncludeExamplesFilter.rb'

pipeline = HTML::Pipeline.new(
  [
    HTML::Pipeline::MarkdownFilter,
    HHVM::UserDocumentation::IncludeExamplesFilter,
    HHVM::UserDocumentation::SyntaxHighlightFilter,
  ],
  { file: FILE },
)

puts pipeline.call(File.read(FILE))[:output].to_s
