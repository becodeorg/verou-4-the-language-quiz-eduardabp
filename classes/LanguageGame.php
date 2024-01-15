<?php

class LanguageGame
{
    private array $words;
    private $word;

    public function __construct()
    {
        foreach (Data::words() as $dutchTranslation => $englishTranslation) {
            $this->words[] = new Word($dutchTranslation, $englishTranslation);
        }
    }

    // generate random word
    public function randomWord () {
        $randomIndex = array_rand($this->words);
        $this->word = $this->words[$randomIndex];
        $_SESSION["Word"] = $this->word;
        return $this->word;
    }

 // increment the score
    private function incrementScore()
    {
        $_SESSION["Score"] = isset($_SESSION["Score"]) ? ($_SESSION["Score"] + 1) : 1;
    }

    // get the current score
    public function getScore()
    {
        return isset($_SESSION["Score"]) ? $_SESSION["Score"] : 0;
    }

    public function run(): void
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->word = $this->randomWord();
            $_SESSION["Word"] = $this->word;
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            if(isset($_POST["reset"])) {
                $_SESSION["Score"] = 0;
            } else {
                if ($_SESSION["Word"]->verify($_POST['player-input']) === true) {
                    echo "You did it, " . $_SESSION['Word'] . " is " . $_POST['player-input'] . "! Congratulations!<br>";
                    $this->incrementScore();
                    echo "Your score: " . $this->getScore();
                } else {
                    echo "Oh, no! That is not the correct answer. Try again!<br>";
                    echo "Your score: " . $this->getScore();
                };
                $_SESSION['Word'] = $this->randomWord();
            }
        }
    }
}