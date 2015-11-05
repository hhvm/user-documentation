var transEndEventName = ('WebkitTransition' in document.documentElement.style) ? 'webkitTransitionEnd' : 'transitionend';

function scrollToActive() {
  var navList = document.getElementsByClassName('navList')[0];
  navList.scrollTop = 
    document.getElementsByClassName('navGroupActive')[0].offsetTop - 20;
  document.removeEventListener(transEndEventName, scrollToActive, false);
}

var DocNav = React.createClass({displayName: "DocNav",
  getInitialState: function() {
    return {
      toggleActive: false,
    };
  },
  getDefaultProps: function() {
    return {
      currentProduct: thisProduct,
      currentDoc: thisDoc,
      currentGroup: thisGroup,
      data: docnavData
    }
  },
  handleSlide: function(id) {
    this.setState({
      toggleActive: !this.state.toggleActive,
    });
  },
  componentWillUpdate: function() {
    // TODO: Replace with ReactCSSTransitionGroup
    document.addEventListener(transEndEventName, scrollToActive, false);
  },
  componentDidUpdate: function() {
    var navWrapper = document.getElementsByClassName('navWrapper')[0];
    navWrapper.dataset.active = this.state.toggleActive;
  },
  componentDidMount: function() {
    var navList = document.getElementsByClassName('navList')[0];
    var activeGroup = document.getElementsByClassName('navGroupActive')[0];
    navList.scrollTop = activeGroup.offsetTop - 20;
  },
  render: function() {
    var navChildren = [];
    for (var group in this.props.data) {
      navChildren.push(this.renderNavGroups(this.props.data[group], group));
    }
    var navClass = 'navToggle navToggle'+this.state.toggleActive;
    var toggleClass = 'toggleNav toggleNav'+this.state.toggleActive;
    return (
      React.createElement("div", {className: navClass}, 
        React.createElement("div", 
          {className: toggleClass, onClick: this.handleSlide},
          React.createElement("i", {className: "fa fa-th-list"})
        ),
        React.createElement("ul", {className: 'navList'}, navChildren)
      )
    );
  },
  renderNavGroups: function(group, index) {
    var navGroupChildren = [];
    
    // If there is only one page to a guide, just have the main
    // guide heading be the link to that page. Don't duplicate here.
    if (Object.keys(group).length > 1) {
      for (var child in group) {
        // Drop 'intro' links as the guide headings will link there anyway
        if (child !== 'intro') {
          navGroupChildren.push(this.renderNavItems(group[child], child, index));
        }
      }
    }
    var groupClass = 'navGroup';
    if (index.toUpperCase() === this.props.currentGroup.toUpperCase()) {
      groupClass += ' navGroupActive';
    }
    var groupHref = '/'+this.props.currentProduct+'/'+index+'/';
    return (
      React.createElement("li", {className: groupClass, key: index}, 
        React.createElement("h4", {id: index}, 
          React.createElement("a", {className: 'navItem', href: groupHref}, formatTitle(index))
        ), 
        React.createElement("ul", {className: 'subList'}, 
          navGroupChildren
        )
      )
    );
  },
  renderNavItems: function(child, index, parentGroup) {
    var itemHref = '/' + child.replace('.html', '');
    var itemClass = 'subListItem';
    if (
      parentGroup.toUpperCase() === this.props.currentGroup.toUpperCase() &&
      index.toUpperCase() === this.props.currentDoc.toUpperCase()
    ) {
      itemClass += ' itemActive';
    }
    return (
      React.createElement("li", {className: itemClass, key: index},       
        React.createElement("h5", null, 
          React.createElement("a", {className: 'navItem', href: itemHref}, formatTitle(index))
        )
      )
    );
  },
});

function formatTitle(title) {
  return title.replace('-', ' ');
}

var navLoader = document.getElementsByClassName('navLoader')[0];

ReactDOM.render(
  React.createElement(
    DocNav, {
      data: docnavData, 
      currentDoc: thisDoc, 
      currentGroup: thisGroup,
      currentProduct: thisProduct
    }
  ),
  navLoader
);



