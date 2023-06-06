"use strict";
// 1337 demo (v1.0.0)
Object.defineProperty(exports, "__esModule", { value: true });
/*
The example presented in this file, isn't executed line by line..
it's executed separately.
*/
const l337_1 = require("./l337");
const password = "password";
const leet = new l337_1.L337(password);
/*
The basic() method generates a "basic leet" version of the password..
by replacing certain letters with numbers or symbols.
*/
leet.basic();
console.log(leet.get()); // p4$$w02d
/*
The moderate() method generates a "moderate leet" version of the password..
by replacing certain letters with similar-looking symbols.
*/
leet.moderate();
console.log(leet.get()); // p*ssword
/*
The advance() method generates an "advanced leet" version of the password..
by replacing certain letters with complex combinations of symbols.
*/
leet.advance();
console.log(leet.get()); // p/\|5|5|\|\o|2\_\
/*
The currency() method generates a "currency leet" version of the password..
by replacing certain letters with currency symbols.
*/
leet.currency();
console.log(leet.get()); // pa$$word
/*
The emoji() method generates an "emoji leet" version of the password by..
inserting random emoji characters into the password.
*/
leet.emoji();
console.log(leet.get()); // p🌙as👻sword
/*
The entropy() method calculates the entropy of the current password,
which measures the strength of the password based on the number of possible combinations of characters.
*/
console.log(leet.entropy()); // 2.75
/*
The power() method calculates the "password power" of the current password,
which assigns a score to the password based on its length, character composition, and entropy.
*/
console.log(leet.power()); // 25
/*
The isPower() method checks whether the password power of the current password..
falls within a given range specified by the arguments f and t.
*/
console.log(leet.isPower(45, 85)); // False
/*
password getter
*/
console.log(leet.get()); // password
