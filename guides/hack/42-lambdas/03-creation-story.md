![Yeah, lambdas](/images/lambdaop.png)

## Double Arrow

PHP and HHVM already use `=>` (aka the double arrow) as a separator in array literals, collection literals, and `yield` statements. As such, trying to co-opt `=>` for lambda expressions leads to some ambiguous cases, and the different possible schemes for arbitrarily resolving these ambiguities all felt like they would catch the developer by surprise and cause confusion/frustration and increase how often things needed to be wrapped in parentheses. Likewise PHP might start using `=>` for other purposes in the next few years that might conflict with using `=>` for lambda expressions.

## Berries

We all went into the woods with pens and pads of paper and ate hallucinogenic berries we found to come up with ideas. Someone suggested two equal signs followed by a greater than sign and we all burst into uncontrollable laughter. The laughter was followed by intense philosophical introspection into the nature of symbols, and how it's weird that we draw two parallel lines for the equal sign, and how it's fun to think about how they decided which symbols went on the standard keyboard. As the effects of the berries wore off and we started to walk back, we looked at the `==>` symbol we had written down and thought about how it all fits together with the abstract architecture of the universe, and how it strikes a chord within us that gives a calming sense of harmony with the world.
