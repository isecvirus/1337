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

import kotlin.random.Random

class L337(var password: String) {
    private val charsInstance = chars()

    fun basic() {
        val basic = charsInstance.basicLeet
        for ((char, list) in basic.entries) {
            password = password.replace(char, list[Random.nextInt(list.size)])
        }
    }

    fun moderate() {
        val moderate = charsInstance.moderateLeet
        for ((char, list) in moderate.entries) {
            password = password.replace(char, list[Random.nextInt(list.size)])
        }
    }

    fun advance() {
        val advance = charsInstance.advancedLeet
        for ((char, list) in advance.entries) {
            password = password.replace(char, list[Random.nextInt(list.size)])
        }
    }

    fun currency() {
        val currency = charsInstance.currencyLeet
        for ((char, list) in currency.entries) {
            password = password.replace(char, list[Random.nextInt(list.size)])
        }
    }

    fun emoji(limit:Int=2) {
        val emoji = charsInstance.emojiLeet
        for (i in 0 until limit) {
            val index = Random.nextInt(password.length)
            val random_emoList = emoji.values.random()
            val emo = random_emoList[Random.nextInt(random_emoList.size)]
            password = password.slice(0..index) + emo + password.slice(index+1..(password.length-1))
        }
    }

    fun entropy(): Double {
        val charCount = HashMap<Char, Int>()
        var entropy = 0.0

        for (char in password) {
            val count = charCount.getOrDefault(char, 0)
            charCount[char] = count + 1
        }

        for (count in charCount.values) {
            val freq = count.toDouble() / password.length
            entropy -= freq * (Math.log(freq) / Math.log(2.0))
        }

        return entropy
    }

    fun power(): Int {
        /*
            H = -Σ(Pi * log2(Pi))

            Entropy for 'Hello, World!' is 3.180832987205441:
                CyberChef
                    https://gchq.github.io/CyberChef/#recipe=Entropy('Shannon%20scale')&input=SGVsbG8sIFdvcmxkIQ
                Dcode.fr
                    https://www.dcode.fr/shannon-index
        */

        var strength = 0
        val ent = entropy()
        val multipliers = mapOf(
            2.0 to 0.5,
            3.0 to 0.8,
            4.0 to 0.9,
            5.0 to 0.95,
            6.0 to 0.97,
            7.0 to 0.98,
            8.0 to 0.99
        )

        val upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
        val lower = "abcdefghijklmnopqrstuvwxyz"
        val nums = "0123456789"
        val puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<"
        val lower_score = 2
        val upper_score = 4
        val nums_score = 6
        val puncs_score = 8

        password.forEach { char ->
            strength += when {
                lower.contains(char) -> lower_score
                upper.contains(char) -> upper_score
                nums.contains(char) -> nums_score
                puncs.contains(char) -> puncs_score
                else -> 0
            }
        }

        val lengthes = mutableMapOf<IntRange, Int>()
        for (i in (0 until 50).step(2)) { // can be (0 until 50).step(2)
            lengthes[i until i+2] = 2 * i
        }

        for ((range, more_strength) in lengthes.entries) {
            if (password.length in range) {
                strength += more_strength
            }
        }

        for ((value, multiplier) in multipliers) {
            if (ent < value) {
                strength = (strength * multiplier).toInt()
                break
            }
        }

        return strength.coerceAtMost(100)
    }

    fun isPower(f:Int, t:Int=100): Boolean {
        var to = t
        if (t > 100) {
            100.also { to = it }
        }
        return power() in (f until to)
    }

    fun get(): String {
        return password
    }
}
