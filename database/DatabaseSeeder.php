<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 07/02/2018
 * Time: 12:49
 */

require_once __DIR__ . '/../vendor/fzaninotto/faker/src/autoload.php';
require_once __DIR__ . '/../src/models/User.php';
require_once __DIR__ . '/../src/models/Set.php';
require_once __DIR__ . '/../src/models/Card.php';

$faker = Faker\Factory::create("en_GB");

for ($i = 0; $i < 50; $i++)
{
    User::createUser(
        $faker->firstName(),
        $faker->lastName,
        $faker->safeEmail,
        "password",
        $faker->streetAddress,
        NULL,
        NULL,
        $faker->city,
        $faker->countryCode,
        $faker->postcode,
        $faker->phoneNumber
    );
}

Set::addSet("Dark Ascension",         "dka", 1, 0, 0);
Set::addSet("Eternal Masters",        "ema", 0, 0, 1);
Set::addSet("Modern Masters",         "mma", 0, 0, 1);
Set::addSet("Magic Origins",          "ori", 0, 1, 0);
Set::addSet("Ixalan",                 "xln", 1, 0, 0);
Set::addSet("Avacyn Restored",        "avr", 1, 0, 0);
Set::addSet("Future Sight",           "fut", 1, 0, 0);
Set::addSet("Born of the Gods",       "bng", 1, 0, 0);
Set::addSet("Dragons of Tarkir",      "dtk", 1, 0, 0);
Set::addSet("Archenemy: Nicol Bolas", "e01", 0, 0, 1);
Set::addSet("Dragon's Maze",          "dgm", 1, 0, 0);
Set::addSet("Modern Masters 2015",    "mm2", 0, 0, 1);
Set::addSet("Archenemy",              "arc", 0, 0, 1);
Set::addSet("Mirrodin",               "mrd", 1, 0, 0);
Set::addSet("New Phyrexia",           "nph", 1, 0, 0);

Card::addCard(
    1,
    "Divination",
    "2,u",
    "Draw 2 cards.",
    "Even the House of Galan, who takes the most scholarly approach to the mystic traditions, has resorted to exploring more primitive methods in Avacyn's absence.",
    "Sorcery",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    2,
    "Jace, the Mind Sculptor",
    "2,u,u",
    "+2: Look at the top card of target player's library. You may put that card on the bottom of that player's library.

0: Draw three cards, then put two cards from your hand on top of your library in any order.

-1: Return target creature to its owner's hand.

-12: Exile all cards from target player's library, then that player shuffles his or her hand into his or her library.",
    NULL,
    "Legendary Planeswalker - Jace",
    0,
    0,
    1,
    NULL,
    NULL,
    3
);

Card::addCard(
    2,
    "Counterspell",
    "u,u",
    "Counter target spell.",
    NULL,
    "Instant",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    3,
    "Progenitus",
    "w,w,u,u,b,b,r,r,g,g",
    "Protection from everything

If Progenitus would be put into a graveyard from anywhere, reveal Progenitus and shuffle it into its owner's library instead.",
    "The Soul of the World has returned.",
    "Legendary Creature - Hydra Avatar",
    0,
    0,
    1,
    10,
    10,
    NULL
);

Card::addCard(
    4,
    "Sword of the Animist",
    "2",
    "Equipped creature gets +1/+1.

Whenever equipped creature attacks, you may search your library for a basic land card, put it onto the battlefield tapped, then shuffle your library.

Equip {2}",
    "The blade glows only for Zendikar's chosen.",
    "Legendary Artifact - Equipment",
    0,
    1,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    5,
    "Tishana, Voice of Thunder",
    "5,u,g",
    "Tishana, Voice of Thunder's power and toughness are each equal to the number of cards in your hand.

You have no maximum hand size.

When Tishana enters the battlefield, draw a card for each creature you control.",
    NULL,
    "Legendary Creature - Merfolk Shaman",
    0,
    0,
    1,
    -1,
    -1,
    NULL
);

Card::addCard(
    6,
    "Tibalt, the Fiend-Blooded",
    "r,r",
    "+1: Draw a card, then discard a card at random.

-4: Tibalt, the Fiend-Blooded deals damage equal to the number of cards in target player's hand to that player.

-6: Gain control of all creatures until end of turn. Untap them. They gain haste until end of turn.",
    NULL,
    "Legendary Planeswalker - Tibalt",
    0,
    0,
    1,
    NULL,
    NULL,
    2
);

Card::addCard(
    7,
    "Dryad Arbor",
    "",
    "(Dryad Arbor isn't a spell, it's affected by summoning sickness, and it has \"{t}: Add {g} to your mana pool.\")

Dryad Arbor is green.",
    "\"Touch no tree, break no branch, and speak only the question you wish answered.\"
-Von Yomm, elder druid, to her initiates",
    "Land Creature - Forest Dryad",
    1,
    0,
    0,
    1,
    1,
    NULL
);

Card::addCard(
    8,
    "Brimaz, King of Oreskos",
    "1,w,w",
    "Vigilance

Whenever Brimaz, King of Oreskos attacks, create a 1/1 white Cat Soldier creature token with vigilance that's attacking.

Whenever Brimaz blocks a creature, create a 1/1 white Cat Soldier creature token with vigilance that's blocking that creature.",
    NULL,
    "Legendary Creature - Cat Soldier",
    0,
    0,
    1,
    3,
    4,
    NULL
);

Card::addCard(
    9,
    "Twin Bolt",
    "1,r",
    "Twin Bolt deals 2 damage divided as you choose among one or two target creatures and/or players.",
    "Kolaghan archers are trained in Dakla, the way of the bow. They utilize their dragonlord's lightning to strike their target, no matter how small, how fast, or how far away.",
    "Instant",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Lightning Bolt",
    "r",
    "Lightning Bolt deals 3 damage to target creature or player.",
    "The sparkmage shrieked, calling on the rage of the storms of his youth. To his surprise, the sky responded with a fierce energy he'd never thought to see again.",
    "Instant",
    1,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Plains",
    "",
    "({t}: Add {w} to your mana pool.)",
    NULL,
    "Basic Land - Plains",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Island",
    "",
    "({t}: Add {u} to your mana pool.)",
    NULL,
    "Basic Land - Island",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Swamp",
    "",
    "({t}: Add {b} to your mana pool.)",
    NULL,
    "Basic Land - Swamp",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Mountain",
    "",
    "({t}: Add {r} to your mana pool.)",
    NULL,
    "Basic Land - Mountain",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    10,
    "Forest",
    "",
    "({t}: Add {g} to your mana pool.)",
    NULL,
    "Basic Land - Forest",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    11,
    "Azorius Guildgate",
    "",
    "Azorius Guildgate enters the battlefield tapped.

{t}: Add {w} or {u} to your mana pool.",
    "The Azorius symbol stares down like a great eye, reminding visitors of the watchful presence of Isperia and her lawmages.",
    "Land - Gate",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    11,
    "Boros Guildgate",
    "",
    "Boros Guildgate enters the battlefield tapped.

{t}: Add {r} or {w} to your mana pool.",
    "It promises protection to those in need and proclaims a warning to any who would threaten Ravnican law.",
    "Land - Gate",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    11,
    "Maze's End",
    "",
    "Maze's End enters the battlefield tapped.

{t}: Add {c} to your mana pool.

{3}, {t}, Return Maze's End to its owner's hand: Search your library for a Gate card, put it onto the battlefield, then shuffle your library. If you control ten or more Gates with different names, you win the game.",
    NULL,
    "Land",
    0,
    0,
    1,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    12,
    "Dispatch",
    "w",
    "Tap target creature.

Metalcraft - If you control three or more artifacts, exile that creature.",
    "Venser wondered if it could still be called a teleportation spell if the destination is oblivion.",
    "Instant",
    1,
    0,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    12,
    "Blinkmoth Nexus",
    "",
    "{t}: Add {c} to your mana pool.

{1}: Blinkmoth Nexus becomes a 1/1 Blinkmoth artifact creature with flying until end of turn. It's still a land.

{1}, {t}: Target Blinkmoth creature gets +1/+1 until end of turn.",
    NULL,
    "Land",
    0,
    1,
    0,
    NULL,
    NULL,
    NULL
);

Card::addCard(
    13,
    "Selesnya Guildmage",
    "gw,gw",
    "{3}{g}: Create a 1/1 green Saproling creature token.

{3}{w}: Creatures you control get +1/+1 until end of turn.",
    "",
    "Creature - Elf Wizard",
    1,
    0,
    0,
    2,
    2,
    NULL
);

Card::addCard(
    14,
    "Dross Scorpion",
    "4",
    "Whenever Dross Scorpion or another artifact creature dies, you may untap target artifact.",
    "They skitter out of the mists to consume fresh kill before Mephidross has a chance to corrode it away.",
    "Artifact Creature - Scorpion",
    0,
    0,
    0,
    3,
    1,
    NULL
);

Card::addCard(
    15,
    "Gitaxian Probe",
    "up",
    "({up} can be paid with either {u} or 2 life.)

Look at target player's hand.

Draw a card.",
    "\"My flesh holds no secrets, monster. The spirit of Mirrodin will fight on.\"
-Vy Covalt, Mirran resistance",
    "Sorcery",
    0,
    0,
    0,
    NULL,
    NULL,
    NULL
);
