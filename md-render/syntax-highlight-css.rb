#!/usr/bin/env ruby

require 'bundler/setup'
require 'pygments'

puts Pygments.css('.highlight')
