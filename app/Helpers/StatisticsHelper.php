<?php

namespace App\Helpers;

use App\Models\FormApegoEtico;
use Illuminate\Support\Collection;

class StatisticsHelper
{
    /**
     * Get column counts for statistics charts
     *
     * @param Collection $formData
     * @param array|null $fields
     * @param bool $firstAnswerOnly
     * @return array
     */
    public static function getColumnCounts(Collection $formData, $fields = null, $firstAnswerOnly = false): array
    {
        $counts = [];
        $answerOptions = FormApegoEtico::getAnswerOptions();

        // If no fields specified, use all available fields
        if ($fields === null) {
            $fields = array_keys($answerOptions);
        }

        if ($firstAnswerOnly) {
            // Create dynamic arrays for each index position
            $indexArrays = [];

            foreach ($fields as $question) {
                if (isset($answerOptions[$question])) {
                    $options = $answerOptions[$question];
                    $optionKeys = array_keys($options);
                    $numOptions = count($optionKeys);

                    // Initialize arrays for each index if not exists
                    for ($i = 0; $i < $numOptions; $i++) {
                        if (!isset($indexArrays["index{$i}"])) {
                            $indexArrays["index{$i}"] = [];
                        }
                    }

                    // Get counts for each index position in this question
                    for ($i = 0; $i < $numOptions; $i++) {
                        $count = $formData->where($question, $optionKeys[$i])->count();
                        $indexArrays["index{$i}"][] = $count;
                    }
                }
            }

            return $indexArrays;
        } else {
            // Count for each specified question column
            foreach ($fields as $question) {
                if (isset($answerOptions[$question])) {
                    $questionCounts = [];
                    foreach ($answerOptions[$question] as $key => $label) {
                        $count = $formData->where($question, $key)->count();
                        $questionCounts[$key] = $count;
                    }
                    $counts[$question] = $questionCounts;
                }
            }

            return $counts;
        }
    }


}
