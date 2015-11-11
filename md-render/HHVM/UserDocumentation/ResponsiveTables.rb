module HHVM
  module UserDocumentation
    class ResponsiveTables < HTML::Pipeline::Filter
      def call
        doc.search('table').each do |node|
          headers = []
          node.search('th').each do |th|
            headers << th.text
          end
          node.search('tbody/tr').each do |tr|
            tr.search('td').each_with_index do |item, i|
              item['data-heading'] = headers[i]
            end
          end  
          wrapper = doc.document.create_element('div')
          wrapper[:class] = 'tableWrapper'
          node.add_next_sibling(wrapper)
          node.parent = wrapper
        end
        doc
      end
    end
  end
end
