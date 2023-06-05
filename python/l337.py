# 1337 (v1.0.0)

"""
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
"""

import math
import random
from collections import defaultdict

from chars import (basic_leet, moderate_leet, advanced_leet, emoji_leet, currency_leet)


class L33T(str):
    min_level = 1
    max_level = 9

    def __init__(self, password: str = super):
        self.password: str = password

    def basic(self):
        basic = basic_leet
        for b in basic:
            self.password = self.password.lower().replace(b, random.choice(basic[b]))

    def moderate(self):
        moderate = moderate_leet
        for m in moderate:
            self.password = self.password.lower().replace(m, random.choice(moderate[m]))

    def advance(self):
        advance = advanced_leet
        for a in advance:
            self.password = self.password.lower().replace(a, random.choice(advance[a]))

    def currency(self):
        currency = currency_leet
        for c in currency:
            self.password = self.password.lower().replace(c, random.choice(currency[c]))

    def emoji(self, limit: int = 2, emo: str = None):
        emoji = emoji_leet
        for _ in range(limit):
            index = random.randint(0, len(self.password))
            emo = emo if emo is not None else random.choice(random.choice(list(emoji.values())))
            self.password = self.password[:index] + emo + self.password[index:]

    def entropy(self) -> float:
        charCount = defaultdict(int)
        entropy = 0.0
        password = self.password

        for c in password:
            charCount[c] += 1

        for count in charCount.values():
            freq = count / len(password)
            entropy -= freq * (math.log(freq) / math.log(2))  # log(2)=0.6931471805599453

        return round(entropy, 16)

    def power(self):
        strength = 0
        ent = self.entropy()
        password = self.password

        lengths = {range(i, i + 2): 2 * i for i in range(0, 50, 2)}
        multipliers = {
            2.0: 0.5,
            3.0: 0.8,
            4.0: 0.9,
            5.0: 0.95,
            6.0: 0.97,
            7.0: 0.98,
            8.0: 0.99
        }

        upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
        lower = "abcdefghijklmnopqrstuvwxyz"
        nums = "0123456789"
        puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<"
        lower_score = 2
        upper_score = 4
        nums_score = 6
        puncs_score = 8

        strength += sum([
            sum([lower_score if (char in lower) else 0 for char in password]),
            sum([upper_score if (char in upper) else 0 for char in password]),
            sum([nums_score if (char in nums) else 0 for char in password]),
            sum([puncs_score if (char in puncs) else 0 for char in password]),
        ])

        strength += sum(lengths[l] for l in lengths if len(password) in l)

        for value, multiplier in multipliers.items():
            if ent < value:
                strength = int(strength * multiplier)
                break

        return min(strength, 100)

    def isPower(self, f: int, t: int = 100):
        return self.power() in range(f, t + 1)

    def get(self):
        return self.password


"""
    passwords = ["password", "secret", "strong", "hacker", "master", "account"]

    for p in passwords:
        leet = L33T(p)
        leet.basic()

        print(f"{leet.power().__str__().rjust(3, ' ')} - {leet.get()}")
"""
