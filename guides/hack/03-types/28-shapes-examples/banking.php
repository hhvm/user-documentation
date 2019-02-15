<?hh // strict

namespace Hack\UserDocumentation\Types\Shapes\Examples\Banking;

enum Bank: int {
  DEPOSIT = 1;
  WITHDRAWAL = 2;
  TRANSFER = 3;
}

type Transaction = shape('trtype' => Bank, ...);
type Deposit = shape('trtype' => Bank, 'toaccnum' => int, 'amount' => float);
type Withdrawal = shape('trtype' => Bank, 'fromaccnum' => int, 'amount' => float);
type Transfer = shape('trtype' => Bank, 'fromaccnum' => int, 'toaccnum' => int, 'amount' => float);

<<__Entrypoint>>
function main(): void {
  process_transaction(shape('trtype' => Bank::DEPOSIT, 'toaccnum' => 23456, 'amount' => 100.00));
  process_transaction(shape('trtype' => Bank::WITHDRAWAL, 'fromaccnum' => 3157, 'amount' => 100.00));
  process_transaction(shape('trtype' => Bank::TRANSFER, 'fromaccnum' => 23456,
   'toaccnum' => 3157, 'amount' => 100.00));
}

function process_transaction(Transaction $t): void {
  $ary = Shapes::toArray($t);
  switch ($t['trtype']) {
  case Bank::TRANSFER:
    echo "Transfer: " . ((string)$ary['amount'])
      . " from Account " . ((string)$ary['fromaccnum'])
      . " to Account " . ((string)$ary['toaccnum']) . "\n";
    // ...
    break;

  case Bank::DEPOSIT:
    echo "Deposit: " . ((string)$ary['amount'])
      . " to Account " . ((string)$ary['toaccnum']) . "\n";
    // ...
    break;

  case Bank::WITHDRAWAL:
    echo "Withdrawal: " . ((string)$ary['amount'])
      . " from Account " . ((string)$ary['fromaccnum']) . "\n";
    // ...
    break;
  }
}
