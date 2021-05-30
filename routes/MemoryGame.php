<?php

class MemoryGame
{
    private $card;

    public function __construct(Card $card)
    {
        $this->card = $card; // どのカードでもいい（神経衰弱クラスはどのカードなのか知らなくていい）
        $this->card->suffle();
    }

    public function isHit(): bool
    {
        // 神経衰弱を行う
    }
}
