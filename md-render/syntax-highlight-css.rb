#!/usr/bin/env ruby

Dir.chdir(File.dirname(__FILE__))

require 'bundler/setup'
require 'pygments'

puts Pygments.css('.highlight')
