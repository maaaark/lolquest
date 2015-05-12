<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new RefreshDaily);
Artisan::add(new RefreshLadder);
Artisan::add(new RefreshItems);
Artisan::add(new RefreshChampions);
Artisan::add(new RefreshQuestamount);
Artisan::add(new RefreshTimeline);
Artisan::add(new RefreshDonators);
Artisan::add(new RefreshTeams);
Artisan::add(new RefreshAchievements);
Artisan::add(new RefreshUserSupporter);
Artisan::add(new RefreshUserChallenges);
Artisan::add(new RefreshDailyProgress);
Artisan::add(new RefreshTotalExp);
Artisan::add(new Custom);

