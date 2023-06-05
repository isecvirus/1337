# 1337 (v1.1.0)

=begin
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
=end

# frozen_string_literal: true

require_relative 'chars'

class L337
  def initialize(password)
    @password = password
  end

  def basic # randomly leeting password with some basic chars (See: Chars::BASIC_LEET)
    basic = Chars::BASIC_LEET
    for bk, bv in basic do
      @password = @password.downcase.gsub(bk.to_s, bv.sample)
    end
  end

  def moderate # randomly leeting password with some moderate chars (See: Chars::MODERATE_LEET)
    moderate = Chars::MODERATE_LEET
    for mk, mv in moderate do
      @password = @password.downcase.gsub(mk.to_s, mv.sample)
    end
  end

  def advance # randomly leeting password with some advance chars (See: Chars::ADVANCED_LEET)
    advance = Chars::ADVANCED_LEET
    for ak, av in advance do
      @password = @password.downcase.gsub(ak.to_s, av.sample)
    end
  end

  def currency # randomly leeting password with currency chars (See: Chars::CURRENCY_LEET)
    currency = Chars::CURRENCY_LEET
    for ck, cv in currency do
      @password = @password.downcase.gsub(ck.to_s, cv.sample)
    end
  end

  def emoji(limit = 2)
    # randomly putting LIMIT emojis (See: Chars::EMOJI_LEET)
    emoji = Chars::EMOJI_LEET

    for l in 0..(limit - 1) do
      index = rand(@password.length)
      emo = emoji.values.sample.sample

      @password = @password[0..index].to_s + emo + @password[index..-1]
    end
  end

  def entropy # Shannon entroy math calculation
    # --- MEASURING ENTROPY (password randomness) ---
    charCount = Hash.new { |hash, key| hash[key] = 0 }
    entropy = 0

    for char in @password.chars do
      charCount[char] += 1
    end

    for count in charCount.values do
      freq = count.to_f / @password.length
      entropy -= freq * (Math.log(freq) / Math.log(2)) # log(2)=0.6931471805599453
    end

    entropy.round(16)
  end

  def power # gets the strength of the password
    "" "
      H = -Σ(Pi * log2(Pi))

      Entropy for 'Hello, World!' is 3.180832987205441:
        CyberChef
          https://gchq.github.io/CyberChef/#recipe=Entropy('Shannon%20scale')&input=SGVsbG8sIFdvcmxkIQ
        Dcode.fr
          https://www.dcode.fr/shannon-index
    " ""

    upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
    lower = "abcdefghijklmnopqrstuvwxyz"
    nums = "0123456789"
    puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<"

    lower_score = 2
    upper_score = 4
    nums_score = 6
    puncs_score = 8

    strength = 0
    ent = entropy

    multipliers = {
      2.0 => 0.5,
      3.0 => 0.8,
      4.0 => 0.9,
      5.0 => 0.95,
      6.0 => 0.97,
      7.0 => 0.98,
      8.0 => 0.99
    }
    
    # --- MEASURING STRENGTH ---
    @password.each_char do |char|
      strength += case
                  when lower.include?(char)
                    lower_score
                  when upper.include?(char)
                    upper_score
                  when nums.include?(char)
                    nums_score
                  when puncs.include?(char)
                    puncs_score
                  else
                    0
                  end
    end

    lengths = Hash.new { |h, k| h[k] = [Range.new(0, 0), 0] }

    (0..49).step(2) do |n|
      if Range.new(n, n + 2).include?(@password.length)
        lengths[Range.new(n, n + 2)] = 2 * n
      end
    end

    last = 0 # last value will be captured by the lengths hash
    lengths.each_key do |key|
      if key.include?(@password.length)
        last = lengths[key]
      end
    end
    strength += last

    multipliers.each do |value, multiplier|
      if ent < value
        strength = (strength * multiplier).to_i
        break
      end
    end

    strength.clamp(0, 100)
  end

  def isPower(f, t = 100)
    # checks if password strength in the range of RANGE
    Range.new(f, t).include?(self.power)
  end

  def get # gets the final password
    @password
  end
end

=begin
  passwords = ["password", "secret", "strong", "hacker", "master", "account"]

  passwords.each do |password|
    leet = L337.new(password)
    leet.basic

    puts("#{leet.power.to_s.rjust(3, ' ')} - #{leet.get}")
  end
=end