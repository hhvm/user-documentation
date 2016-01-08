# Copyright (c) 2012 GitHub Inc. and Jerry Cheung
# Copyright (c) 2015 Facebook Inc
#
# MIT License
#
# Permission is hereby granted, free of charge, to any person obtaining
# a copy of this software and associated documentation files (the
# "Software"), to deal in the Software without restriction, including
# without limitation the rights to use, copy, modify, merge, publish,
# distribute, sublicense, and/or sell copies of the Software, and to
# permit persons to whom the Software is furnished to do so, subject to
# the following conditions:
#
# The above copyright notice and this permission notice shall be
# included in all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

require 'pygments'

module HHVM
  module UserDocumentation
    class SyntaxHighlightFilter < HTML::Pipeline::Filter
      def call
        doc.search('pre').each do |node|
          orig_lang = node['lang'] || 'hack'
          lang = orig_lang

          if lang.downcase == 'hack' || lang.downcase == 'hacksignature'
            lang = 'php'
          end

          lexer = Pygments::Lexer[lang]
          next unless lexer

          source = node.inner_text

          html = lexer.highlight(source)
          if (node = node.replace(html).first)
            klass = node['class']
            klass = "#{klass} highlight highlight-#{lang}"
            node["class"] = klass
          end

          if orig_lang.downcase == 'hacksignature'
            node = node.children[0] # pre

            # strip out the '<?hh' and any whitespace
            node.children.each do |child|
              if child.text =~ /^(<\?|hh|\s*)$/
                child.remove
                next
              end
              break
            end
          end
        end
        doc
      end
    end
  end
end
