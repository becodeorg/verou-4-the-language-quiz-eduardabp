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
    private function incrementScoreForRight()
    {
        $_SESSION["ScoreForRight"] = isset($_SESSION["ScoreForRight"]) ? ($_SESSION["ScoreForRight"] + 1) : 1;
    }

    private function incrementScoreForWrong()
    {
        $_SESSION["ScoreForWrong"] = isset($_SESSION["ScoreForWrong"]) ? ($_SESSION["ScoreForWrong"] + 1) : 1;
    }

    // get the current score
    public function getScoreForRight()
    {
        return isset($_SESSION["ScoreForRight"]) ? $_SESSION["ScoreForRight"] : 0;
    }

    public function getScoreForWrong()
    {
        return isset($_SESSION["ScoreForWrong"]) ? $_SESSION["ScoreForWrong"] : 0;
    }

    public function run(): void
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->word = $this->randomWord();
            $_SESSION["Word"] = $this->word;
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            if(isset($_POST["reset"])) {
                $_SESSION["ScoreForRight"] = 0;
                $_SESSION["ScoreForWrong"] = 0;
            } else {
                if ($_SESSION["Word"]->verify($_POST['player-input']) === true) {
                    echo "You did it, " . $_SESSION['Word'] . " is " . $_POST['player-input'] . "! Congratulations!<br>";
                    $this->incrementScoreForRight();
                    echo "Scoreboard:<br>Right answers: " . $this->getScoreForRight() . "<br>Wrong answers: " . $this->getScoreForWrong();
                } else {
                    echo "Oh, no! That is not the correct answer. Try again!<br>";
                    $this->incrementScoreForWrong();
                    echo "Scoreboard:<br>Right answers: " . $this->getScoreForRight() . "<br>Wrong answers: " . $this->getScoreForWrong();
                };
                $_SESSION['Word'] = $this->randomWord();
            }
        }
    }
}