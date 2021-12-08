<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
		$depositBalance = $this->balance->value() + $amount->value();
		$this->balance = new Money($depositBalance);
    }

	public function withdraw(Money $amount)
	{
		$withdrawAmt = $amount->value();
		$accBal = $this->balance->value();
		if($withdrawAmt < $accBal) {
			$withdrawBalance = $accBal - $withdrawAmt;
			$this->balance = new Money($withdrawBalance);
		}
		else {
			throw new Exception('Withdrawl amount larger than balance');
		}
	}

    public function transfer(Money $amount, BankAccount $account)
    {
		$withdrawAmt = $amount->value();
		$accBal = $this->balance->value();
		if($withdrawAmt < $accBal) {
			$this->withdraw($amount);
			$account->deposit($amount);
		}
		else {
			throw new Exception('Withdrawl amount larger than balance');
		}
    }
}
