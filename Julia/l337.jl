#=
l337:
- Julia version: 1.9.1
- Author: virus
- Date: 2023-06-23
=#

include("chars.jl")

struct L337 <: AbstractString
    password::String

    function L337(password::String)::L337
        new(password)
    end
end

function basic(l337::L337)
    basic = basic_leet
    new_password = lowercase(l337.password)
    for (c, vals) in basic
        new_password = replace(new_password, c => vals[rand(1:end)])
    end
    L337(new_password)
end

function moderate(l337::L337)
    moderate = moderate_leet
    new_password = lowercase(l337.password)
    for (c, vals) in moderate
        new_password = replace(new_password, c => vals[rand(1:end)])
    end
    L337(new_password)
end

function advanced(l337::L337)
    advanced = advanced_leet
    new_password = lowercase(l337.password)
    for (c, vals) in advanced
        new_password = replace(new_password, c => vals[rand(1:end)])
    end
    L337(new_password)
end

function currency(l337::L337)
    currency = currency_leet
    new_password = lowercase(l337.password)
    for (c, vals) in currency
        new_password = replace(new_password, c => vals[rand(1:end)])
    end
    L337(new_password)
end

function emoji(l337::L337, limit::Int=2)
    emoji = emoji_leet
    new_password = l337.password
    for i in 1:limit
        index = rand(1:length(l337.password))
        println(index)
        emojisList = collect(values(emoji_leet))

        random_emojisList = emojisList[rand(1:length(emojisList))]
        emo = random_emojisList[rand(1:length(random_emojisList))]

        new_password = new_password[1:index] * emo * new_password[index+1:end]
    end
    L337(new_password)
end

function get(l337::L337)
    return l337.password
end

leet = L337("password")
leet = emoji(leet, 5)
println(get(leet))