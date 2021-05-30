<?php

require_once './MemoryGame.php';
require_once './PlayingCard.php';
require_once './AnimalCard.php';
require_once './VehicleCard.php';

$cardType = 'AnimalCard';

if ($cardType === 'PlayingCard') {
    $card = new PlayingCard();
} elseif ($cardType === 'AnimalCard') {
    $card = new AnimalCard();
} elseif ($cardType === 'VehicleCard') {
    $card = new VehicleCard();
}

$memoryGame = new MemoryGame($card);

// 神経衰弱ゲーム実施
if ($memoryGame->isHit()) {

} else {

}
