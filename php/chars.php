<?php

# Basic leet characters
$basic_leet = [
    'o' => ['0'],
    'i' => ['1', '!'],
    'l' => ['1', '!'],
    'r' => ['2'],
    'e' => ['3'],
    's' => ['5', '$'],
    'b' => ['6', '8'],
    't' => ['7'],
    'g' => ['9'],
    'a' => ['@', '4']
];

# Moderate leet characters
$moderate_leet = [
    'c' => ['(', ')'],
    'l' => ['|'],
    'i' => ['|'],
    'f' => ['/', '\\'],
    't' => ['+'],
    'a' => ['*']
];

# Advanced leet characters
$advance_leet = [
    'h' => ['|-|'],
    'u' => ['|_|'],
    'n' => ['|\\|', '~', '/~\\'],
    'w' => ['|\\|\\', '/V\\'],
    'r' => ['|2'],
    'e' => ['|3'],
    'a' => ['|4', '/\\'],
    's' => ['|5'],
    'l' => ['|7'],
    'k' => ['|<'],
    'f' => ['|='],
    'y' => ['|>', '|?'],
    'm' => ['/_\\', '][\\//'],
    'v' => ['/|\\', '/^\\', '\\/'],
    'd' => ['\\|\\', '\\_\\'],
    'x' => ['}{', '><']
];

# Currency leet characters
$currency_leet = [
    'c' => ['¢'],
    'e' => ['€'],
    's' => ['$'],
    'y' => ['¥'],
    'i' => ['₹'],
    'l' => ['£'],
];

# Emoji leet characters
$emoji_leet = [
    'happy' => ['😀'],
    'sad' => ['😔'],
    'angry' => ['😠'],
    'laugh' => ['😂'],
    'cry' => ['😭'],
    'confused' => ['😕'],
    'surprised' => ['😲'],
    'cool' => ['😎'],
    'blush' => ['😊'],
    'heart-eyes' => ['😍'],
    'worried' => ['😟'],
    'facepalm' => ['🤦♂'],
    'sleepy' => ['😴'],
    'sick' => ['🤒'],
    'nerd' => ['🤓'],
    'crazy' => ['🤪'],
    'shocked' => ['😱'],
    'flirt' => ['😘'],
    'irritated' => ['😒'],
    'excited' => ['🤩'],
    'silly' => ['🤡'],
    'dead' => ['💀'],
    'alien' => ['👽'],
    'ghost' => ['👻'],
    'robot' => ['🤖'],
    'clown' => ['🤡'],
    'poop' => ['💩'],
    'money' => ['💰'],
    'fire' => ['🔥'],
    'thumbs-up' => ['👍'],
    'thumbs-down' => ['👎'],
    'muscle' => ['💪'],
    'broken-heart' => ['💔'],
    'heart' => ['❤'],
    'rainbow' => ['🌈'],
    'sun' => ['☀'],
    'moon' => ['🌙'],
    'star' => ['⭐'],
    'flower' => ['🌸'],
    'pizza' => ['🍕'],
    'hamburger' => ['🍔'],
    'beer' => ['🍺'],
    'cocktail' => ['🍸'],
    'coffee' => ['☕'],
    'book' => ['📖'],
    'computer' => ['💻'],
    'phone' => ['📱'],
    'tv' => ['📺'],
    'watch' => ['⌚'],
    'car' => ['🚗'],
    'plane' => ['✈'],
    'rocket' => ['🚀'],
    'football' => ['⚽'],
    'basketball' => ['🏀'],
    'tennis' => ['🎾'],
    'music' => ['🎵'],
    'guitar' => ['🎸'],
    'drum' => ['🥁'],
    'microphone' => ['🎤'],
    'movie' => ['🎥'],
    'camera' => ['📷'],
    'gift' => ['🎁'],
    'balloon' => ['🎈'],
    'party' => ['🎉'],
    'christmas-tree' => ['🎄'],
    'fireworks' => ['🎆'],
    'flag' => ['🎌'],
    'pencil' => ['✏'],
    'paintbrush' => ['🖌'],
    'scissors' => ['✂'],
    'paperclip' => ['📎'],
    'lock' => ['🔒'],
    'key' => ['🔑'],
    'lightbulb' => ['💡'],
    'battery' => ['🔋'],
    'clock' => ['🕰'],
    'stopwatch' => ['⏱'],
    'hourglass' => ['⏳'],
    'magnifying-glass' => ['🔍'],
    'microscope' => ['🔬'],
    'telescope' => ['🔭'],
    'umbrella' => ['☔'],
    'toilet' => ['🚽'],
    'shower' => ['🚿'],
    'bathtub' => ['🛁'],
    'bed' => ['🛌'],
    'couch' => ['🛋'],
    'chair' => ['🪑'],
    'lamp' => ['💡'],
    'door' => ['🚪'],
    'window' => ['🪟'],
    'plant' => ['🌿'],
    'tree' => ['🌳'],
    'cloud' => ['☁'],
    'sunrise' => ['🌅'],
    'sunset' => ['🌇'],
    'mountain' => ['⛰'],
    'beach' => ['🏖'],
    'island' => ['🏝'],
    'desert' => ['🏜'],
    'city' => ['🏙'],
    'night-sky' => ['🌃'],
    'fire-engine' => ['🚒'],
    'police-car' => ['🚓'],
    'ambulance' => ['🚑'],
    'construction' => ['🚧'],
    'traffic-light' => ['🚦'],
    'railway-car' => ['🚃'],
    'train' => ['🚂'],
    'metro' => ['🚇'],
    'bus' => ['🚌'],
    'taxi' => ['🚕'],
    'truck' => ['🚚'],
    'ship' => ['🚢'],
    'airplane' => ['✈'],
    'helicopter' => ['🚁'],
    'motorcycle' => ['🏍'],
    'bicycle' => ['🚲']
];

class Chars {
    const BASIC = 1;
    const MODERATE = 2;
    const ADVANCE = 3;
    const CURRENCY = 4;
    const EMOJI = 5;

    /**
     * @var array[]
     */
    private $basic_leet;
    /**
     * @var array[]
     */
    private $moderate_leet;
    /**
     * @var array[]
     */
    private $advanced_leet;
    /**
     * @var array[]
     */
    private $currency_leet;
    /**
     * @var array[]
     */
    private $emoji_leet;

    public static function get($char) {
        global $basic_leet, $moderate_leet, $advance_leet, $currency_leet, $emoji_leet;

        switch ($char) {
            case self::BASIC:
                return $basic_leet;
            case self::MODERATE:
                return $moderate_leet;
            case self::ADVANCE:
                return $advance_leet;
            case self::CURRENCY:
                return $currency_leet;
            case self::EMOJI:
                return $emoji_leet;
            default:
                return [];
        }
    }
}

?>