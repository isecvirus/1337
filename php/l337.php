<?php
// 1337 (v1.0.0)

/*
Copyright (c) 2023 Virus. All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice,
   this list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice,
   this list of conditions and the following disclaimer in the documentation
   and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

include "chars.php";

class L337 {
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $password_copy;

    /**
     * @var array[]
     */
    private $basic_leet;
    /**
     * @var array[]
     */
    private $moderate_leet;
    /**
     * @var array[]
     */
    private $advanced_leet;
    /**
     * @var array[]
     */
    private $currency_leet;
    /**
     * @var array[]
     */
    private $emoji_leet;

    public function __construct($password) {
        $this->password = $password;
        $this->password_copy = $password;

        global $basic_leet, $moderate_leet, $advance_leet, $currency_leet, $emoji_leet;

        $this->basic_leet = $basic_leet;
        $this->moderate_leet = $moderate_leet;
        $this->advanced_leet = $advance_leet;
        $this->currency_leet = $currency_leet;
        $this->emoji_leet = $emoji_leet;
    }

    public function basic() {
        $basic = $this->basic_leet;

        foreach ($basic as $char => $list) {
            $this->password_copy = str_replace($char, $list[array_rand($list)], $this->password_copy);
        }
    }

    public function moderate() {
        $moderate = $this->moderate_leet;

        foreach ($moderate as $char => $list) {
            $this->password_copy = str_replace($char, $list[array_rand($list)], $this->password_copy);
        }
    }

    public function advance() {
        $advance = $this->advanced_leet;

        foreach ($advance as $char => $list) {
            $this->password_copy = str_replace($char, $list[array_rand($list)], $this->password_copy);
        }
    }

    public function currency() {
        $currency = $this->currency_leet;

        foreach ($currency as $char => $list) {
            $this->password_copy = str_replace($char, $list[array_rand($list)], $this->password_copy);
        }
    }

    public function entropy(): Float {
        $charCount = array();
        $entropy = 0.0;

        foreach (str_split($this->password_copy) as $char) {
            $charCount[$char] = isset($charCount[$char]) ? $charCount[$char] + 1 : 1;
        }

        foreach (array_values($charCount) as $count) {
            $freq = (Float) $count / count(str_split($this->password_copy));
            $entropy -= $freq * (log($freq) / log(2.0));
        }

        return $entropy;
    }

    public function power(): int {
        /*
            H = -Σ(Pi * log2(Pi))

            Entropy for 'Hello, World!' is 3.180832987205441:
                CyberChef
                    https://gchq.github.io/CyberChef/#recipe=Entropy('Shannon%20scale')&input=SGVsbG8sIFdvcmxkIQ
                Dcode.fr
                    https://www.dcode.fr/shannon-index
        */

        $strength = 0;
        $ent = $this->entropy();
        $multipliers = [
            2.0 => 0.5,
            3.0 => 0.8,
            4.0 => 0.9,
            5.0 => 0.95,
            6.0 => 0.97,
            7.0 => 0.98,
            8.0 => 0.99,
        ];

        $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $lower = "abcdefghijklmnopqrstuvwxyz";
        $nums = "0123456789";
        $puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<";

        $upper_score = 4;
        $lower_score = 2;
        $nums_score = 6;
        $puncs_score = 8;

        $password = $this->password_copy;

        foreach (str_split($password) as $char) {
            switch ($char) {
                case strpos($upper, $char):
                    $strength += $upper_score;
                case strpos($lower, $char):
                    $strength += $lower_score;
                case strpos($nums, $char):
                    $strength += $nums_score;
                case strpos($puncs, $char):
                    $strength += $puncs_score;
                default:
                    $strength += 0;
            }
        }

        $lengths = array();
        for ($i=0;$i<50;$i+=2) {
            $range = range($i, $i+2);
            $lengths[$range] = 2*$i;
        }

        foreach ($lengths as $range => $more_strength) {
            if (in_array(count(str_split($password)), array($range))) {
                $strength += $more_strength;
            }
        }

        foreach ($multipliers as $value => $multiplier) {
            if ($ent < $value) {
                $strength = (int) ($strength * $multiplier);
                break;
            }
        }

        return $strength;
    }

    // parse new password
    public function update($new_password) {
        $this->password = $new_password;
        $this->password_copy = $this->password;
    }

    // reset parsed password to default
    public function reset() {
        $this->password_copy = $this->password;
    }

    // used leet characters
    public function char($charType): Array {
        return Chars::get($charType);
    }

    // modified password
    public function get() {
        return $this->password_copy;
    }

    // password without modification
    public function get_default() {
        return $this->password;
    }
}

$leet = new L337("password");
//$leet->basic();

print_r("\n" . $leet->get());
print_r("\n".$leet->power());
?>
