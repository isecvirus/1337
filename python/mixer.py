# Mixer (v1.0.0)

"""
This script can be used to mix target informations to..
.. make a list of passwords for bruteforce attacks, and etc.

If you have any idea or even better approches to tell me..
.. just make an issue and i'll consider revewing it.
"""

import random


class Mixer:

    def __init__(self, wordslist: list, level: int, verbose: bool = False):
        self.wordslist = wordslist
        self.level = level
        self._verbose_ = verbose
        self.Words = []
        self.min_level = 1
        self.max_level = 12

    def verbose(self, data):
        if self._verbose_:
            print(data)

    def generate(self):
        for parent_word in self.wordslist:
            get_len = len(parent_word)

            for child_word in self.wordslist:
                # level (1)
                # just combines them
                if level == 1 or level > 0:
                    self.verbose("Level 1 in progress..")
                    word = child_word + parent_word
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    word = parent_word + child_word
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    #######################

                # level (2)
                # cut from the first of word length
                if level == 2 or level > 1:
                    self.verbose("Level 2 in progress..")
                    word = parent_word[:-1] + child_word + parent_word[-1:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    #####################################

                # level (3)
                # cut from the second & third of word length
                if level == 3 or level > 2:
                    self.verbose("Level 3 in progress..")
                    word = parent_word[0:get_len // 2] + child_word + parent_word[get_len // 2:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    word = parent_word[0:get_len // 3] + child_word + parent_word[get_len // 3:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (4)
                # cut from the fourth & fifth of word length
                if level == 4 or level > 3:
                    self.verbose("Level 4 in progress..")
                    word = parent_word[0:get_len // 4] + child_word + parent_word[get_len // 4:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    word = parent_word[0:get_len // 5] + child_word + parent_word[get_len // 5:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (5)
                # cut from the sixth & seventh of word length
                if level == 5 or level > 4:
                    self.verbose("Level 5 in progress..")
                    word = parent_word[0:get_len // 6] + child_word + parent_word[get_len // 6:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    word = parent_word[0:get_len // 7] + child_word + parent_word[get_len // 7:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (6)
                # cut from the eighth of word length
                if level == 6 or level > 5:
                    self.verbose("Level 6 in progress..")
                    word = parent_word[0:get_len // 8] + child_word + parent_word[get_len // 8:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (7)
                # reverses the parent word
                if level == 7 or level > 6:
                    self.verbose("Level 7 in progress..")
                    word = parent_word[::-1][0:get_len // 2] + child_word + parent_word[::-1][get_len // 2:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (8)
                # reverses the child word
                if level == 7 or level > 6:
                    self.verbose("Level 8 in progress..")
                    word = parent_word[0:get_len // 2] + child_word[::-1] + parent_word[get_len // 2:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                # level (9)
                # reverses the parent & child word
                if level == 7 or level > 6:
                    self.verbose("Level 9 in progress..")
                    word = parent_word[::-1][0:get_len // 2] + child_word[::-1] + parent_word[::-1][get_len // 2:]
                    if word not in self.Words:
                        self.verbose(word)
                        self.Words.append(word)
                    ######################################################

                if level < self.min_level or level > self.max_level:
                    raise ValueError(
                        "minimum level is '%s' and maximum level is '%s' and '%s' is not a valid level." % (
                            self.max_level, self.min_level, self.level))
                elif len(self.wordslist) < 2:
                    raise ValueError("Can't mix '%s' word(s)." % len(self.wordslist))
        return self.Words

    def save(self, filename):
        with open(filename, "w") as passwords_out:
            passwords_out.write("\n".join(self.Words))
        passwords_out.close()
        return True

    def length(self):
        return len(self.Words)

    def include(self, word):
        return word in self.Words

    def add(self, word):
        if word not in self.Words:
            self.Words.append(word)
            return True

    def remove(self, word):
        if word in self.Words:
            self.Words.remove(word)
            return True

    def shuffle(self):
        random.shuffle(self.Words)

    def shake(self):
        random.shuffle(self.Words)
