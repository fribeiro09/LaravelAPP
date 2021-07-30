<?php

namespace App\Http\Controllers;

class TesteController extends Controller
{
/*

Programming Test #1
Pig Latin Translator

---- Description ----
An ancient language was recently uncovered which appears to be a close English language derivative. A group of researchers requires a program to translate English into this ancient text. The rules to translate any sentence in English to this foregin language are listed below. Translation rules

1. If a word has no letters, don't translate it.

2. All punctuation should be preserved.

3. If the word begins with a capital letter, then the translated word should too.

4. Separate each word into two parts. The first part is called the “prefix” and extends from the beginning of the word up to, but not including, the first vowel. (The letter “y” will be considered a vowel.) The Rest of the word is called the “stem.”

5. The translated text is formed by reversing the order of the prefix and stem and adding the letters “ay” to the end. For example, “sandwich” is composed of “s” + “andwich” + “ay” + “.” and would translate to “andwichsay.”

6. If the word contains no consonants, let the prefix be empty and the word be the stem. The word ending should be “yay” instead of merely “ay.” For example, “I” would be “Iyay.”

---- Assignment ----
Your task is to write a simple program to perform basic English to foreign language translation.
Your program can accept inputs from the user in any format you prefer.

---- Sample session ----
--> Stop
Opstay

--> No littering
Onay itteringlay

--> No persons under 14 admitted
Onay ersonspay underay 14 admitteday

--> No shirts, no shoes, no service
Onay irtsshay, onay oesshay, onay ervicesay

--> Hey buddy, get away from my car!
Eyhay uddybay, etgay awayay omfray ymay arcay!
*/

    public function translator($text) {
        $words = explode(' ', $text);
        $result = '';
        foreach ($words as $word) {
            //STEP 1
            if (is_numeric($word)) {
                $result = $result . ' ' . $word . ' ';
            } else {
                //STEP 2
                $hasPuntuation = $this->hasPuntuation($word);
                $punctuation = '';
                if ($hasPuntuation == 0) {
                    $punctuation = substr($word, 0, 1);
                    $word = substr($word, 1);
                } else if ($hasPuntuation > 0) {
                    $punctuation = substr($word, $hasPuntuation);
                    $word = substr($word, 0, $hasPuntuation);
                }

                //STEP 3
                $isUppercase = ctype_upper($word[0]);
                $word = strtolower($word);

                //STEPS 4, 5 AND 6
                $firstVowelPos = $this->getFirstVowel($word);
                $hasConsonant = $this->hasConsonant($word);
                $wordSize = strlen($word);

                $prefix = $hasConsonant == true ? substr($word, 0, $firstVowelPos) : 'y';
                $stem = substr($word, $firstVowelPos - $wordSize);
                $suffix = 'ay';
                $word = $stem . $prefix . $suffix;

                if ($isUppercase) {
                    $word = ucwords($word);
                }

                $word = $hasPuntuation == 0 ?  $punctuation . $word : $word . $punctuation;

                $result = $result . ' ' . $word . ' ';
            }
        }

        return $result;
    }

    public function hasPuntuation($word) {
        $punctuations = array(',','.',';',':','!','?');
        foreach ($punctuations as $punctuation) {
            if (str_contains($word, $punctuation)) {
                return strpos($word, $punctuation);
            }
        }
        return -1;
    }

    public function getFirstVowel($word) {
        $vowels = array('a','e','i','o','u','y');
        $letters = str_split($word);
        $res = array_intersect($letters, $vowels);
        if (count($res) > 0) {
            $res = reset($res);
            return strpos($word, $res[0]);
        }
        return 0;
    }

    public function hasConsonant($word) {
        $consonants = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z');
        foreach ($consonants as $consonant) {
            if (str_contains($word, $consonant)) {
                return true;
            }
        }
        return false;
    }

}

