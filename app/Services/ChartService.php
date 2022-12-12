<?php

namespace App\Services;

use App\Models\Slide;


class ChartService
{
    public function getChartdata($answers)
    {
        $answersContent = $answers->pluck('content')->toArray();
        $countprogressperanswer = $answers->map(function ($answer) {
            return $answer->progress->count();
        });
        $ChartData['labels'] = $answersContent;

        $ChartData['datasets'][] = [
            'data' => $countprogressperanswer->toArray(),
            'backgroundColor' => '#FFAA33',
        ];

        $chartOptions = [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'datalabels' => [
                    'anchor' => '',
                    'align' => 'end',
                    'labels' => [
                        'value' => [
                            'color' => 'white',
                            'font' => [
                                'size' => 65,
                                'weight' => 'bold',
                            ]
                        ],
                    ]
                ],
                'title' => [
                    'display' => false,
                ],
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'enabled' => false,
                ],
            ],
            'scales' => [
                'yAxis' => [
                    'display' => false,
                ],
                'xAxis' => [
                    'display' => true,
                    'grid' => [
                        'display' => false,
                        'color' => 'white',
                        'borderColor' => 'white',
                        'borderWidth' => 4,
                    ],
                    'ticks' => [
                        'color' => 'black',
                        'font' => [
                            'size' => 30,
                            'weight' => 'bold',
                        ]
                    ],
                ],
            ]
        ];

        $data['chartData'] = $ChartData;
        $data['chartOptions'] = $chartOptions;

        return $data;
    }
}
