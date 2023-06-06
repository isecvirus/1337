// 1337 (v1.0.0)

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.L337 = void 0;

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

const basic = require('./leet_chars/basic_leet.json');
const moderate = require('./leet_chars/moderate_leet.json');
const advanced = require('./leet_chars/advanced_leet.json');
const currency = require('./leet_chars/currency_leet.json');
const emoji = require('./leet_chars/emoji_leet.json');

class L337 {
    constructor(password) {
        this.password = password;
    }

    basic() {
        for (const b in basic) {
            let rand_basic = basic[b][Math.floor(Math.random() * basic[b].length)];
            const regex = RegExp(b, "g");
            this.password = this.password.replace(regex, rand_basic);
        }
    }

    moderate() {
        for (const m in moderate) {
            let rand_moderate = moderate[m][Math.floor(Math.random() * moderate[m].length)];
            const regex = RegExp(m, "g");
            this.password = this.password.replace(regex, rand_moderate);
        }
    }

    advance() {
        for (const a in advanced) {
            let rand_advanced = advanced[a][Math.floor(Math.random() * advanced[a].length)];
            const regex = RegExp(a, "g");
            this.password = this.password.replace(regex, rand_advanced);
        }
    }

    currency() {
        for (const c in currency) {
            let rand_currency = currency[c][Math.floor(Math.random() * currency[c].length)];
            const regex = RegExp(c, "g");
            this.password = this.password.replace(regex, rand_currency);
        }
    }

    emoji(limit = 2) {
        for (let e = 0; e < limit; e++) {
            let emojis = Object.values(emoji).flat();
            let random_emoji = emojis[Math.floor(Math.random() * emojis.length)];
            let random_index = Math.floor(Math.random() * this.password.length);
            this.password = this.password.slice(0, random_index) + random_emoji + this.password.slice(random_index, this.password.length);
        }
    }

    entropy() {
        let charCount = {};
        let entropy = 0.0;
        for (const [index, char] of this.password.split("").entries()) {
            if (Object.keys(charCount).includes(char)) {
                charCount[char] += 1;
            }
            else {
                charCount[char] = 1;
            }
        }
        for (let [index, count] of Object.values(charCount).entries()) {
            const freq = count / this.password.length;
            entropy -= freq * (Math.log(freq) / Math.log(2));
        }
        return entropy.toFixed(16);
    }

    power() {
        /*
        H = -Σ(Pi * log2(Pi))
        
        Entropy for 'Hello, World!' is 3.180832987205441:
            CyberChef
                https://gchq.github.io/CyberChef/#recipe=Entropy('Shannon%20scale')&input=SGVsbG8sIFdvcmxkIQ
            Dcode.fr
                https://www.dcode.fr/shannon-index
        */
        const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lower = "abcdefghijklmnopqrstuvwxyz";
        const nums = "0123456789";
        const puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<";
        const lower_score = 2;
        const upper_score = 4;
        const nums_score = 6;
        const puncs_score = 8;
        let strength = 0;
        let ent = this.entropy();
        const multipliers = {
            2.0: 0.5,
            3.0: 0.8,
            4.0: 0.9,
            5.0: 0.95,
            6.0: 0.97,
            7.0: 0.98,
            8.0: 0.99
        };
        for (const [index, char] of this.password.split("").entries()) {
            switch (true) {
                case lower.includes(char):
                    strength += lower_score;
                    break;
                case upper.includes(char):
                    strength += upper_score;
                    break;
                case nums.includes(char):
                    strength += nums_score;
                    break;
                case puncs.includes(char):
                    strength += puncs_score;
                    break;
                default:
                    strength += 0;
                    break;
            }
        }
        for (let i = 0; i < 50; i += 2) {
            const password_length = this.password.length;
            if (i <= password_length && password_length <= i + 1) {
                strength += 2 * i;
            }
        }
        for (const [value, multiplier] of Object.entries(multipliers)) {
            if (ent < value) {
                strength = Number(strength * multiplier);
                break;
            }
        }
        return Math.floor(Math.min(strength, 100));
    }

    isPower(f, t = 100) {
        const power = this.power();
        return f <= power && power <= t;
    }

    get() {
        return this.password;
    }
}
exports.L337 = L337;