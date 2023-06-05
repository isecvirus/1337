# 1337 demo (v1.0.0)

=begin
The example presented in this file, isn't executed line by line..
it's executed separately.
=end

# frozen_string_literal: true

require_relative 'L337'


password = "password"
leet = L337.new(password)

"""
The basic() method generates a 'basic leet' version of the password..
by replacing certain letters with numbers or symbols.
"""
leet.basic
puts(leet.get) # p4$$w02d

"""
The moderate() method generates a 'moderate leet' version of the password..
by replacing certain letters with similar-looking symbols.
"""
leet.moderate
puts(leet.get) # p*ssword

"""
The advance() method generates an 'advanced leet' version of the password..
by replacing certain letters with complex combinations of symbols.
"""
leet.advance
puts(leet.get) # p/\|5|5|\|\o|2\_\

"""
The currency() method generates a 'currency leet' version of the password..
by replacing certain letters with currency symbols.
"""
leet.currency
puts(leet.get) # pa$$word

"""
The emoji() method generates an 'emoji leet' version of the password by..
inserting random emoji characters into the password.
"""
leet.emoji
puts(leet.get) # p🌙as👻sword

"""
The entropy() method calculates the entropy of the current password,
which measures the strength of the password based on the number of possible combinations of characters.
"""
puts(leet.entropy) # 2.75

"""
The power() method calculates the 'password power' of the current password,
which assigns a score to the password based on its length, character composition, and entropy.
"""
puts(leet.power) # 25

"""
The isPower() method checks whether the password power of the current password..
falls within a given range specified by the arguments f and t.
"""
puts(leet.isPower(45, 85)) # False

"""
password getter
"""
puts(leet.get) # password