<?php

class LanguageGame
{
    private array $words;

    public function __construct()
    {
        foreach (Data::words() as $dutchTranslation => $englishTranslation) {
            // TODO: create instances of the Word class to be added to the words array
            $this->words[] = new Word($dutchTranslation, $englishTranslation);
        }
    }

    // generate random word
    public function generateRandomWord () {

    }

    public function run(): void
    {
        // TODO: check for option A or B

        // Option A: user visits site first time (or wants a new word)
        // TODO: select a random word for the user to translate

        // Option B: user has just submitted an answer
        // TODO: verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
        // TODO: generate a message for the user that can be shown

        if (empty($_POST)) {
            $this->word = $this->generateRandomWord();
            $_SESSION["Word"] = $this->word;

            // print_r($this->word);
        } else {
            if ($_SESSION["Word"]->verify($_POST['player-answer']))
            {
                echo 'correct, het antwoord was : ' . $_SESSION["Word"]->getDutchTranslation();
            } else {
                echo "fout, het antwoord was : " . $_SESSION["Word"]->getDutchTranslation();
            }
            $_SESSION['Word'] = $this->randomWord();
        }
    }
}