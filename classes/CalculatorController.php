<?php



include_once __DIR__ . '/../database/CurrenciesTable.php';
include_once __DIR__ . '/../database/ConvertCurrencies.php';

class CalculatorController extends \CurrenciesTable
{
    public float $current_currency;

    public float $calculated_value;

    public float $selected_current;

    public float $score;


    public function __construct($current_currency, $selected_current, $calculated_value)
    {
        $this->current_currency = $current_currency;

        $this->calculated_value = $calculated_value;

        $this->selected_current = $selected_current;


    }

    public function calc()
    {
        try {
            if ($this->validation() == false) {
                throw new \Exception('Select currency');
            } else {
                $currentId = $_POST['current_select'];
                $targetId = $_POST['target'];

                // pobierz wartości walut po ID
                $currentRate = $this->getRateById($currentId);
                $targetRate = $this->getRateById($targetId);

                $this->score = $this->current_currency * ($currentRate / $targetRate);

                $insert = new \ConvertCurrencies($this->current_currency, $this->selected_current, $this->calculated_value, $this->score);
                $insert->insertConvertCurrencies();

                return round($this->score, 2);
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function validation()
    {
        $check = false;
        if (isset($this->current_currency) || isset($this->selected_current) || isset($this->calculated_value)) {
            $check = true;
        }
        if ($this->current_currency <= 0 || $this->selected_current <= 0 || $this->calculated_value <= 0) {
            throw new \Exception("Fill in the blanks, cannot divide by 0");
        }
        if ($this->selected_current == $this->calculated_value) {
            throw new \Exception("YOU CAN'T MAKE AN EXCHANGE BETWEEN TWO SAME CURRENCIES");
        }

        return $check;
    }

//Znajdz kurs waluty po ID
    private function getRateById($id)
    {
        $currency = $this->findCurrencyById($id);
        if ($currency) {
            return $currency['rate'];
        } else {
            throw new \Exception('Currency not found');
        }
    }

    //znajdz rate po id
    private function findCurrencyById($id)
    {
        $query = new  Connect();
        $conn = $query->conn;
        $query = "SELECT rate FROM currency_rate WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}