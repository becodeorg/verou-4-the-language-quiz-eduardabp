<?php

class Word
{
    private string $dutchTranslation;
    private string $englishTranslation;

    public function __construct($dutchTranslation, $englishTranslation)
    {
        $this->dutchTranslation = $dutchTranslation;
        $this->englishTranslation = $englishTranslation;
    }

    public function verify(string $answer)
    {  
        $correctAnswer = $this->englishTranslation;
        $userInput = $answer;

       if ($correctAnswer === $userInput) {
        echo "You did it! " . $this->dutchTranslation . " is " . $this->englishTranslation . ". Congratulations!";
       } else {
        echo "Oh, no! That is not the correct answer. Try again!";
       }
        // Bonus: allow answers with different casing (example: both bread or Bread can be correct answers, even though technically it's a different string)
        // Bonus (hard): can you allow answers with small typo's (max one character different)?
    }

    public function getDutchTranslation()
    {
       return $this->dutchTranslation;
    }
}
