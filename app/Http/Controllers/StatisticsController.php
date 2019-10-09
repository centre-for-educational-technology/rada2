<?php

namespace App\Http\Controllers;

use App\ActivityItemOption;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Activity;
use App\ActivityItem;
use App\Game;
use App\DiscountVoucher;

use App\Options\ZooOptions;
use App\Options\QuestionTypeOptions;
use App\Options\LanguageOptions;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StatisticsController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display statistics page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ZooOptions $zooOptions, QuestionTypeOptions $questionTypeOptions, LanguageOptions $languageOptions)
    {
        $activitiesByZoo = Activity::select('zoo', DB::raw('count(*) as count'))->groupBy('zoo')->get()->keyBy('zoo');
        $activitiesByLanguage = Activity::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $activityItemsByType = ActivityItem::select('type', DB::raw('count(*) as count'))->groupBy('type')->get()->keyBy('type');
        $activityItemsByZoo = ActivityItem::select('zoo', DB::raw('count(*) as count'))->groupBy('zoo')->get()->keyBy('zoo');
        $activityItemsByLanguage = ActivityItem::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $gamesByStatus = Game::select('complete', DB::raw('count(*) as count'))->groupBy('complete')->get()->keyBy('complete');
        $discountVouchersByStatus = DiscountVoucher::select('status', DB::raw('count(*) as count'))->groupBy('status')->get()->keyBy('status');
        $discountVouchersRedeemed = DB::table('discount_voucher_user')->count();

        return view('manage/statistics')->with([
            'users' => User::count(),
            'blockedUsers' => User::whereNotNull('blocked_at')->count(),
            'unverifiedUsers' => User::where('verified', 0)->count(),
            'activities' => Activity::count(),
            'activitiesByZoo' => $activitiesByZoo,
            'activitiesByLanguage' => $activitiesByLanguage,
            'activityItems' => ActivityItem::count(),
            'activityItemsByType' => $activityItemsByType,
            'activityItemsByZoo' => $activityItemsByZoo,
            'activityItemsByLanguage' => $activityItemsByLanguage,
            'games' => Game::count(),
            'gamesByStatus' => $gamesByStatus,
            'zooOptions' => $zooOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'discountVouchers' => DiscountVoucher::count(),
            'discountVouchersByStatus' => $discountVouchersByStatus,
            'discountVouchersRedeemed' => $discountVouchersRedeemed,
        ]);
    }

    /**
     * @param QuestionTypeOptions $questionTypeOptions
     * @return StreamedResponse
     * @throws Exception
     */
    public function export(QuestionTypeOptions $questionTypeOptions): StreamedResponse
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
