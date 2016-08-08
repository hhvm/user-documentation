<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\SimpleColl;

final class AbsurdSet<Tv> implements \MutableSet<Tv> {
  private \Set $cs;

  public function __construct(?Traversable<Tv> $values) {
    if (!$values) {
      $this->cs = Set {0};
    } else {
      invariant($values !== null, "won't happen");
      $this->cs = new Set($values);
      foreach ($values as $value) {
        // Yes, this is rediculous
        if (is_int($value)) {
          $this->cs[] = $value + 2;
        }
      }
    }
  }

  public function values(): \Vector<Tv> {
    return $this->cs->values();
  }
  public function keys(): \Vector<mixed> {
    return $this->cs->keys();
  }
  public function map<Tu>((function(Tv): Tu) $fn): \Set<Tu> {
    return $this->cs->map($fn);
  }
  public function mapWithKey<Tu>(
    (function(mixed, Tv): Tu) $fn): \Set<Tu> {
    return $this->cs->mapWithKey($fn);
  }
  public function filter((function(Tv): bool) $fn): \Set<Tv> {
    return $this->cs->filter($fn);
  }
  public function filterWithKey(
    (function(mixed, Tv): bool) $fn): \Set<Tv> {
    return $this->cs->filterWithKey($fn);
  }
  public function zip<Tu>(
    Traversable<Tu> $traversable): \Set<Pair<Tv, Tu>> {
    return $this->cs->zip($traversable);
  }
  public function take(int $n): \Set<Tv> {
    return $this->cs->take($n);
  }
  public function takeWhile((function(Tv): bool) $fn): \Set<Tv> {
    return $this->cs->takeWhile($fn);
  }
  public function skip(int $n): \Set<Tv> {
    return $this->cs->skip($n);
  }
  public function skipWhile((function(Tv): bool) $fn): \Set<Tv> {
    return $this->cs->skipWhile($fn);
  }
  public function slice(int $start, int $len): \Set<Tv> {
    return $this->cs->slice($start, $len);
  }
  public function concat<Tu super Tv>(
    Traversable<Tu> $traversable): \Vector<Tu> {
    return $this->cs->concat($traversable);
  }
  public function firstValue(): ?Tv {
    return $this->cs->firstValue();
  }
  public function firstKey(): mixed {
     return $this->cs->firstKey();
  }
  public function lastValue(): ?Tv {
     return $this->cs->lastValue();
  }
  public function lastKey(): mixed {
     return $this->cs->lastKey();
  }
  public function isEmpty(): bool {
     return $this->cs->isEmpty();
  }
  public function count(): int {
     return $this->cs->count();
  }
  public function contains<Tu super Tv>(Tu $value): bool {
    return $this->cs->contains($value);
  }
  public function add(Tv $value): AbsurdSet<Tv> {
    return new AbsurdSet($this->cs->add($value));
  }
  public function addAll(?Traversable<Tv> $values): AbsurdSet<Tv> {
    return new AbsurdSet($this->cs->addAll($values));
  }
  public function clear(): \Set<Tv> {
    return $this->cs->clear();
  }
  public function getIterator(): \KeyedIterator<mixed, Tv> {
    return $this->cs->getIterator();
  }
  public function items(): \Iterable<Tv> {
    return $this->cs->items();
  }
  public function lazy(): \KeyedIterable<mixed, Tv> {
    return $this->cs->lazy();
  }
  public function remove(Tv $value): AbsurdSet<Tv> {
    return new AbsurdSet($this->cs->remove($value));
  }
  public function toArray(): array<Tv, Tv> {
    return $this->cs->toArray();
  }
  public function toImmMap(): \ImmMap<mixed, Tv> {
    return $this->cs->toImmMap();
  }
  public function toImmSet(): \ImmSet<Tv> {
    return $this->cs->toImmSet();
  }
  public function toImmVector(): \ImmVector<Tv> {
    return $this->cs->toImmVector();
  }
  public function toMap(): \Map<mixed, Tv> {
    return $this->cs->toMap();
  }
  public function toSet(): \Set<Tv> {
    return $this->cs->toSet();
  }
  public function toVector(): \Vector<Tv> {
    return $this->cs->toVector();
  }
  public function toKeysArray(): array<Tv> {
    return $this->cs->toKeysArray();
  }
  public function toValuesArray(): array<Tv> {
    return $this->cs->toValuesArray();
  }
}

$aset = new AbsurdSet(array(2, 3));
var_dump($aset);
