<?php

class Blackjack {
    private player $player;
    private dealer $dealer;
    private deck $deck;
    private int $playerScore = 0;
    private int $dealerScore = 0;

    public function getPlayer()
    {
        return $this->player;
    }

    public function getDealer()
    {
        return $this->dealer;
    }

    public function __construct()
    {
        $deck = new deck();
        $deck->shuffle();
        $this->deck = $deck;
        $this->player = new Player($deck);
        $this->dealer = new Dealer($deck);

    }


    public function display()
    {
        $this->playerScore;
        $this->dealerScore;
        foreach($this->getPlayer()->getCards() as $card){
            echo $card->getUnicodeCharacter($includeColor = true);
            $this->playerScore += $card->getValue();
        }
        echo $this->playerScore;

        foreach ($this->getDealer()->getCards() as $card){
            echo $card->getUnicodeCharacter($includeColor = true);
            $this->dealerScore += $card->getValue();
        }
        echo $this->dealerScore;
    }

    public function getDeck()
    {
        return $this->deck;
    }

}
