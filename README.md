Brutal Idle
===========

Welcome to Brutal Idle, the **new** online MMORPG!

Well, to be honest, this game sucks, at least for now. I just needed an excuse to practice with the newest version of Symfony2 in order to get the hang of it and be able to use it in bigger projects.

Anyway, I still want to set up and build a fully working idle game: it won't exactly have a compelling gameplay, a deep storyline and so on but at leasty it will have to be playable, with its own combat system, a balanced set of different playstyles and so on.

A cool thing is that as soon as the basics of the game will be covered you will end up with a dead simple, fully functional open source server-side API able to handle nearly any type of RPG! You will just have to fork the project, change the aspect of the game you want to customize, and that's it! Free stuff for everyone! :D

# Classes
For now this game considers three base hero classes: fighter, archer and mage. I just wanted to keep everything simple. By default, at lvl. 1, fighters win against archers, archers win against mages and mages win against fighters. Pretty simple and boring. 
# Stats

The stats this game considers are the following: the basic Level/Exp/MaxExp, three main stats and six derivate stats.
### Level/Exp/MaxExp
This is dead simple. Everytime you win a fight, you earn exp. Once you reach a certain amount of exp (MaxExp) you can increase your level (if you like). When the level increases the Exp value drops to zero, the MaxExp value increases by a fixed amount and all the main stats have an increase. In this case, the absolute values of the increases are decided depending on the hero class.
### Main stats
The three main stats are **STR**, **DEX** and **MND** (int was too easy to confuse with INTeger). Every time you level up those three stats increase of a fixed amount, depending on the hero class. 
### Derivate stats
All the following stats are calculated depending on the main stats:
 * **HP** = STR * HP_COEFF, where HP_COEFF is typically 2 (for now)
 * **DMG** = Main_Stat * DMG_MAIN_STAT_COEFF. The raw damage of your hero is calculated depending on its own main stat: for fighters it will be STR, for archers is DEX and for mages is obviously MND. The coeff is just needed to balancee things out, and for now it is close to 1 for every class.
 * **Armor** = DEX * ARMOR_COEFF, where ARMOR_COEFF ranges from 0.8 to 1.2 depending on the class. It defines how many hits an hero can sustain before getting really hurt
 * **Speed** = DEX * SPEED_COEFF, where SPEED_COEFF ranges from 1 to 2 depending on the class. It decides who strikes first and how many times in each match
 * **Preempt** = MND * PREEMPT_COEFF, where PREEMPT_COEFF ranges from 1 to 1.4 depending on the class. It defines the strength of the preemptive attack performed by each hero at the beginning of each round (check the combat section to better understand this)

# Combat
As two players enters in combat, the outcome of the fight uniquely depends on the stats of the two players, there is no skill or luck involved: I know this sucks but that's just the barebone, hopefully items will spicy things up a little bit. 

A fight is pretty much what you would expect: heroes just continuously hit each other until one of the two dies. However, just to make everything a little bit more complex and entertaining to read, a fight is divided in several rounds.
Every round goes on in this way:
1. The armor value of the heroes is replenished. From now on, every damage sustained brings the Armor to zero before really hurting the heroes.
2. Depending on the Preempt values, one of the heroes hits the other before the start of the fight, and the damage sustained is equal to the difference in Preempt values between the heroes. So, if I have Preempt 1 and my enemy has Preempt 5, he hits me for 4.
3. Depending on the Speed, a hero hits the other a certain amount of times. That amount of time is given by the floor of the speed ratio among heroes: for instance, if the enemy Speed 10 and I have speed 4, floor(10/4) = floor(2.5) = 2. This means I will take two hits. The damage is exactly the DMG value
4. Finally, the slowest hero hits. The damage is exactly the DMG value

As soon as one of the two heroes sees its HP reaching zero, the fight is over.

# Items

This still needs work. Items have to make exping kinda cool, but I still have to define how

# TO-DO LIST

- [x] Setting up login/signup
- [x] Setting up character creation
- [x] Implementing the Stats system
- [x] Implementing the Fighting system
- [x] Balancing things out for this boring implementation
- [ ] Adding items and finding a way to make the game more compelling with them
- [ ] Adding some grinding/questing options
- [ ] Adding some PVP
- [ ] Adding some graphic to make everything look cooler
- [ ] Setting up a server and creating some bots playing randomly to see if things are balanced
- [ ] Adding some storyline
- [ ] Dominate the world

