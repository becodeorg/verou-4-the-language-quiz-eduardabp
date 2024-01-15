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

    public function verify(string $answer): bool
    {  
        $correctAnswer = $this->englishTranslation;
        $userInput = $answer;

       if ($correctAnswer === $userInput) {
        return true;
       } else {
        return false;
       }
        // Bonus: allow answers with different casing (example: both bread or Bread can be correct answers, even though technically it's a different string)
        // Bonus (hard): can you allow answers with small typo's (max one character different)?
    }

    public function __toString()
    {
        return $this->dutchTranslation;
    }

    public function getDutchTranslation()
    {
       return $this->dutchTranslation;
    }
}
