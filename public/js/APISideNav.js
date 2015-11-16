var transEndEventName = ('WebkitTransition' in document.documentElement.style) ? 'webkitTransitionEnd' : 'transitionend';

var DocNav = React.createClass({displayName: "DocNav",
  getInitialState: function() {
    return {
      toggleActive: false,
    };
  },
  getDefaultProps: function() {
    return {
      className: {
        'api' : 'apiNavList',
      }
    };
  },
  handleSlide: function(id) {
    this.setState({
      toggleActive: !this.state.toggleActive,
    });
  },
  handleScrollToActive: function() {
    var navList = document.getElementsByClassName('navList')[0];
    navList.scrollTop = 
      document.getElementById(this.props.current.activeItem).offsetTop - 10;
    window.removeEventListener(transEndEventName, this.handleScrollToActive, false);
  },
  componentWillUpdate: function() {
    // TODO: Replace with ReactCSSTransitionGroup
    window.addEventListener(transEndEventName, this.handleScrollToActive, false);
  },
  componentDidUpdate: function() {
    var navWrapper = document.getElementsByClassName('navWrapper')[0];
    navWrapper.dataset.active = this.state.toggleActive;
  },
  componentDidMount: function() {
    this.handleScrollToActive();
  },
  render: function() {
    var navChildren = [];
    for (var group in this.props.data) {
      navChildren.push(this.renderNavGroup(group));
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
          {className: 'navList '+this.props.className[this.props.loadType]}, 
          navChildren
        )
      )
    );
  },
  renderNavGroup: function(currentGroup) {
    var navGroupChildren = [];
    var group = this.props.data[currentGroup];
        
    if (Object.keys(group).length > 1) {
      for (var item in group) {
        navGroupChildren.push(this.renderNavFirstLevelItem(group[item], currentGroup));
      }
    }
    var groupClass = 'navGroup';
    if (currentGroup.toUpperCase() === this.props.current.group.toUpperCase()) {
      groupClass += ' navGroupActive';
    }
    var groupHref = this.props.base+'/'+currentGroup+'/';
    return (
      React.createElement("li", {className: groupClass, key: currentGroup}, 
        React.createElement("h4", {id: currentGroup}, 
          React.createElement("a", {className: 'navItem', href: groupHref}, currentGroup)
        ), 
        navGroupChildren.length > 0
          ? React.createElement("ul", {className: 'subList'}, navGroupChildren)
          : null
      )
    );
  },
  renderNavFirstLevelItem: function(item, parentGroup) {
    var itemHref = this.props.base+'/'+parentGroup+'/'+item.name+'/';
    var itemClass = 'subListItem';
    var itemID = parentGroup+'/'+item.name;
    if (itemID.toUpperCase() === this.props.current.activeFirstLevel.toUpperCase()) {
      itemClass += ' itemActive';
    }

    var navItemChildren = [];
    // TODO: Generalise 'methods' and merge with guide SideNav.js
    if (item.hasOwnProperty('methods')) {
      var itemChildren = item.methods;
      if (Object.keys(itemChildren).length > 0) {
        for (var child in itemChildren) {
          navItemChildren.push(
            this.renderNavSecondLevelItem(itemChildren[child], itemHref, itemID)
          )
        }
      }
    }
    return (
      React.createElement("li", {
          className: itemClass, 
          key: item.name, 
          id: itemID
        },       
        React.createElement("h5", null, 
          React.createElement("a", {className: 'navItem', href: itemHref}, item.name)
        ), 
        React.createElement("ul", {className: 'secondLevelList'}, 
          navItemChildren
        )
      )
    );
  },
  renderNavSecondLevelItem: function(item, parentHref, parentID) {
    var itemHref = parentHref+item.name+'/';
    var itemClass = 'secondLevelListItem';
    var itemID = parentID+'/'+item.name;
    if (itemID.toUpperCase() === this.props.current.activeItem.toUpperCase()) {
      itemClass += ' secondLevelItemActive';
    }
    return (
      React.createElement("li", {
          className: itemClass, 
          key: item.name, 
          id: itemID
        },       
        React.createElement("h6", null, 
          React.createElement("a", {className: 'navItem', href: itemHref}, item.name)
        )
      )
    );
  },
});



