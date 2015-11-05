var transEndEventName = ('WebkitTransition' in document.documentElement.style) ? 'webkitTransitionEnd' : 'transitionend';

function scrollToActiveItem() {
  var navList = document.getElementsByClassName('navList')[0];
  var navList = document.getElementsByClassName('navList')[0];
  var activeItemID = currentType+'.'+currentAPI;
  if (currentMethod) {
    activeItemID += '.'+currentMethod;
  }
  navList.scrollTop = 
    document.getElementById(activeItemID.replace('.', '/')).offsetTop - 20;
  document.removeEventListener(transEndEventName, scrollToActiveItem, false);
}

var DocNav = React.createClass({displayName: "DocNav",
  getInitialState: function() {
    return {
      toggleActive: false,
    };
  },
  getDefaultProps: function() {
    return {
      currentType: currentType,
      currentAPI: currentAPI,
      currentMethod: currentMethod,
      data: docnavData,
      baseRefURL: '/hack/reference',
    }
  },
  handleSlide: function(id) {
    this.setState({
      toggleActive: !this.state.toggleActive,
    });
  },
  componentWillUpdate: function() {
    // TODO: Replace with ReactCSSTransitionGroup
    document.addEventListener(transEndEventName, scrollToActiveItem, false);
  },
  componentDidUpdate: function() {
    var navWrapper = document.getElementsByClassName('navWrapper')[0];
    navWrapper.dataset.active = this.state.toggleActive;
  },
  componentDidMount: function() {
    var navList = document.getElementsByClassName('navList')[0];
    var activeItemID = this.props.currentType+'.'+this.props.currentAPI;
    if (this.props.currentMethod) {
      activeItemID += '.'+this.props.currentMethod;
    }
    navList.scrollTop = 
      document.getElementById(activeItemID.replace('.', '/')).offsetTop - 80;
  },
  render: function() {
    var navChildren = [];
    for (var apitype in this.props.data) {
      navChildren.push(this.renderNavAPIType(apitype));
    }
    var navClass = 'navToggle navToggle'+this.state.toggleActive;
    var toggleClass = 'toggleNav toggleNav'+this.state.toggleActive;
    return (
      React.createElement("div", {className: navClass}, 
        React.createElement("div", 
          {className: toggleClass, onClick: this.handleSlide},
          React.createElement("i", {className: "fa fa-th-list"})
        ),
        React.createElement(
          "ul", 
          {className: 'navList apiNavList'}, 
          navChildren
        )
      )
    );
  },
  renderNavAPIType: function(currentType) {
    var navTypeChildren = [];
    var apiType = this.props.data[currentType];
        
    if (Object.keys(apiType).length > 1) {
      for (var api in apiType) {
        navTypeChildren.push(this.renderNavAPIItem(apiType, currentType, api));
      }
    }
    var typeClass = 'apiNavType';
    if (currentType.toUpperCase() === this.props.currentType.toUpperCase()) {
      typeClass += ' apiNavTypeActive';
    }
    var typeHref = this.props.baseRefURL+'/'+currentType+'/';
    return (
      React.createElement("li", {className: typeClass, key: currentType}, 
        React.createElement("h4", {id: currentType}, 
          React.createElement("a", {className: 'navItem', href: typeHref}, formatTitle(currentType))
        ), 
        React.createElement("ul", {className: 'subList'}, 
          navTypeChildren
        )
      )
    );
  },
  renderNavAPIItem: function(parentTypeItems, parentType, item) {
    var itemHref = this.props.baseRefURL+'/'+parentType+'/'+item+'/';
    var itemClass = 'subListItem';
    var itemID = parentType+'.'+item;
    var activeAPIID = this.props.currentType+'.'+this.props.currentAPI;
    if (itemID.toUpperCase() === activeAPIID.toUpperCase()) {
      itemClass += ' itemActive';
    }
    var itemMethods = parentTypeItems[item].methods;
    var navApiChildren = [];
    if (Object.keys(itemMethods).length > 0) {
      for (var method in itemMethods) {
        navApiChildren.push(
          this.renderNavAPIMethod(itemMethods[method], itemHref, itemID, method)
        )
      }
    }
    return (
      React.createElement("li", {
          className: itemClass, 
          key: item, 
          id: itemID.replace('.', '/')
        },       
        React.createElement("h5", null, 
          React.createElement("a", {className: 'navItem', href: itemHref}, formatTitle(item))
        ), 
        React.createElement("ul", {className: 'subMethodList'}, 
          navApiChildren
        )
      )
    );
  },
  renderNavAPIMethod: function(method, parentHref, parentID, item) {
    var itemHref = parentHref+item+'/';
    var itemClass = 'subMethodListItem';
    var itemID = parentID+'.'+item;
    var activeAPIMethodID = this.props.currentType+'.'+this.props.currentAPI;
    if (this.props.currentMethod) {
      activeAPIMethodID += '.'+this.props.currentMethod;
    }
    if (itemID.toUpperCase() === activeAPIMethodID.toUpperCase()) {
      itemClass += ' methodActive';
    }
    return (
      React.createElement("li", {
          className: itemClass, 
          key: item, 
          id: itemID.replace('.', '/')
        },       
        React.createElement("h6", null, 
          React.createElement("a", {className: 'navItem', href: itemHref}, formatTitle(item))
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
      currentType: currentType,
      currentAPI: currentAPI,
      currentMethod: currentMethod,
      baseRefURL: '/hack/reference'
    }
  ),
  navLoader
);



