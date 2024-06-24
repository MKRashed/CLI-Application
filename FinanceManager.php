<?php
class FinanceManager
{
  private $incomeFile = 'incomes.json';
  private $expenseFile = 'expenses.json';

  public function __construct()
  {
    if (!file_exists($this->incomeFile)) {
      file_put_contents($this->incomeFile, json_encode([]));
    }
    if (!file_exists($this->expenseFile)) {
      file_put_contents($this->expenseFile, json_encode([]));
    }
  }

  public function addIncome($amount, $category)
  {
    $incomes = $this->getIncomes();
    $incomes[] = ['amount' => $amount, 'category' => $category];
    file_put_contents($this->incomeFile, json_encode($incomes));
    echo "Income added successfully.\n";
  }

  public function addExpense($amount, $category)
  {
    $expenses = $this->getExpenses();
    $expenses[] = ['amount' => $amount, 'category' => $category];
    file_put_contents($this->expenseFile, json_encode($expenses));
    echo "Expense added successfully.\n";
  }

  public function viewIncomes()
  {
    $incomes = $this->getIncomes();
    if (empty($incomes)) {
      echo "No incomes recorded.\n";
    } else {
      foreach ($incomes as $income) {
        echo "Amount: {$income['amount']}, Category: {$income['category']}\n";
      }
    }
  }

  public function viewExpenses()
  {
    $expenses = $this->getExpenses();
    if (empty($expenses)) {
      echo "No expenses recorded.\n";
    } else {
      foreach ($expenses as $expense) {
        echo "Amount: {$expense['amount']}, Category: {$expense['category']}\n";
      }
    }
  }

  public function viewSavings()
  {
    $incomes = $this->getIncomes();
    
    $expenses = $this->getExpenses();

    $totalIncome = array_sum(array_column($incomes, 'amount'));
    
    $totalExpense = array_sum(array_column($expenses, 'amount'));
    
    $savings = $totalIncome - $totalExpense;

    echo "Total Savings: {$savings}\n";
  }

  public function viewCategories()
  {
    $incomes = $this->getIncomes();
    $expenses = $this->getExpenses();

    $incomeCategories = array_unique(array_column($incomes, 'category'));
    $expenseCategories = array_unique(array_column($expenses, 'category'));

    echo "Income Categories: " . implode(', ', $incomeCategories) . "\n";
    echo "Expense Categories: " . implode(', ', $expenseCategories) . "\n";
  }

  private function getIncomes()
  {
    return json_decode(file_get_contents($this->incomeFile), true);
  }

  private function getExpenses()
  {
    return json_decode(file_get_contents($this->expenseFile), true);
  }
}
// function showMenu()
// {
//   echo "1. Add income\n";
//   echo "2. Add expense\n";
//   echo "3. View incomes\n";
//   echo "4. View expenses\n";
//   echo "5. View savings\n";
//   echo "6. View categories\n";
//   echo "Enter your option: ";
// }

// $manager = new FinanceManager();

// while (true) {
//   showMenu();
//   $option = trim(fgets(STDIN));

//   switch ($option) {
//     case 1:
//       echo "Enter amount: ";
//       $amount = (float) trim(fgets(STDIN));
//       echo "Enter category: ";
//       $category = trim(fgets(STDIN));
//       $manager->addIncome($amount, $category);
//       break;
//     case 2:
//       echo "Enter amount: ";
//       $amount = (float) trim(fgets(STDIN));
//       echo "Enter category: ";
//       $category = trim(fgets(STDIN));
//       $manager->addExpense($amount, $category);
//       break;
//     case 3:
//       $manager->viewIncomes();
//       break;
//     case 4:
//       $manager->viewExpenses();
//       break;
//     case 5:
//       $manager->viewSavings();
//       break;
//     case 6:
//       $manager->viewCategories();
//       break;
//     default:
//       echo "Invalid option. Please try again.\n";
//       break;
//   }

//   echo "\n";
// }