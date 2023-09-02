# 👨🏽‍💻 1337 (v1.1.0)
1337 is a password leeting tool that can be used to swap and manipulate passwords as a "slang password" like "$1@/~\9" which means "slang". it can be used to leet passwords for bruteforce attacks

# 📊 Progress tracking
|⚙️| Language            | Version    | Completion   | Contributers  | Latest Update |
|---|:------------------:|:----------:|:------------:|:--------------:|:------------:|
|✅| Ruby 3.2.2          | 1.0.0     | 100%          | virus         |
|✅| Python 3.10.11      | 1.1.0     | 100%          | virus         | 2023-08-09
|✅| Java 20             | 1.0.0     | 100%          | virus         |
|✅| Typescript 10.9.1   | 1.0.0     | 100%          | virus         |
|✅| Javascript 18.16.0  | 1.0.0     | 100%          | virus         |
|✅| Kotlin 1.8.22       | 1.0.0     | 100%          | virus         |
|➖| Julia 1.9.1         | 1.0.0     | 65%           | virus         |
|❌| Go 1.20.5           |           | 10%           | virus         |
|❌| C 12.2.0            |           | 2%            | virus         |
|❌| Php 0.0.0           |           | 0%            |               |
|❌| Swift 0.0.0         |           | 0%            |               |
|❌| Dart 0.0.0          |           | 0%            |               |

# 💭 Upcoming features
- **update** method to update the password.
```ruby
password = "password"
leet = L337.new(password)

puts leet.get # password

leet.update("new_password")

puts leet.get # new_password
```

- **reset** method to reset the password to it's original.
```ruby
leet.reset

puts leet.get # password
```

- **custom** method to pass a custom leet chars
```ruby
"""
w=write
a=append
r=remove
e=erase
"""

# write
leet.custom({
    :o => ['0'],
    :i => ['1', '!'],
    :l => ['1', '!'],
    :r => ['2'],
    :e => ['3'],
    :s => ['5', '$'],
    :b => ['6', '8'],
    :t => ['7'],
    :g => ['9'],
    :a => ['@', '4']
  }, "w")

# append
leet.custom({:o => ['0']}, "a")

# remove
leet.custom(:b => ['6', '8'], "r")

# erase
leet.custom("e")

# Apply the custom chars on the password:
leet.custom()
```

- **char** method to get the current used chars.
```ruby
class CHAR
  BASIC = "basic"
  MODERATE = "moderate"
  ADVANCE = "advance"
  CURRENCY = "currency"
  EMOJI = "emoji"
  CUSTOM = "custom"
end

leet.char(CHAR.EMOJI)
```
# 👷🏽‍♂️ Open for contribution

# 🛠️ Bug fixes
🪰
