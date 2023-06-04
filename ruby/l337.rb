# frozen_string_literal: true

require_relative 'chars'

def entropy(password)
  # --- MEASURING ENTROPY (password randomness) ---
  charCount = Hash.new { |hash, key| hash[key] = 0 }
  entropy = 0

  for char in password.chars do
    charCount[char] += 1
  end

  for count in charCount.values do
    freq = count.to_f / password.length
    entropy -= freq * (Math.log(freq) / Math.log(2)) # log(2)=0.6931471805599453
  end

  entropy
end

class L337
  def initialize(password)
    @password = password
  end

  def basic
    basic = Chars::BASIC_LEET
    for bk, bv in basic do
      @password = @password.downcase.gsub(bk.to_s, bv.sample)
    end
  end

  def moderate
    moderate = Chars::MODERATE_LEET
    for mk, mv in moderate do
      @password = @password.downcase.gsub(mk.to_s, mv.sample)
    end
  end

  def advance
    advance = Chars::ADVANCED_LEET
    for ak, av in advance do
      @password = @password.downcase.gsub(ak.to_s, av.sample)
    end
  end

  def currency
    currency = Chars::CURRENCY_LEET
    for ck, cv in currency do
      @password = @password.downcase.gsub(ck.to_s, cv.sample)
    end
  end

  def emoji(limit = 2)
    emoji = Chars::EMOJI_LEET

    for l in 0..(limit - 1) do
      index = rand(@password.length)
      emo = emoji.values.sample.sample

      @password = @password[0..index].to_s + emo + @password[index..-1]
    end
  end

  def power
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
    ent = entropy(@password)

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

  def get
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