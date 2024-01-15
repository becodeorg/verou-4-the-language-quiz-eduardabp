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

    public function run(): void
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->word = $this->randomWord();
            $_SESSION["Word"] = $this->word;
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($_SESSION["Word"]->verify($_POST['player-input']) === true) {
                echo "You did it, " . $_SESSION['Word'] . " is " . $_POST['player-input'] . "! Congratulations!";
            } else {
                echo "Oh, no! That is not the correct answer. Try again!";
            };
            $_SESSION['Word'] = $this->randomWord();
        }
    }
}