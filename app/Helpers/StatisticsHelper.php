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

    /**
     * Get column counts with percentages for statistics charts
     *
     * @param Collection $formData
     * @param array|null $fields
     * @param bool $firstAnswerOnly
     * @return array
     */
    public static function getColumnCountsWithPercentages(Collection $formData, $fields = null, $firstAnswerOnly = false): array
    {
        $counts = [];
        $percentages = [];
        $answerOptions = FormApegoEtico::getAnswerOptions();

        // If no fields specified, use all available fields
        if ($fields === null) {
            $fields = array_keys($answerOptions);
        }

        if ($firstAnswerOnly) {
            // Create dynamic arrays for each index position
            $indexArrays = [];
            $percentageArrays = [];

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
                        if (!isset($percentageArrays["index{$i}"])) {
                            $percentageArrays["index{$i}"] = [];
                        }
                    }

                    // Calculate total responses for this question
                    $totalResponses = $formData->whereNotNull($question)->count();

                    // Get counts and percentages for each index position in this question
                    for ($i = 0; $i < $numOptions; $i++) {
                        $count = $formData->where($question, $optionKeys[$i])->count();
                        $indexArrays["index{$i}"][] = $count;

                        // Calculate percentage
                        $percentage = $totalResponses > 0 ? round(($count / $totalResponses) * 100, 1) : 0;
                        $percentageArrays["index{$i}"][] = $percentage;
                    }
                }
            }

            return [
                'counts' => $indexArrays,
                'percentages' => $percentageArrays
            ];
        } else {
            // Count for each specified question column
            foreach ($fields as $question) {
                if (isset($answerOptions[$question])) {
                    $questionCounts = [];
                    $questionPercentages = [];
                    $totalResponses = $formData->whereNotNull($question)->count();

                    foreach ($answerOptions[$question] as $key => $label) {
                        $count = $formData->where($question, $key)->count();
                        $questionCounts[$key] = $count;

                        // Calculate percentage
                        $percentage = $totalResponses > 0 ? round(($count / $totalResponses) * 100, 1) : 0;
                        $questionPercentages[$key] = $percentage;
                    }
                    $counts[$question] = $questionCounts;
                    $percentages[$question] = $questionPercentages;
                }
            }

            return [
                'counts' => $counts,
                'percentages' => $percentages
            ];
        }
    }

    /**
     * Get percentages for individual questions by area
     * This calculates percentages based only on the responses for each specific question
     *
     * @param array $countsByArea
     * @param array $questions
     * @return array
     */
    public static function getQuestionPercentagesByArea(array $countsByArea, array $questions): array
    {
        $percentages = [];
        $answerOptions = FormApegoEtico::getAnswerOptions();

        foreach ($questions as $question => $options) {
            $percentages[$question] = [];

            // Calculate percentages for each option
            foreach ($options as $option) {
                $percentages[$question][$option] = [];

                // For each area, calculate the percentage
                foreach ($countsByArea as $areaId => $forms) {
                    $formsCollection = collect($forms);

                    // Count responses for this specific question and option in this area
                    $optionCount = $formsCollection->where($question, $option)->count();

                    // Count total responses for this specific question in this area
                    $totalQuestionResponses = $formsCollection->whereNotNull($question)->count();

                    // Calculate percentage based only on this question's responses
                    $percentage = $totalQuestionResponses > 0 ? round(($optionCount / $totalQuestionResponses) * 100, 1) : 0;

                    $percentages[$question][$option][$areaId] = $percentage;
                }
            }
        }

        return $percentages;
    }

    /**
     * Get percentages for individual questions by area in Chart.js format
     * This returns data organized as datasets with arrays for Chart.js compatibility
     *
     * @param array $countsByArea
     * @param array $questions
     * @param array $areaNames
     * @return array
     */
    public static function getQuestionPercentagesByAreaForCharts(array $countsByArea, array $questions, array $areaNames): array
    {
        $percentages = [];
        $answerOptions = FormApegoEtico::getAnswerOptions();

        foreach ($questions as $question => $options) {
            $percentages[$question] = [];

            // Calculate percentages for each option
            foreach ($options as $option) {
                $percentages[$question][$option] = [];

                // For each area name (in order), calculate the percentage
                foreach ($areaNames as $areaName) {
                    $forms = $countsByArea[$areaName] ?? [];
                    $formsCollection = collect($forms);

                    // Count responses for this specific question and option in this area
                    $optionCount = $formsCollection->where($question, $option)->count();

                    // Count total responses for this specific question in this area
                    $totalQuestionResponses = $formsCollection->whereNotNull($question)->count();

                    // Calculate percentage based only on this question's responses
                    $percentage = $totalQuestionResponses > 0 ? round(($optionCount / $totalQuestionResponses) * 100, 1) : 0;

                    $percentages[$question][$option][] = $percentage;
                }
            }
        }

        return $percentages;
    }
}
