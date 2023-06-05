package org.virus.l337;

import org.virus.l337.L337;

/*
The example presented in this file, isn't executed line by line..
it's executed separately.
*/

/**
 *
 * @author virus
 */
public class demo {

    public static void main(String[] args) {
        String password = "password";
        L337 leet = new L337(password);

        /*
        The basic() method generates a "basic leet" version of the password..
        by replacing certain letters with numbers or symbols.
        */
        leet.basic();
        System.out.println(leet.get()); // p4$$w02d

        /*
        The moderate() method generates a "moderate leet" version of the password..
        by replacing certain letters with similar-looking symbols.
        */
        leet.moderate();
        System.out.println(leet.get()); // p*ssword

        /*
        The advance() method generates an "advanced leet" version of the password..
        by replacing certain letters with complex combinations of symbols.
        */
        leet.advance();
        System.out.println(leet.get()); // p/\|5|5|\|\o|2\_\

        /*
        The currency() method generates a "currency leet" version of the password..
        by replacing certain letters with currency symbols.
        */
        leet.currency();
        System.out.println(leet.get()); // pa$$word

        /*
        The emoji() method generates an "emoji leet" version of the password by..
        inserting random emoji characters into the password.
        */
        leet.emoji(2);
        System.out.println(leet.get()); // p🌙as👻sword

        /*
        The entropy() method calculates the entropy of the current password,
        which measures the strength of the password based on the number of possible combinations of characters.
        */
        System.out.println(leet.entropy()); // 2.75

        /*
        The power() method calculates the "password power" of the current password,
        which assigns a score to the password based on its length, character composition, and entropy.
        */
        System.out.println(leet.power()); // 25

        /*
        The isPower() method checks whether the password power of the current password..
        falls within a given range specified by the arguments f and t.
        */
        System.out.println(leet.isPower(45, 85)); // False
        
        /*
        password getter
        */
        System.out.println(leet.get()); // password
    }
}
