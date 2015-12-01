#!/usr/bin/env ruby

Dir.chdir(File.dirname(__FILE__))

require 'bundler'
Bundler.require(:default, :sass)
require 'sass'

def gem_path(gem)
  Gem::Specification.find_by_name(gem).gem_dir
end

template = File.read('core.scss')
sass_engine = Sass::Engine.new(template, {
  :load_paths => [
    File.join(gem_path("bourbon"), 'app', 'assets', 'stylesheets'),
    '.',
  ],
  :style => :compressed,
  :syntax => :scss,
})
output = sass_engine.render
puts output