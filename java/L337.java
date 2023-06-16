package org.virus.l337;

import java.awt.Toolkit;
import java.awt.datatransfer.StringSelection;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Random;
import java.util.stream.IntStream;
import static org.virus.l337.chars.basic_leet;
import static org.virus.l337.chars.moderate_leet;
import static org.virus.l337.chars.advance_leet;
import static org.virus.l337.chars.currency_leet;
import static org.virus.l337.chars.emoji_leet;

/**
 *
 * @author virus
 */
public class L337 {

    static String password;

    public L337(String password) {
        this.password = password;
    }

    public void basic() {
        Map<Character, List<Character>> basic = basic_leet;
        for (Character b : basic.keySet()) {
            Character random_char = basic.get(b).get((int) (Math.random() * basic.get(b).size()));
            password = password.toLowerCase().replace(b, random_char);
        }
    }

    public void moderate() {
        Map<Character, List<Character>> moderate = moderate_leet;
        for (Character m : moderate.keySet()) {
            Character random_char = moderate.get(m).get((int) (Math.random() * moderate.get(m).size()));
            password = password.toLowerCase().replace(m, random_char);
        }
    }

    public void advance() {
        Map<Character, List<String>> advance = advance_leet;
        for (Character a : advance.keySet()) {
            String random_char = advance.get(a).get((int) (Math.random() * advance.get(a).size()));
            password = password.toLowerCase().replace(a.toString(), random_char);
        }
    }

    public void currency() {
        Map<Character, List<Character>> currency = currency_leet;
        for (Character c : currency.keySet()) {
            Character random_char = currency.get(c).get((int) (Math.random() * currency.get(c).size()));
            password = password.toLowerCase().replace(c, random_char);
        }
    }

    public void emoji(int limit) {
        for (int l = 0; l < limit; l++) {
            Map<String, List<String>> emoji = emoji_leet;

            int password_length = password.length();
            int index = (int) (Math.random() * password_length);
            String[] emo = emoji.values().stream().flatMap(List::stream).toArray(String[]::new);
            password = password.substring(0, index) + emo[new Random().nextInt(emo.length)] + password.substring(index, password_length);
            Toolkit.getDefaultToolkit().getSystemClipboard().setContents(new StringSelection(password), null);
        }
    }
    
    public int power() {
        int strength = 0;
        double ent = entropy();

        String upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        String lower = "abcdefghijklmnopqrstuvwxyz";
        String numbers = "0123456789";
        String puncs = "~`!@#$%^&*()_+=-{[]}\\|\"';:/?.>,<";

        for (char c : password.toCharArray()) {
            if (upper.indexOf(c) != -1) {
                strength += 4;
            } else if (lower.indexOf(c) != -1) {
                strength += 3;
            } else if (numbers.indexOf(c) != -1) {
                strength += 5;
            } else if (puncs.indexOf(c) != -1) {
                strength += 6;
            } else {
                strength += 1;
            }
        }

        int length = password.length();
        if (length <= 4) {
            strength += 1;
        } else if (length <= 7) {
            strength += 2;
        } else if (length <= 10) {
            strength += 3;
        } else if (length <= 15) {
            strength += 4;
        } else if (length <= 21) {
            strength += 5;
        } else if (length <= 32) {
            strength += 10;
        } else if (length <= 50) {
            strength += 15;
        } else {
            strength += 50;
        }

        if (ent < 2.0) {
            strength = (int) (strength * 0.5);
        } else if (ent < 3.0) {
            strength = (int) (strength * 0.8);
        } else if (ent < 4.0) {
            strength = (int) (strength * 0.9);
        } else if (ent < 5.0) {
            strength = (int) (strength * 0.95);
        } else if (ent < 6.0) {
            strength = (int) (strength * 0.97);
        } else if (ent < 7.0) {
            strength = (int) (strength * 0.98);
        } else if (ent < 8.0) {
            strength = (int) (strength * 0.99);
        }

        return Math.min(strength, 100);
    }
    
    public double entropy() {
        int passwordLength = password.length();
        Map<Character, Integer> charCounts = new HashMap<>();
        for (int i = 0; i < passwordLength; i++) {
            char c = password.charAt(i);
            charCounts.put(c, charCounts.getOrDefault(c, 0) + 1);
        }
        double entropy = 0.0;
        for (Map.Entry<Character, Integer> entry : charCounts.entrySet()) {
            double frequency = (double) entry.getValue() / passwordLength;
            
            // H = -Σ(Pi * log2(Pi))
            entropy -= frequency * (Math.log(frequency) / Math.log(2));
        }
        
        return Double.parseDouble(String.format("%." + 16 + "f", entropy));
    }
    
    public boolean isPower(int f, int t) {
        if (t > 100) t = 100;
        int power = power();
        
        int[] range = IntStream.rangeClosed(f, t).toArray();
        for (int r : range) {
            if (r == power) return true;
        }
        
        return false;
    }

    public String get() {
        return password;
    }
}
