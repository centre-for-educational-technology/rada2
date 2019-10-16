<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityItem;
use App\ActivityItemOption;
use App\Game;
use App\Options\QuestionTypeOptions;
use App\Repository\GameRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GameStatisticsController extends Controller
{

    public const P_ORDER_BY_TYPE_POINTS = 1;
    public const P_ORDER_BY_TYPE_NAME = 2;
    public const P_ORDER_BY_TYPE_TIME = 3;
    public const P_ORDER_BY_TYPE_ANSWERED = 4;
    public const P_ORDER_BY_TYPE_GRADED = 5;
    public const P_ORDER_BY_TYPE_NOT_GRADED = 6;

    public const E_ORDER_BY_TYPE_EXERCISE = 1;
    public const E_ORDER_BY_TYPE_ANSWERED = 2;
    public const E_ORDER_BY_TYPE_GRADED = 3;
    public const E_ORDER_BY_TYPE_NOT_GRADED = 4;
    public const E_ORDER_BY_TYPE_TOTAL = 5;
    public const E_ORDER_BY_TYPE_AVERAGE = 6;
    public const E_ORDER_BY_TYPE_MIN = 7;
    public const E_ORDER_BY_TYPE_MAX = 8;
    public const E_ORDER_BY_TYPE_TIME_SPENT = 9;

    public function index(Request $request, Game $game)
    {
        /** @var Activity $activity */
        $activity = $game->activity;
        /** @var BelongsToMany $exercises */
        $exercisesQuery = $activity->activityItems();

        $playersSortOrder = static::P_ORDER_BY_TYPE_POINTS;
        if ($request->get('playersSortOrder')) {
            $playersSortOrder = $request->get('playersSortOrder');
        }
        $playersSortOrderDir = 'DESC';
        if ($request->get('playersSortOrderDir')) {
            $playersSortOrderDir = $request->get('playersSortOrderDir');
        }
        $players = $this->getPlayers($game, $playersSortOrder, $playersSortOrderDir);

        $segmentType = '';
        if($request->get('segmentType')) {
            $segmentType = $request->get('segmentType');
        }

        $exerciseSortOrder = static::E_ORDER_BY_TYPE_EXERCISE;
        if ($request->get('exerciseSortOrder')) {
            $exerciseSortOrder = $request->get('exerciseSortOrder');
        }
        $exerciseSortOrderDir = 'DESC';
        if ($request->get('exerciseSortOrderDir')) {
            $exerciseSortOrderDir = $request->get('exerciseSortOrderDir');
        }

        $exercises = $this->getExercises($game, $exerciseSortOrder, $exerciseSortOrderDir);
        $totalPoints = 0;
        /** @var ActivityItem $exercise */
        foreach ($exercises as $exercise) {
            $data = json_decode($exercise->points, true);
            $points = is_array($data) ? array_sum($data) : $exercise->points;
            $totalPoints += $points;
        }

        return view('manage.game-statistics')->with([
            'game' => $game,
            'exercises' => $exercises,
            'countExercises' => $exercisesQuery->count(),
            'totalPoints' => $totalPoints,
            'players' => $players,
            'countPlayers' => count($players),
            'playersSortOrder' => $playersSortOrder,
            'playersSortOrderDir' => $playersSortOrderDir,
            'exerciseSortOrder' => $exerciseSortOrder,
            'exerciseSortOrderDir' => $exerciseSortOrderDir,
            'segmentType' => $segmentType,
            'gameOptions' => (new QuestionTypeOptions())->options()
        ]);
    }

    public function getExercises(Game $game, int $orderType, string $orderDir): ?array
    {
        switch($orderType) {
            case static::E_ORDER_BY_TYPE_EXERCISE:
                $orderBy = '`exercise` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_ANSWERED:
                $orderBy = '`answered` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_GRADED:
                $orderBy = '`graded` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_NOT_GRADED:
                $orderBy = '`not_graded` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_TOTAL:
                $orderBy = '`total` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_AVERAGE:
                $orderBy = '`average` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_MIN:
                $orderBy = '`min` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_MAX:
                $orderBy = '`max` ' . $orderDir;
                break;
            case static::E_ORDER_BY_TYPE_TIME_SPENT:
                $orderBy = '`time_spent` ' . $orderDir;
                break;
            default:
                $orderBy = '`exercise` ' . $orderDir;
        }

        return GameRepository::getExercisesForGameStatistics($game, $orderBy);
    }

    public function getPlayers(Game $game, int $orderByType, string $playersSortOrderDir): ?array
    {
        switch($orderByType) {
            case static::P_ORDER_BY_TYPE_POINTS:
                $orderBy = '`points` ' . $playersSortOrderDir;
                break;
            case static::P_ORDER_BY_TYPE_NAME:
                $orderBy = '`name` ' . $playersSortOrderDir;
                break;
            case static::P_ORDER_BY_TYPE_TIME:
                $orderBy = '`time` ' . $playersSortOrderDir;
                break;
            case static::P_ORDER_BY_TYPE_ANSWERED:
                $orderBy = '`count_answers` ' . $playersSortOrderDir;
                break;
            case static::P_ORDER_BY_TYPE_GRADED:
                $orderBy = '`graded` ' . $playersSortOrderDir;
                break;
            case static::P_ORDER_BY_TYPE_NOT_GRADED:
                $orderBy = '`not_graded` ' . $playersSortOrderDir;
                break;
            default:
                $orderBy = '`points` ' . $playersSortOrderDir;
        }

        return GameRepository::getPlayersForGameStatistics($game, $orderBy);
    }


    /**
     * @param QuestionTypeOptions $questionTypeOptions
     * @param Game $game
     * @return StreamedResponse
     * @throws Exception
     */
    public function export(QuestionTypeOptions $questionTypeOptions, Game $game): StreamedResponse
    {
        $questionTypeOptionsArray = $questionTypeOptions->options();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $columnNames = [
            'A' => 'Username',
            'B' => 'Task name',
            'C' => 'Question type (task type)',
            'D' => 'Manual Grading',
            'E' => 'Answer',
            'F' => 'Flash exercise',
            'G' => 'Time limit',
            'H' => 'Possible points',
            'I' => 'Points awarded',
            'J' => 'Location',
            'K' => 'Time of the answer'
        ];
        foreach ($columnNames as $key => $value) {
            $sheet->setCellValue($key . '1', $value);
        }

        $sql = '
        SELECT IF( `u`.`id` IS NOT NULL,  `u`.`name`, `g`.`nickname` ) AS `A`,
               `ai`.`title` AS `B`,
               `ai`.`type` AS `C`,
               IF( `ai`.`points` IS NULL OR `ai`.`type` = 4 OR `ai`.`type` = 6 OR `ai`.`type` = 7, 1, 0 ) AS `D`,
               `ga`.`answer` AS `E`,
               `ai`.`is_flash` AS `F`,
               IF( `ai`.`answering_time` > 0, 1, 0 ) AS `G`,
               `ai`.`points` AS `H`,
               `ga`.`grade` AS `I`,
               CONCAT( `ai`.`latitude`, \', \', `ai`.`longitude` ) AS `J`,
               `ga`.`created_at` AS `K`,
               `ai`.`missing_word`
          FROM `game_answers` AS `ga`
          JOIN `activity_items` AS `ai` ON `ai`.`id` = `ga`.`activity_item_id`
          JOIN `games` AS `g` ON `g`.`id` = `ga`.`game_id`
          LEFT JOIN `users` AS `u` ON `u`.`id` = `g`.`user_id`
         WHERE `g`.`id` = "'.$game->id.'"
        ';
        $results = DB::select($sql);

        foreach ($results as $index => $row) {
            foreach ($row as $key => $value) {
                if ($key === 'missing_word') {
                    continue;
                }
                switch ($key) {
                    case 'C':
                        $value = $questionTypeOptionsArray[$value];
                        break;
                    case 'D':
                        $data = json_decode($row->E, true);
                        $text = $data['text'] ?? false;
                        if ((int) $row->C === 8) {
                            $value = $row->missing_word !== $text ? 1 : $value;
                        } else if ((int) $row->C !== 1 && $row->H === '0') {
                            $value = 1;
                        }
                        break;
                    case 'E':
                        $data = json_decode($value, true);
                        $options = $data['options'] ?? false;
                        $text = $data['text'] ?? false;
                        if ($options !== false) {
                            $value = '';
                            foreach ($options as $optionId) {
                                /** @var ActivityItemOption $option */
                                $option = ActivityItemOption::find($optionId);
                                if ($option) {
                                    $value = $value === '' ? '' : $value . ', ';
                                    $value .= $option->option;
                                }
                            }
                        } else {
                            $value = $text !== false ? $text : $value;
                        }
                        break;
                    case 'H':
                        $data = json_decode($value, true);
                        $value = is_array($data) ? array_sum($data) : $value;
                        break;
                }

                $sheet->setCellValue($key . ($index + 2), ''.$value);
            }
        }

        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(static function () use ($spreadsheet) {

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');

        });

        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="playing-data.xlsx"');
        return $streamedResponse->send();
    }
}