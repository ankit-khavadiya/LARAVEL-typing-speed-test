<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class TypingTestController extends Controller
{
    // Typing speed test blade return
    public function index()
    {
        $durations  = TEST_DURATIONS;
        $duration   = DEFAULT_TEST_DURATION;
        $wordBank   = $this->wordBank();

        return view('web.typing-test.index', compact('durations', 'duration', 'wordBank'));
    }

    // word pools the test text is built from, one per difficulty
    private function wordBank()
    {
        return [
            'easy' => [
                'the', 'and', 'for', 'you', 'say', 'but', 'his', 'her', 'all', 'one',
                'out', 'day', 'get', 'has', 'him', 'how', 'man', 'new', 'now', 'old',
                'see', 'two', 'way', 'who', 'boy', 'did', 'its', 'let', 'put', 'too',
                'use', 'any', 'big', 'ask', 'try', 'run', 'own', 'few', 'off', 'far',
                'time', 'year', 'what', 'they', 'know', 'take', 'come', 'give', 'look', 'find',
                'work', 'live', 'back', 'call', 'move', 'hand', 'part', 'place', 'right', 'thing',
                'water', 'house', 'world', 'light', 'night', 'music', 'river', 'green', 'happy', 'small',
            ],
            'medium' => [
                'because', 'between', 'through', 'another', 'without', 'against', 'nothing',
                'morning', 'evening', 'country', 'picture', 'company', 'already', 'program',
                'problem', 'perhaps', 'quality', 'service', 'student', 'teacher', 'machine',
                'measure', 'natural', 'kitchen', 'journey', 'library', 'mystery', 'pattern',
                'balance', 'capture', 'freedom', 'harvest', 'imagine', 'lantern', 'mineral',
                'observe', 'passage', 'reflect', 'shelter', 'traffic', 'upgrade', 'venture',
                'weather', 'brother', 'chicken', 'diamond', 'element', 'gravity', 'horizon',
                'justice', 'kingdom', 'laundry', 'monitor', 'network', 'opinion', 'perfume',
            ],
            'hard' => [
                'acknowledge', 'bureaucracy', 'circumstance', 'deliberately', 'extraordinary',
                'fundamental', 'geographical', 'hypothetical', 'indispensable', 'jurisdiction',
                'knowledgeable', 'legitimately', 'manufacturing', 'nevertheless', 'objectively',
                'philosophical', 'questionable', 'remarkably', 'sophisticated', 'transparency',
                'unconventional', 'vulnerability', 'whereabouts', 'accommodate', 'beneficiary',
                'consequently', 'determination', 'entrepreneur', 'infrastructure', 'simultaneously',
                'qualification', 'representative', 'specification', 'understanding', 'visualization',
                'architecture', 'collaborate', 'distinguish', 'experimental', 'investigation',
            ],
        ];
    }
}
