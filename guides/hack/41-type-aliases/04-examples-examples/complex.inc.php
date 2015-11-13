<?hh // strict

// complex.inc.php - Complex number implementation file

namespace Hack\UserDocumentation\TypeAliases\Examples\Examples\ComplexNumber;

newtype Complex = shape('real' => float, 'imag' => float);

function createComplex(float $real = 0.0, float $imag = 0.0): Complex {
  return shape('real' => $real, 'imag' => $imag);
}

function getI(): Complex {
  return shape('real' => 0.0, 'imag' => 1.0);
}

function getReal(Complex $z): float {
  return $z['real'];
}

function getImag(Complex $z): float {
  return $z['imag'];
}

function setReal(Complex $z, float $real = 0.0): Complex {
  $z['real'] = $real;
  return $z;
}

function setImag(Complex $z, float $imag = 0.0): Complex {
  $z['imag'] = $imag;
  return $z;
}

function add(Complex $z1, Complex $z2): Complex {
  return shape('real' => $z1['real'] + $z2['real'],
               'imag' => $z1['imag'] + $z2['imag']);
}

function subtract(Complex $z1, Complex $z2): Complex {
  return shape('real' => $z1['real'] - $z2['real'],
               'imag' => $z1['imag'] - $z2['imag']);
}

function toString(Complex $z): string {
  if ($z['imag'] <= 0.0) {
    return "(" . $z['real'] . " - " . (-$z['imag']) . "i)";
  } else if (1.0/$z['imag'] == -INF) {
    return "(" . $z['real'] . " - " . 0.0 . "i)";
  } else {
    return "(" . $z['real'] . " + " . (+$z['imag']) . "i)";
  }
}
