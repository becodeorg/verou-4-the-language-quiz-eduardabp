<?php

class LanguageGame
{
    private array $words;
    private string $word;

    public function __construct()
    {
        foreach (Data::words() as $dutchTranslation => $englishTranslation) {
            // TODO: create instances of the Word class to be added to the words array
            $this->words[] = new Word($dutchTranslation, $englishTranslation);
        }
    }

    // generate random word
    public function randomWord () {

    }

    public function run(): void
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->word = $this->randomWord();
            $_SESSION["Word"] = $this->word;
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            $_SESSION["Word"]->verify($_POST['player-answer']);
            $_SESSION['Word'] = $this->randomWord();
        }
    }
}