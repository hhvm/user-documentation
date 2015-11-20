var transEndEventName = ('WebkitTransition' in document.documentElement.style) ? 'webkitTransitionEnd' : 'transitionend';

var DocNav = React.createClass({displayName: "DocNav",
  getInitialState: function() {
    return {
      toggleActive: false,
    };
  },
  handleSlide: function(id) {
    this.setState({
      toggleActive: !this.state.toggleActive,
    });
  },
  handleScrollToActive: function() {
    var navList = document.getElementsByClassName('navList')[0];
    var id = this.props.activePath.join('/');
    if (id !== '') {
      navList.scrollTop =
       document.getElementById(id).offsetTop - 10;
    }
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
          {className: 'navList '+this.props.extraNavListClass},
          navChildren
        )
      )
    );
  },
  activeGroup: function() {
    return this.props.activePath[0];
  },
  activeFirstLevel: function() {
    return this.props.activePath[1];
  },
  activeSecondLevel: function() {
    return this.props.activePath[2];
  },
  renderNavGroup: function(groupName) {
    var group = this.props.data[groupName];

    var groupClass = 'navGroup';
    if (groupName === this.activeGroup()) {
      groupClass += ' navGroupActive';
    }
    var groupHref = group.urlPath;

    var navGroupChildren = [];
    if (Object.keys(group).length > 1) {
      for (var itemName in group.children) {
        navGroupChildren.push(this.renderNavFirstLevelItem(
          groupName,
          group.children[itemName]
        ));
      }
    }

    return (
      React.createElement("li", {className: groupClass, key: groupName},
        React.createElement("h4", {id: groupName},
          React.createElement("a", {className: 'navItem', href: groupHref}, groupName)
        ),
        navGroupChildren.length > 0
          ? React.createElement("ul", {className: 'subList'}, navGroupChildren)
          : null
      )
    );
  },
  renderNavFirstLevelItem: function(groupName, item) {
    var itemName = item.name;
    var itemHref = item.urlPath;
    var itemClass = 'subListItem';
    var itemID = groupName+'/'+itemName;

    if (groupName === this.activeGroup() && itemName === this.activeFirstLevel()) {
      itemClass += ' itemActive';
    }

    var navItemChildren = [];
    for (var childName in item.children) {
      navItemChildren.push(
        this.renderNavSecondLevelItem(
          groupName,
          itemName,
          item.children[childName]
        )
      );
    }
    return (
      React.createElement("li", {
          className: itemClass,
          key: itemName,
          id: itemID
        },
        React.createElement("h5", null,
          React.createElement("a", {className: 'navItem', href: itemHref}, itemName)
        ),
        React.createElement("ul", {className: 'secondLevelList'},
          navItemChildren
        )
      )
    );
  },
  renderNavSecondLevelItem: function(
    groupName,
    parentName,
    item
  ) {
    var itemName = item.name;
    var itemHref = item.urlPath;
    var itemClass = 'secondLevelListItem';
    var itemID = groupName+'/'+parentName+'/'+itemName;
    if (groupName === this.activeGroup() && parentName === this.activeFirstLevel()) {
      itemClass += ' itemActive';
      if (itemName === this.activeSecondLevel()) {
        itemClass += ' secondLevelItemActive';
      }
    }

    return (
      React.createElement("li", {
          className: itemClass,
          key: itemName,
          id: itemID
        },
        React.createElement("h6", null,
          React.createElement("a", {className: 'navItem', href: itemHref}, itemName)
        )
      )
    );
  },
});
