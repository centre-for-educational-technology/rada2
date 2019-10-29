<?php
/**
 * Created by PhpStorm.
 * Date: 16.10.19
 * Time: 11:18
 */

namespace App\Repository;

use App\Game;
use Illuminate\Support\Facades\DB;

class GameRepository
{
    public static function getPlayersForGameStatistics(Game $game, string $orderBy): ?array
    {
        $sql = '
        SELECT `g`.`id` as game_id,
               IF( `u`.`id` IS NOT NULL, `u`.`name`, `g`.`nickname` ) AS user_name,
               SUM(`ga`.`grade`) AS points,
               TIMEDIFF(`pp2`.`created_at`, `pp1`.`created_at`) AS time,
               (SELECT COUNT(`ga1`.`id`) FROM `game_answers` AS `ga1` WHERE `ga1`.`game_id` = `g`.`id`) AS count_answers,
               (SELECT COUNT(`aa1`.`activity_item_id`) FROM `activity_activity_item` AS `aa1` WHERE `aa1`.`activity_id` = `g`.`activity_id`) AS count_questions,
               (SELECT COUNT(`ga2`.`id`) FROM `game_answers` AS `ga2` WHERE `ga2`.`game_id` = `g`.`id` AND `ga2`.`grade` IS NOT NULL) AS graded,
               (SELECT COUNT(`ga2`.`id`) FROM `game_answers` AS `ga2` WHERE `ga2`.`game_id` = `g`.`id` AND `ga2`.`grade` IS NULL) AS not_graded
          FROM `games` AS `g`
          LEFT JOIN `users` AS `u` ON `g`.`user_id` = `u`.`id`
          LEFT JOIN `game_answers` AS `ga` ON `ga`.`game_id` = `g`.`id`
          LEFT JOIN `player_positions` AS `pp1` ON `pp1`.`game_id` = `g`.`id`
          LEFT JOIN `player_positions` AS `pp2` ON `pp2`.`game_id` = `g`.`id`
         WHERE `g`.`activity_id` = :activity_id
           AND `pp1`.`created_at` = (SELECT MIN(`pp11`.`created_at`) FROM `player_positions` AS `pp11` WHERE `pp11`.`game_id` = `g`.`id`)
           AND `pp2`.`created_at` = (SELECT MAX(`pp22`.`created_at`) FROM `player_positions` AS `pp22` WHERE `pp22`.`game_id` = `g`.`id`)
         GROUP BY `g`.`id`
         ORDER BY '.$orderBy.'
        ';
        return DB::select($sql, [
            'activity_id' => $game->activity_id
        ]);
    }

    public static function getGameDataForGameStatisticsByActivityItemId(Game $game, int $activityItemId): ?array
    {
        return DB::select('
        SELECT `ga`.`id` AS answer_id,
               `ga`.`answer`,
               `ga`.`image` AS answer_image, 
               `ga`.`updated_at` AS answer_time,
               `ga`.`grade`,
               `ai`.`is_flash`,
               `g`.`id` AS game_id,
               IF(`u`.`id` IS NOT NULL, `u`.`name`, `g`.`nickname`) AS user_name
          FROM `activity_activity_item` AS `aai`
          JOIN `activity_items` AS `ai` ON `ai`.`id` = `aai`.`activity_item_id`
          JOIN `games` AS `g` ON `g`.`activity_id` = `aai`.`activity_id`
          LEFT JOIN `game_answers` AS `ga` ON `ga`.`game_id` = `g`.`id`
          LEFT JOIN `users` AS `u` ON `u`.`id` = `g`.`user_id`
         WHERE `aai`.`activity_id` = :activity_id
           AND `aai`.`activity_item_id` = :activity_item_id
           AND `ga`.`activity_item_id` = `aai`.`activity_item_id`
        ', [
            'activity_id' => $game->activity_id,
            'activity_item_id' => $activityItemId
        ]);
    }

    public static function getExercisesForGameStatistics(Game $game, string $orderBy): ?array
    {
        return DB::select('
        SELECT `ai`.`title` AS exercise,
               `ai`.`type` AS exercise_type,
               `ai`.`is_flash`,
               `ai`.`description` AS question,
               `aai`.`activity_id`,
               `aai`.`activity_item_id` AS id,
               `ai`.`image` AS question_image,
               `ai`.`missing_word`,
               `ai`.`embedded_content`,
               IF(`ai`.`answering_time` IS NOT NULL AND `ai`.`answering_time` > 0, 1, 0) AS time_limit,
               (
                   SELECT COUNT(`ga1`.`id`) 
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`is_answered` = 1
                ) AS answered,
               (
                   SELECT COUNT(`ga1`.`id`)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NOT NULL
               ) AS graded,
               (
                   SELECT COUNT(`ga1`.`id`)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NULL
               ) AS not_graded,
               (
                   SELECT SUM(`ga1`.`grade`)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NOT NULL
               ) AS total,
               (
                   SELECT ROUND(AVG(`ga1`.`grade`),2)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NOT NULL
               ) AS average,
               (
                   SELECT MIN(`ga1`.`grade`)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NOT NULL
               ) AS min,
               (
                   SELECT MAX(`ga1`.`grade`)
                     FROM `game_answers` AS `ga1` 
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id` 
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
                      AND `ga1`.`grade` IS NOT NULL
               ) AS max,
               `ai`.`points`,
               (
                   SELECT SEC_TO_TIME(ROUND(AVG(TIMEDIFF(`ga1`.`updated_at`, `ga1`.`created_at`)), 0))
                     FROM `game_answers` AS `ga1`
                     JOIN `games` AS `g1` ON `ga1`.`game_id` = `g1`.`id`
                    WHERE `g1`.`activity_id` = `aai`.`activity_id`
                      AND `ga1`.`activity_item_id` = `aai`.`activity_item_id` 
               ) AS time_spent
          FROM `activity_activity_item` AS `aai`
          JOIN `activity_items` AS `ai` ON `ai`.`id` = `aai`.`activity_item_id`
         WHERE `aai`.`activity_id` = :activity_id
         GROUP BY `aai`.`activity_item_id`
         ORDER BY '.$orderBy.'
        ', [
            'activity_id' => $game->activity_id
        ]);
    }

    public static function getQuestionsForGameStatistics(Game $game, int $activityItemId): ?array
    {
        return DB::select('
        SELECT `aio`.`option`,
               `aio`.`correct`,
               `aio`.`image`,
               `aio`.`id`,
               `aai`.`activity_item_id`
          FROM `activity_activity_item` AS `aai`
          JOIN `activity_item_options` AS `aio` ON `aio`.`activity_item_id` = `aai`.`activity_item_id`
         WHERE `aai`.`activity_id` = :activity_id
           AND `aai`.`activity_item_id` = :activity_item_id
        ', [
            'activity_id' => $game->activity_id,
            'activity_item_id' => $activityItemId
        ]);
    }

    public static function getMatchPairsForGameStatistics(Game $game, int $activityItemId): ?array
    {
        return DB::select('
        SELECT `aip`.*
          FROM `activity_activity_item` AS `aai`
          JOIN `activity_item_pairs` AS `aip` ON `aip`.`activity_item_id` = `aai`.`activity_item_id`
         WHERE `aai`.`activity_id` = :activity_id
           AND `aai`.`activity_item_id` = :activity_item_id
        ', [
            'activity_id' => $game->activity_id,
            'activity_item_id' => $activityItemId
        ]);
    }

    public static function getPlayerPositions(Game $game): ?array
    {
        return DB::select('
        SELECT `pp`.`latitude`,
               `pp`.`longitude`,
               `pp`.`created_at`
          FROM `player_positions` AS `pp`
         WHERE `pp`.`game_id` = :game_id
        ', [
            'game_id' => $game->id
        ]);
    }

    public static function getPlayerAnswers(Game $game): ?array
    {
        return DB::select('
        SELECT `ga`.`updated_at`,
               `ga`.`id`,
               `ai`.`title`
          FROM `game_answers` AS `ga`
          JOIN `activity_items` AS `ai` ON `ai`.`id` = `ga`.`activity_item_id`
         WHERE `ga`.`game_id` = :game_id
        ', [
            'game_id' => $game->id
        ]);
    }

    public static function getAveragePositionsOfGames()
    {
        return DB::select('
        SELECT AVG(`ai`.`latitude`) AS latitude,
               AVG(`ai`.`longitude`) AS longitude,
               `a`.`title`
          FROM `activities` AS `a`
          JOIN `activity_activity_item` AS `aai` ON `aai`.`activity_id` = `a`.`id`
          JOIN `activity_items` AS `ai` ON `ai`.`id` = `aai`.`activity_item_id`
         GROUP BY `a`.`id`
        ');
    }

    public static function getTopGames(): array
    {
        return DB::select('
        SELECT `a`.`title` AS title,
               COUNT(`ga`.`id`) AS rnk
          FROM `activities` AS `a`
          JOIN `games` AS `g` ON `g`.`activity_id` = `a`.`id`
          JOIN `game_answers` AS `ga` ON `ga`.`game_id` = `g`.`id`
         GROUP BY `a`.`id`
         ORDER BY rnk DESC
         LIMIT 10
        ');
    }
}