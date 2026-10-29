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
        $passages   = $this->passages();

        return view('web.typing-test.index', compact('durations', 'duration', 'passages'));
    }

    // the prose the test text is built from, one set per difficulty. Only characters
    // that sit on a standard keyboard are used, so nothing is impossible to type.
    private function passages()
    {
        return [
            'easy' => [
                'The bus was late again this morning, so I walked the last mile to work.',
                'She keeps a small garden behind the house, mostly herbs and one stubborn tomato plant.',
                'We ate dinner on the floor because the table had not arrived yet.',
                'My brother calls every Sunday, usually while he is doing the washing up.',
                'The cat sleeps on the warm patch of carpet near the window all afternoon.',
                'There is a bakery on the corner that opens before the sun comes up.',
                'He learned to swim at forty and now goes to the pool twice a week.',
                'The rain started just as we reached the top of the hill.',
                'I found an old photograph of my parents tucked inside a library book.',
                'We painted the kitchen yellow and regretted it within a month.',
                'The train was quiet, so I read the whole way home.',
                'She made soup from whatever was left in the fridge, and it was good.',
            ],
            'medium' => [
                'The old bookshop on the corner closed last spring, and nobody seems to know what happened to the owner.',
                'Every morning I walk past the empty window and think about the paperbacks that used to lean against the glass.',
                'It took three attempts and a borrowed ladder, but the shelves are finally level and the books are off the floor.',
                'She said she would be ten minutes away, which in her case has always meant somewhere closer to forty.',
                'The flat above ours has been empty since August, though the hallway light still clicks on at seven every evening.',
                'We agreed to split the cost of the car, and then spent two hours arguing about who would drive it first.',
                'His notes were so badly written that even he could not read them a week later.',
                'The restaurant does not take bookings, so you queue outside and hope the weather holds.',
                'After the power cut, the whole street stood in their doorways talking to neighbours they had never met.',
                'I keep meaning to cancel the subscription, but every month it slips quietly past me again.',
                'The river path floods twice a year, and every year somebody forgets and ruins a good pair of shoes.',
                'She left the job on a Friday and started her own thing on the Monday, which surprised exactly nobody.',
            ],
            'hard' => [
                'The committee met for six hours; by the end, nobody could remember which of the three proposals they had actually agreed to.',
                'Having read the contract twice, she circled clause 14, wrote "ask about this" in the margin, and put it back in the drawer.',
                'The project ran 40% over budget, largely because the original estimate assumed nothing would go wrong, which is never true.',
                'He argued, not unreasonably, that a deadline agreed without consulting the people doing the work is really just a wish.',
                'There were 23 people in the room, four of whom were presenting, and precisely one who had read the briefing document.',
                'The building was finished in 1897, rebuilt after the fire, and has been "temporarily" scaffolded since 2019.',
                'Her argument rested on a single assumption: that the data collected in March was comparable to the data collected in June.',
                'It is a strange kind of progress when the software gets faster every year and the work somehow takes just as long.',
                'The report recommended three changes; the board approved one, deferred another, and quietly lost the third entirely.',
                'Whether the policy actually reduced costs is debatable, but it certainly produced an impressive quantity of paperwork.',
                'The train operator apologised for the delay, blamed the weather, and declined to explain why the 7:42 is always affected.',
                'He had, by his own count, rewritten the opening paragraph 31 times before deciding the first version was best.',
            ],
        ];
    }
}
