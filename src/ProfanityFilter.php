<?php

namespace LakshanJS\ProfanityFilter;

class ProfanityFilter
{
    private $badWords = [];
    private $exclusions = [];
    private $replacementChar = '*';
    private $partialMatch = false;

    // Set the list of bad words
    public function setBadWords(array $words)
    {
        $this->badWords = $words;
    }

    // Add a single word to the list of bad words
    public function addBadWord($word)
    {
        $this->badWords[] = $word;
    }

    // Set the replacement character for censored words
    public function setReplacementChar($char)
    {
        $this->replacementChar = $char;
    }

    // Enable or disable partial matching of words
    public function setPartialMatch($enable)
    {
        $this->partialMatch = $enable;
    }

    // Set a list of exclusion words that should not be censored
    public function setExclusions(array $words)
    {
        $this->exclusions = $words;
    }

    // Load bad words from a text file, one word per line
    public function loadBadWordsFromFile($filePath)
    {
        $this->badWords = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    // Censor profanities in a given text
    public function censor($text)
    {
        foreach ($this->badWords as $word) {
            // Skip words in the exclusion list
            if (!in_array(strtolower($word), array_map('strtolower', $this->exclusions))) {
                // Use regex for whole word or partial match based on setting
                $pattern = $this->partialMatch ? '/' . preg_quote($word, '/') . '/i' : '/\b' . preg_quote($word, '/') . '\b/i';
                $replacement = str_repeat($this->replacementChar, strlen($word));
                $text = preg_replace($pattern, $replacement, $text);
            }
        }
        return $text;
    }

    // Add a word to the exclusion list
    public function addExclusion($word)
    {
        $this->exclusions[] = $word;
    }

}
