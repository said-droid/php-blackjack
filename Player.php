<?php

class Player
{
    private array $cards;
    private bool $lost = false;
    private int $score = 0;
    public const MAXPOINTS = 21;
    public const MAX_DEALER_POINTS = 15;

    public function hit()
    {
        $this->cards[] = $_SESSION['test']->getDeck()->drawCard();
        if ($_SESSION['test']->getPlayer()->getScore() > self::MAXPOINTS){
            $this->lost = true;

        }
    }

    public function surrender()
    {
        $this->lost = true;
    }

    public function getScore()
    {
        $cards = $_SESSION['test']->getPlayer()->cards;
        foreach ($cards as $card){
            $this->score += $card->getValue();
        }
    }

    public function hasLost()
    {
        return $this->lost;
    }

    public function getCards() : array
    {
        return $this->cards;
    }

    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
        //var_dump($this->cards);
    }
}

class Dealer extends Player
{
    public function hit()
    {
        while ($_SESSION['test']->getDealer()->getScore() < parent::MAX_DEALER_POINTS) {
            Parent::hit();
        }
    }
}

