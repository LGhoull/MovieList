<?php

//Testklasse - nicht zu beachten

class card {
    private $cardname;
    private $displayname;


    public function __construct($cardname, $displayname) {
        $this->cardname = $cardname;
        $this->displayname = $displayname;
    }

    public function getCardName() {
        return $this->cardname;
    }

    public function getDisplayName() {
        return $this->displayname;
    }
}

    $card1 = new card("comedy", "Komödie");

?>
